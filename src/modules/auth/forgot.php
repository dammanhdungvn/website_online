<?php
if (!defined("_CODE") ) {
  return die("Access denied");
}

$data = [
  'pageTitle' => 'Quên mật khẩu',
];
layouts('header', $data);
?>

<?php
  //Chuyển hướng đến Trang chủ nếu đã login
  if (isLogin()) {
    redirect('?module=home&action=dashbroad');
  }

  if (isPost()) {
    $filterAll = filter();
    
    if (!empty($filterAll['email'])) {
      $email =  $filterAll['email'];
      $sql = "SELECT `ID` FROM USERS WHERE EMAIL = '$email'";
      $userQuery = getRow($sql);

      if ($userQuery) {
        $userID = $userQuery['ID'];
        $forgotToken = sha1(uniqid().time());

        $dataUpdate = [
          'FORGOT_TOKEN' => $forgotToken,
        ];

        $updateStatus = updateData('USERS', $dataUpdate, "ID = '$userID'");

        if ($updateStatus) {
          // Tạo link reset mật khẩu
          $linkReset = _WEB_HOST .'?module=auth&action=reset&token='. $forgotToken;

          //Send mail
          $subject = 'Yêu cầu khôi phục mật khẩu.';
          $content = 'Chào bạn.<br>';
          $content .= 'Chúng tôi nhận được yêu cầu khôi phục mật khẩu từ bạn. Vui lòng click vào link sau để lấy lại mật khẩu: <br>';
          $content .= $linkReset .'<br>';
          $content .= 'Trân trọng cảm ơn bạn!';

          $sendMailStatus = sendMail($email, $subject, $content);

          if ($sendMailStatus) {
            setFlashData('msg', 'Vui lòng kiểm tra Email của bạn!');
            setFlashData('msg_type', 'success');
          }
          else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!(email)');
            setFlashData('msg_type', 'danger');
          }
        }
        else {
          setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
          setFlashData('msg_type', 'danger');
        }
      }
      else {
        setFlashData('msg', 'Email không tồn tại!');
        setFlashData('msg_type', 'danger');
      }
    }
    else {
      setFlashData('msg', 'Vui lòng nhập địa chỉ Email của bạn!');
      setFlashData('msg_type', 'danger');
      setFlashData('oldData', $filterAll);
    }
    redirect('?module=auth&action=forgot');
  }

  $msg = getFlashData('msg');
  $msg_type = getFlashData('msg_type');
  $oldData = getFlashData('oldData');
?>

<section class="forgot">
  <div class="container">
    <div class="row">
    <div class="col-12">
      <h1 class="title">QUÊN MẬT KHẨU</h1>
      <?php
        if (!empty($msg)) {
          getMsg($msg, $msg_type);
        }
      ?>
    <form action="" method="post" class="form-forgot">
          <div class="input-email">
            <input type="email" placeholder="Email" class="form-control" name="email" value="<?php 
              echo form_value('email', $oldData, null);
            ?>">
          </div>
          <button type="submit" class="btn btn-primary">Quên mật khẩu</button>
          <div class="hr"></div>
          <a href="?module=auth&action=login" style="text-align:center">Đăng nhập</a>
          <a href="?module=auth&action=register" style="text-align:center">Đăng ký</a>
        </form>  
    </div>
    </div>
  </div>
</section>

<?php
layouts('footer');
?>