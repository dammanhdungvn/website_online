<?php
if (!defined("_CODE") ) {
  return die("Access denied");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : "Đăng nhập hoặc đăng ký"; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE?>/css/base.css?ver=<?php echo rand()?>">
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE?>/css/style.css?ver=<?php echo rand()?>">
  
</head>
<body>
</body>
</html>

