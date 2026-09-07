<?php
declare(strict_types=1);
define('TBK_ROOT', __DIR__);
define('TBK_SITE_NAME','ToolboxKart');
define('TBK_BASE_URL', rtrim((isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!=='off'?'https':'http').'://'.($_SERVER['HTTP_HOST']??'toolboxkart.com'),'/'));
define('TBK_CONTACT_EMAIL','hello@toolboxkart.com');
