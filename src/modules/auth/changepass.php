<?php
if (!defined("_CODE") ) {
  return die("Access denied");
}

$data = [
  'pageTitle' => 'Đổi mật khẩu',
];


layouts('header-logined', $data);

?>


<?php

if (!isLogin()) {
  redirect('?module=auth&action=login');
}

//lấy dữ liệu
  $login_token = getSession()['loginToken'];

  $sql = "SELECT 
    USERS.ID, 
    USERS.EMAIL,
    USERS.PASSWORD

    FROM 
        LOGIN_TOKEN
    JOIN 
        USERS 
    ON 
        LOGIN_TOKEN.USER_ID = USERS.ID
    WHERE 
        LOGIN_TOKEN.TOKEN = '$login_token'";
  
  $userQuery = getRow($sql);
  $userID = $userQuery['ID'];
  $userEmail = $userQuery['EMAIL'];

  if (isPost()) {
    $filterAll = filter();
    $errors = [];

    // Hàm check password 
    if (empty($filterAll['old_password'])) {
      $errors['old_password']['require'] = 'Vui lòng nhập mật khẩu hiện tại của bạn!';
    }
    else {
      $password = $filterAll['old_password'];
      $passwordCorrect = $userQuery['PASSWORD'];
      if (!password_verify($password, $passwordCorrect)) {
        $errors['old_password']['check'] = 'Mật khẩu không đúng!';
      }
    }

    // Hàm check password confirm 
    if (empty($filterAll['new_password'])) {
      $errors['new_password']['require'] = 'Vui lòng mật khẩu mới!';
    }

    //xử lý logic 
    if (empty($errors)) {
      // Xử lý update mật khẩu
      $passwordHash = password_hash($filterAll['new_password'], PASSWORD_DEFAULT);
      $passwordUpdate = [
        'PASSWORD' => $passwordHash,
        'UPDATED_AT' => date('Y-m-d H:i:s'),
      ];
                
      $updateStatus = updateData('USERS', $passwordUpdate, "ID = '$userID'");

      if ($updateStatus) {
        setFlashData('msg', 'Cập nhật mật khẩu thành công!');
        setFlashData('msg_type', 'success');
      }
      else {
        setFlashData('msg', 'Lỗi hệ thống vui lòng thử lại sau!');
        setFlashData('msg_type', 'danger');
      }
    }
    else {
      setFlashData('msg', 'Vui lòng kiểm tra lại dữ liệu!');
      setFlashData('msg_type', 'danger');
      setFlashData('errors', $errors);
      
    }
    
    redirect('?module=auth&action=changepass');
  }

  $msg = getFlashData('msg');
  $msg_type = getFlashData('msg_type');
  $errors = getFlashData('errors');

      
?>

<section class="forgot">
  <div class="container">
    <div class="row">
    <div class="col-12">
      <h1 class="title">ĐẶT LẠI MẬT KHẨU</h1>
      <?php
        if (!empty($msg)) {
          getMsg($msg, $msg_type);
        }
      ?>
      <form action="" method="post" class="form-forgot">
        <div class="input-email">
          <input type="email" placeholder="Email" class="form-control" name="email" value="<?php 
            echo $userEmail;
          ?>"readonly>
        </div>

        <div class="input-password">
          <input type="password" placeholder="Mật khẩu hiện tại" class="form-control" name="old_password">
          <?php
            echo form_error('old_password', $errors);
          ?>
        </div>

        <div class="input-password">
          <input type="password" placeholder="Mật khẩu mới" class="form-control" name="new_password">
          <?php
            echo form_error('new_password', $errors);
          ?>
        </div>
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <br>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
      </form>  
    </div>
    </div>
  </div>
</section>



<?php
layouts('footer-logined');
?>