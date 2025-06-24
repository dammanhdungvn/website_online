
<?php
if (!defined("_CODE") ) {
  return die("Access denied");
}

$data = [
  'pageTitle' => 'Đăng nhập tài khoản',
];
?>

<!-- Code validate form login -->
<?php

  //Chuyển hướng đến Trang chủ nếu đã login
  if (isLogin()) {
    redirect('?module=home&action=dashbroad');
  }
  
  if (isPost()) {
    $filterAll = filter();
    
    if (!empty(trim($filterAll['email'])) && !empty(trim($filterAll['password']))) {

      $email = $filterAll['email'];
      $password = $filterAll['password'];
    
      //Truy vấn lấy thông tin trong CSDL
      $sql = "SELECT `PASSWORD`, `ID`, `STATUS` FROM `users` WHERE EMAIL = '$email'";
      $userQuery = getRow($sql);

      // Kiểm tra thông tin đăng nhập so với CSDL
      if (!empty($userQuery)) {
        $passwordHash = $userQuery['PASSWORD'];
        $userID = $userQuery['ID'];
        $userStatus = $userQuery['STATUS'];

        if ($userStatus == '0') {
          setFlashData('msg', 'Vui lòng kích hoạt tài khoản!');
          setFlashData('msg_type', 'danger');
        }
        else {
          if (password_verify($password, $passwordHash) && $userStatus == '1') {
            
            // Tạo token login
            $tokenLogin = sha1(uniqid().time());
  
            // Insert vào bảng USERS cột LOGIN_TOKEN
            $dataInsert = [
              'USER_ID' => $userID,
              'TOKEN' => $tokenLogin,
              'CREATED_AT' => date('Y-m-d H:i:s'),
            ];
  
            $insertStatus = insertData('login_token', $dataInsert);
            var_dump($insertStatus);
            if($insertStatus == true) {
              //Insert thành công
  
              //Insert loginToken vào session
              setSession('loginToken', $tokenLogin);
  
              redirect('?module=home&action=dashbroad');
            }
            else {
              setFlashData('msg', 'Không thể đăng nhập vui lòng thử lại sau!');
              setFlashData('msg_type', 'danger');
            }
          }
          else {
            setFlashData('msg', 'Mật khẩu không đúng!');
            setFlashData('msg_type', 'danger');
            setFlashData('oldData', $filterAll);
          }
        }
      }
      else {
        setFlashData('msg', 'Email không tồn tại!');
        setFlashData('msg_type', 'danger');
      }
    }
    else {
      setFlashData('msg', 'Vui lòng nhập email và mật khẩu!');
      setFlashData('msg_type', 'danger');
    }
    redirect('?module=auth&action=login');
  }

  ?>

<?php
  layouts('header', $data);
  
  $msg = getFlashData('msg');
  $msg_type = getFlashData('msg_type');
  $oldData = getFlashData('oldData');
?>

<section class="login">
  <div class="container">
    <div class="row">
      <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-xs-12 content-login">
        <h1 class="title">DMD</h1>
        <p class="desc">Nền tảng tạo và chấm bài trắc nghiệm online</p>
      </div>

        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12">

        <?php
          if (!empty($msg)) {
            getMsg($msg, $msg_type);
          }
        ?>

        <form method="post" class="form-login">
          <div class="input-email">
            <input type="email" placeholder="Email" class="form-control" name="email" value="<?php 
              echo form_value('email', $oldData, null);
            ?>">
          </div>
          <div class="input-password">
            <input type="password" placeholder="Mật khẩu" class="form-control" name="password">
          </div>
          <button type="submit" class="btn btn-primary login-btn-login">Đăng nhập</button>
          <a href="?module=auth&action=forgot" class="login-forgot">Quên mật khẩu?</a>
          <div class="hr"></div>
          <a class="btn btn-success" href="?module=auth&action=register">Đăng ký</a>
        </form>
      </div>
    </div>
  </div>
</section>

<?php
layouts('footer');
?>