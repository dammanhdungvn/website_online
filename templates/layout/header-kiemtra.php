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
  <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : "Trang chủ"; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE?>/css/base.css?ver=<?php echo rand()?>">
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE?>/css/kiemtra.css?ver=<?php echo rand()?>">
 
</head>
<body>
</body>
</html>

<header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="?module=home&action=dashbroad" class="nav-link px-2 link-body-emphasis">Trang chủ</a></li>
          <li><a href="?module=home&action=setupKiemTra" class="nav-link px-2 link-body-emphasis">Tạo đề kiểm tra</a></li>
          <li><a href="?module=home&action=list_question" class="nav-link px-2 link-body-emphasis">Ngân hàng câu hỏi</a></li>
          <li><a href="?module=home&action=score" class="nav-link px-2 link-body-emphasis">Kết quả thi</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" style="">
            <li><a class="dropdown-item" href="?module=auth&action=info">Thông tin</a></li>
            <li><a class="dropdown-item" href="?module=auth&action=changepass">Đổi mật khẩu</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="?module=auth&action=logout">Đăng xuất</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>