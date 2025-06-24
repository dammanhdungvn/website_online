<?php
if (!defined("_CODE") ) {
  return die("Access denied");
}

$data = [
  'pageTitle' => 'Đăng ký tài khoản',
];

?>

<!-- Hàm thực hiện kiểm tra dữ liệu của register-->
 <?php


  if (isPost()) {
    $filterAll = filter();
    $errors = [];

    //  Hàm check Firstname
    if (empty($filterAll['firstname'])) {
      $errors['firstname']['require'] = 'Vui lòng nhập Tên của bạn!';
    }

    else {

      if (strlen($filterAll['firstname']) < 2) {
        $errors['firstname']['min'] = 'Tên nhập không hợp lệ!';
      }
    }

    //  Hàm check Lastname 
    if (empty($filterAll['lastname'])) {
      $errors['lastname']['require'] = 'Vui lòng nhập Họ của bạn!';
    }
    else {
      if (strlen($filterAll['lastname']) < 2) {
        $errors['lastname']['min'] = 'Họ nhập không hợp lệ!';
      }
    }

    // Hàm check Email 
    if (empty($filterAll['email'])) {
      $errors['email']['require'] = 'Vui lòng nhập Email của bạn!';
    }
    else {
      $email = $filterAll['email'];
      $sql = "SELECT ID FROM users WHERE EMAIL = '$email'";
      if (countRows($sql) > 0) {
        $errors['email']['unique'] = 'Email đã tồn tại!';
      }
    }

    // Hàm check số điện thoại  
    if (empty($filterAll['phone'])) {
      $errors['phone']['require'] = 'Vui lòng nhập số điện thoại của bạn!';
    }
    else {
      $phone = $filterAll['phone'];
      if (isPhone($phone) == false) {
        $errors['phone']['isPhone'] = 'Số điện thoại không hợp lệ!';
      }
    }

    // Hàm check password 
    if (empty($filterAll['password'])) {
      $errors['password']['require'] = 'Vui lòng nhập mật khẩu của bạn!';
    }
    else {
      $password = $filterAll['password'];
      if (strlen($password) < 8) {
        $errors['password']['min'] = 'Mật khẩu phải có tối thiếu 8 ký tự trở lên!';
      }
    }

    // Hàm check password confirm 
    if (empty($filterAll['password_confirm'])) {
      $errors['password_confirm']['require'] = 'Vui lòng nhập lại mật khẩu của bạn!';
    }
    else {
      if ( $filterAll['password_confirm'] != $filterAll['password']) {
        $errors['password_confirm']['require'] = 'Nhập lại mật khẩu không đúng!';
      }
    }
 
    if (empty($errors)) {
      $activeToken = sha1(uniqid().time());

      $dataInsert = [
        'FIRSTNAME' => $filterAll['firstname'],
        'LASTNAME' => $filterAll['lastname'],
        'EMAIL' => $filterAll['email'],
        'PHONE' => $filterAll['phone'],
        'PASSWORD' => password_hash($filterAll['password'], PASSWORD_DEFAULT),
        'ACTIVE_TOKEN' => $activeToken,
        'CREATED_AT' => date('Y-m-d H:i:s'),
      ];

      
      $insert = insertData('users', $dataInsert);
      if ($insert) {
        
        // Tạo link kích hoạt tài khoản
        $linkActive = _WEB_HOST .'?module=auth&action=active&token='. $activeToken;
        
        // Thiết lập send email
        $subject = $filterAll['lastname'] .' '. $filterAll['firstname'] .' Vui lòng kích hoạt tài khoản!';
        $content = 'Chào '. $filterAll['lastname'] .' '. $filterAll['firstname'] .',<br>';
        $content .= 'Vui lòng click vào link dưới đây để kích hoạt tài khoản: <br>';
        $content .= $linkActive .'<br>';
        $content .= 'Trân trọng cảm ơn!';
        
        // Tiến hành gửi mail
        $smail = sendMail($filterAll['email'], $subject, $content);

        if ($smail) {
          setFlashData('msg', 'Đăng ký thành công, Vui lòng kiểm tra email của bạn!');
          setFlashData('msg_type', 'success');
        }
        else {
          setFlashData('msg', 'Hệ thống đang gặp sự cố, Vui lòng thử lại sau!');
          setFlashData('msg_type', 'danger');
        }
      }
      else {
        setFlashData('msg', 'Đăng ký không thành công!');
        setFlashData('msg_type', 'danger');
      }
      redirect('?module=auth&action=register');
    }
    else {
      setFlashData('msg', 'Vui lòng kiểm tra lại dữ liệu!');
      setFlashData('msg_type', 'danger');
      setFlashData('errors', $errors);
      setFlashData('old', $filterAll);
      redirect('?module=auth&action=register');
    }
  }

 ?>

 <?php
 layouts('header', $data);
 $msg = getFlashData('msg');
 $msg_type = getFlashData('msg_type');
 $errors = getFlashData('errors');
 $oldData = getFlashData('old');

 ?>

<section class="register">
  <div class="container">
    <div class="row">
    <div class="col-12">
      <h1 class="title">ĐĂNG KÝ</h1>

      <?php
        if (!empty($msg)) {
          getmsg($msg, $msg_type);
        } 
      ?>

    <form action="" method="post" class="form-register">
          <div class="input-firstname">
            <input type="text" placeholder="Tên" class="form-control" name="firstname" value="<?php 
              echo form_value('firstname', $oldData, null);
            ?>">
            <?php
              echo form_error('firstname', $errors);
            ?>
          </div>

          <div class="input-lastname">
            <input type="text" placeholder="Họ" class="form-control" name="lastname" value="<?php 
              echo form_value('lastname', $oldData, null);
            ?>">
            <?php
              echo form_error('lastname', $errors);
            ?>
          </div>

          <div class="input-email">
            <input type="email" placeholder="Email" class="form-control" name="email" value="<?php 
              echo form_value('email', $oldData, null);
            ?>">
            <?php
              echo form_error('email', $errors);
            ?>
          </div>

          <div class="input-phone">
            <input type="tel" placeholder="Số điện thoại" class="form-control" name="phone" value="<?php 
              echo form_value('phone', $oldData, null);
            ?>">
            <?php
              echo form_error('phone', $errors);
            ?>
          </div>

          <div class="input-password">
            <input type="password" placeholder="Password" class="form-control" name="password">
            <?php
              echo form_error('password', $errors);
            ?>
          </div>

          <div class="input-password">
            <input type="password" placeholder="Nhập lại Password" class="form-control" name="password_confirm">
            <?php
              echo form_error('password_confirm', $errors);
            ?>
          </div>


          <button type="submit" class="btn btn-primary">Đăng ký</button>
          <div class="hr"></div>
          <a href="?module=auth&action=login" style="text-align:center">Đăng nhập</a>
          <a href="?module=auth&action=forgot" style="text-align:center">Quên mật khẩu</a>
        </form>  
    </div>
    </div>
  </div>
</section>

<?php
layouts('footer');
?>