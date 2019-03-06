# stu_x
## 一个线上提交作业平台，（先去学习一段时间，过会过来进行重构）

![file](https://iocaffcdn.phphub.org/uploads/images/201812/07/25840/iicmS8x9g2.png!/fw/1240)
## 聊天室采用swoole

![file](https://iocaffcdn.phphub.org/uploads/images/201812/07/25840/e1fJQlxohs.png!/fw/1240)
图文直播功能暂时还没加上，过几天再加进去
-----
启动websocket服务需要安装的清单
  - swoole
  - phpredis
  - hiredis
  - redis

### 本项目安装方法
```
git clone https://github.com/blankqwq/stu_x.git
composer install
php artisan key:generate
```
启动websocket服务

```
php artsian ws:start  
//后台启动ws服务
php /root/stu_x/artisan ws:start >> /dev/null 2>&1 &
```
---
 - 18/12/10 
    - 修复文章修改页面
    - administer扩展包使用姿势不对（改正后使用良好）\
- 18/12/11
     - 修复无主页
     - 修复聊天室ws的ip固定\
 - 18/12/22
    - 修复ws的部分代码写死问题
    - 修复主页显示问题
     - 部分权限限定不正确问题
  
