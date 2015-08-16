<?php
define("APP_PATH",dirname(__FILE__));
define("SP_PATH",dirname(__FILE__).'/SpeedPHP');
$spConfig = array(
  'mode' => 'debug', // 部署模式
  'view' => array(
                'enabled' => TRUE, // 开启Smarty支持
                'config' =>array(
                        'template_dir' => APP_PATH.'/tpl', // 模板页面所在的目录
                        'compile_dir' => APP_PATH.'/tmp', // 临时文件编译目录
                        'cache_dir' => APP_PATH.'/tmp', // 临时文件缓存目录
                        'left_delimiter' => '<{',  // Smarty左限定符，默认是{
                        'right_delimiter' => '}>', // Smarty右限定符，默认是}
                ),
                'auto_display' => TRUE, // 是否使用自动输出模板功能
                'auto_display_sep' => '/', // 自动输出模板的拼装模式，/为按目录方式拼装，_为按下划线方式，以此类推
                'auto_display_suffix' => '.html', // 自动输出模板的后缀名
        ),
    'db' => array( // 数据库设置
                'host' => 'localhost',  // 数据库地址，一般都可以是localhost
                'port' => '3306', //数据库服务器端口号
                'login' => 'root', // 数据库用户名
                'password' => 'root', // 数据库密码
                'database' => 'api', // 数据库的库名称
                'driver' => 'mysqli',
        ),

);
require(SP_PATH."/SpeedPHP.php");
spRun();
