<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class StuClassException extends Exception
{
    //
    protected $msgForUser;
    protected $redirect;


    public function __construct(int $id,string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->msgForUser=$message;
        $this->redirect=route('classes.joining',$id);
    }

    public function render(){
        $code=$this->code;
        $redirect=$this->redirect;
        $message=$this->msgForUser;

        return  response(view('stu.pages.error', compact('code', 'message','redirect')), $this->code);
    }

}
