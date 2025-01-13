<?php 
if (!defined("_CODE") ) {
  return die("Access denied");
}
?>

<?php

  $data = [
    'pageTitle' => 'Trang chủ',
  ];

  layouts('header-logined', $data);
  

  if (!isLogin()) {
    redirect('?module=auth&action=login');
  }

?>

<div class="container" style="margin-top: 80px;"> 
  <div class="row">
    <div class="col-md-3">
      <div class="card" style="padding: 20px 0;"> 
        <img src="<?php echo _WEB_HOST_TEMPLATE .'/images/document.svg'; ?>" class="card-img-top" alt="document" style="width: 60px; margin: 0 auto">
        <div class="card-body text-center">
          <h5 class="card-title">Tạo đề kiểm tra</h5>
          <a href="?module=home&action=setupKiemtra" class="btn btn-primary">Click</a>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card" style="padding: 20px 0;">
        <img src="<?php echo _WEB_HOST_TEMPLATE .'/images/customer-service.svg'; ?>" class="card-img-top" alt="document" style="width: 60px; margin: 0 auto">
        <div class="card-body text-center">
          <h5 class="card-title">Thêm câu hỏi</h5>
          <a href="?module=home&action=question" class="btn btn-primary">Click</a>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card" style="padding: 20px 0;">
        <img src="<?php echo _WEB_HOST_TEMPLATE .'/images/bank.svg'; ?>" class="card-img-top" alt="document" style="width: 60px; margin: 0 auto">
        <div class="card-body text-center">
          <h5 class="card-title">Ngân hàng câu hỏi</h5>
          <a href="?module=home&action=list_question" class="btn btn-primary">Click</a>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card" style="padding: 20px 0;">
        <img src="<?php echo _WEB_HOST_TEMPLATE .'/images/medical-result.svg'; ?>" class="card-img-top" alt="document" style="width: 60px; margin: 0 auto">
        <div class="card-body text-center">
          <h5 class="card-title">Kết quả kiểm tra</h5>
          <a href="?module=home&action=score" class="btn btn-primary">Click</a>
        </div>
      </div>
    </div>

    
  </div>
</div>

<?php
  layouts('footer-logined');
?>

