<?php
if (!defined("_CODE") ) {
  return die("Access denied");
}

$data = [
  'pageTitle' => 'Đặt lại mật khẩu',
];
layouts('header', $data);
?>

<?php
  //Chuyển hướng đến Trang chủ nếu đã login
  $token = filter()['token'];

  if (!empty($token)) {
    //Truy vấn CSDL kiểm tra token
    $sql = "SELECT `ID`, `EMAIL` FROM users WHERE FORGOT_TOKEN = '$token'";
    $tokenQuery = getRow($sql);

    if (!empty($tokenQuery)) {

      if (isPost()) {
        $filterAll = filter();
        $errors = [];

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

        //xử lý logic 
        if (empty($errors)) {
          // Xử lý update mật khẩu
          $passwordHash = password_hash($filterAll['password'], PASSWORD_DEFAULT);
          $passwordUpdate = [
            'PASSWORD' => $passwordHash,
            'FORGOT_TOKEN' => null,
            'UPDATED_AT' => date('Y-m-d H:i:s'),
          ];
          $userID = $tokenQuery['ID'];
          $updateStatus = updateData('users', $passwordUpdate, "ID = '$userID'");

          if ($updateStatus) {
            setFlashData('msg', 'Cập nhật mật khẩu thành công!');
            setFlashData('msg_type', 'success');
            redirect('?module=auth&action=login');
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
          redirect('?module=auth&action=reset&token='. $token);
        }
        
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
                echo $tokenQuery['EMAIL'];
              ?>" readonly>
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
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <button type="submit" class="btn btn-primary">Gửi</button>
            <div class="hr"></div>
            <a href="?module=auth&action=login" style="text-align:center">Đăng nhập</a>
          </form>  
        </div>
        </div>
      </div>
    </section>

<?php
    }
    else {
      getMsg('Đường dẫn không tồn tại hoặc đã hết hạn!', 'danger');
    }
  }
  else {
      getMsg('Đường dẫn không tồn tại hoặc đã hết hạn!', 'danger');
  }


?>



<?php
layouts('footer');
?>