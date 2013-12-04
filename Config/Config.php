<?php

/**
 * 获取二级顶级域名
 */
$topDomainName = ltrim(strtolower(substr($_SERVER['HTTP_HOST'], -3)),'.');

//域名配置
define('DOMAIN_TOP', $topDomainName);
define('DOMAIN_MAIN', 'yanghui.' . DOMAIN_TOP);
define('DOMAIN_NAME', 'www.' . DOMAIN_MAIN);
define('DOMAIN_URL', 'http://' . DOMAIN_NAME);

//url解析参数
define('MODULE', 'mod');
define('CONTROLLER','ctl');
define('ACTION','act');
define('DEFAULT_MODULE','index');
define('DEFAULT_CONTROLLER','index');
define('DEFAULT_ACTION','index');

//资源，模板，模块，模型常量
define('PATH_LIBRARY',PATH_BASE . 'Library' . DIRECTORY_SEPARATOR);
define('PATH_DOWN',PATH_BASE . 'Down' . DIRECTORY_SEPARATOR);