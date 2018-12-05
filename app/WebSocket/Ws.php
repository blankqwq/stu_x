<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/25
 * Time: 14:48
 */

namespace App\WebSocket;



use App\Handlers\Util;
use App\Models\Classes;
use Illuminate\Support\Facades\Redis;

class Ws {
    CONST HOST = "0.0.0.0";
    CONST PORT = 9501;
    CONST CHART_PORT = 9500;

    public $ws = null;
    public $redis = null;

    public static $_instance;

    public static function instance(){
        if(empty(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {
        // 获取 key 有值 del
        $this->ws = new \swoole_websocket_server(self::HOST, self::PORT);
        $this->ws->listen(self::HOST, self::CHART_PORT, SWOOLE_SOCK_TCP);

        $this->ws->set(
            [
                'enable_static_handler' => false,
//                'document_root' => "/home/work/hdtocs/swoole_mooc/thinkphp/public/static",
                'worker_num' => 4,
                'task_worker_num' => 4,
            ]
        );

        $this->ws->on("start", [$this, 'onStart']);
        $this->ws->on("open", [$this, 'onOpen']);
        $this->ws->on("message", [$this, 'onMessage']);
        $this->ws->on("workerstart", [$this, 'onWorkerStart']);
        $this->ws->on("request", [$this, 'onRequest']);
        $this->ws->on("task", [$this, 'onTask']);
        $this->ws->on("finish", [$this, 'onFinish']);
        $this->ws->on("close", [$this, 'onClose']);

        $this->ws->start();
    }

    /**
     * @param $server
     */
    public function onStart($server) {
        \swoole_set_process_name("live_master");
    }
    /**
     * @param $server
     * @param $worker_id
     */
    public function onWorkerStart($server,  $worker_id) {

    }

    /**
     * request回调
     * @param $request
     * @param $response
     */
    public function onRequest($request, $response) {
        if($request->server['request_uri'] == '/favicon.ico') {
            $response->status(404);
            $response->end();
            return ;
        }
        $_SERVER  =  [];
        if(isset($request->server)) {
            foreach($request->server as $k => $v) {
                $_SERVER[strtoupper($k)] = $v;
            }
        }
        if(isset($request->header)) {
            foreach($request->header as $k => $v) {
                $_SERVER[strtoupper($k)] = $v;
            }
        }

        $_GET = [];
        if(isset($request->get)) {
            foreach($request->get as $k => $v) {
                $_GET[$k] = $v;
            }
        }
        $_FILES = [];
        if(isset($request->files)) {
            foreach($request->files as $k => $v) {
                $_FILES[$k] = $v;
            }
        }
        $_POST = [];
        if(isset($request->post)) {
            foreach($request->post as $k => $v) {
                $_POST[$k] = $v;
            }
        }

        $this->writeLog();
        $_POST['http_server'] = $this->ws;
        $response->end("ok");
    }

    public function onTask($serv, $taskId, $workerId, $data) {

//        // 分发 task 任务机制，让不同的任务 走不同的逻辑
//        $obj = new app\common\lib\task\Task;
//
//        $method = $data['method'];
//        $flag = $obj->$method($data['data'], $serv);
//        /*$obj = new app\common\lib\ali\Sms();
//        try {
//            $response = $obj::sendSms($data['phone'], $data['code']);
//        }catch (\Exception $e) {
//            // todo
//            echo $e->getMessage();
//        }*/
//
//        return $flag; // 告诉worker
    }

    public function onFinish($serv, $taskId, $data) {
        echo "taskId:{$taskId}\n";
        echo "finish-data-sucess:{$data}\n";
    }


    public function onOpen($ws, $request) {
        // fd redis [1]
        print_r($request->get);
        echo 'class_'.$request->get['class'];
        Predis::getInstance()->sAdd('class_'.$request->get['class'], $request->fd);
        var_dump($request->fd);
    }


    public function onMessage($ws, $frame) {
        $datas=[];
        $datas=json_decode($frame->data,true);
        print_r($datas);
        switch ($datas['type']){
            case 'message':
                $message=Util::getJson($datas);
                Classes::find($datas['class_id'])->chart()->create([
                    'content'=>$datas['content'],
                    'user_id'=>$datas['user_id'],
                ]);
                $fds=Predis::getInstance()->sMembers("class_".$datas['class_id']);
                foreach ($fds as $f){
                    if ($this->ws->exist($f))
                        $ws->push($f,$message);
                    else
                        Predis::getInstance()->sRem("class_".$datas['class_id'], $f);
                }
                break;
            case 'connect':
                $message=Util::getJson($datas);
                $fds=Predis::getInstance()->sMembers("class_".$datas['class_id']);
                foreach ($fds as $f){
                    if ($this->ws->exist($f))
                        $ws->push($f,$message);
                    else
                        Predis::getInstance()->sRem("class_".$datas['class_id'], $f);
                }
                break;

            case 'quit':
                $message=Util::getJson($datas);
                $fds=Predis::getInstance()->sMembers("class_".$datas['class_id']);
                foreach ($fds as $f){
                    if ($this->ws->exist($f))
                        $ws->push($f,$message);
                    else
                        Predis::getInstance()->sRem("class_".$datas['class_id'], $f);
                }
                break;
            default:

                break;
        }


    }


    public function onClose($ws, $fd) {
        // fd del
        echo "clientid:{$fd}\n";

    }

//    public function writeLog() {
//        $datas = array_merge(['date' => date("Ymd H:i:s")],$_GET, $_POST, $_SERVER);
//
//        $logs = "";
//        foreach($datas as $key => $value) {
//            $logs .= $key . ":" . $value . " ";
//        }
//
//        swoole_async_writefile(APP_PATH.'../runtime/log/'.date("Ym")."/".date("d")."_access.log", $logs.PHP_EOL, function($filename){
//            // todo
//        }, FILE_APPEND);
//
//    }
}
