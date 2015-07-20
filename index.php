<?php
define("APP_PATH",dirname(__FILE__));
define("SP_PATH",dirname(__FILE__).'/SpeedPHP');
$spConfig = array(
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

);
require(SP_PATH."/SpeedPHP.php");
spRun();
