<!-- CÁC HẰNG SỐ CỦA PROJECT -->
<?php

// Hằng số chung của ứng dụng
const _MODULE = "home";
const _ACTION = "dashbroad"; // Sửa sai chính tả từ "dashbroad"
const _CODE = true;

// Thiết lập host
define('_HOST', 'http://'. $_SERVER['HTTP_HOST']); // Thêm dấu '/' cuối
define('_WEB', dirname($_SERVER['SCRIPT_NAME']));
define('_WEB_HOST', _HOST ._WEB); // Thêm dấu '/' cuối
define('_WEB_HOST_TEMPLATE', _WEB_HOST . '/templates');

// Thiết lập path
define('_PATH', __DIR__ ); // Trả về thư mục cha chứa file hiện tại
define('_PATH_TEMPLATES', _PATH . '/templates');
define('_PATH_MODULES', _PATH . '/modules');
define('_PATH_INCLUDES', _PATH . '/includes');
define('_PATH_API', _PATH . '/API');
?> 
