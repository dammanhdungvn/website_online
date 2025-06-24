<?php
if (!defined("_CODE") ) {
  return die("Access denied");
}

$data = [
  'pageTitle' => 'Thông tin cá nhân',
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
    users.ID,
    users.FIRSTNAME,
    users.LASTNAME, 
    users.EMAIL,
    users.PASSWORD,
    users.PHONE

    FROM 
        login_token
    JOIN 
        users 
    ON 
        login_token.USER_ID = users.ID
    WHERE 
        login_token.TOKEN = '$login_token'";
  
  $userQuery = getRow($sql);
  $userEmail = $userQuery['EMAIL'];
  $userFirstname = $userQuery['FIRSTNAME'];
  $userLastname = $userQuery['LASTNAME'];
  $userPhone = $userQuery['PHONE'];
  $userID = $userQuery['ID'];
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
 
    if (empty($errors)) {
      $dataInsert = [
        'FIRSTNAME' => $filterAll['firstname'],
        'LASTNAME' => $filterAll['lastname'],
        'PHONE' => $filterAll['phone'],
        'UPDATED_AT' => date('Y-m-d H:i:s'),
      ];

      
      $updateStatus = updateData('users', $dataInsert, "ID = '$userID'");
      if ($updateStatus) {
        setFlashData('msg', 'Cập nhật thành công!');
        setFlashData('msg_type', 'success');    
      }
      else {
        setFlashData('msg', 'Đăng ký không thành công!');
        setFlashData('msg_type', 'danger');
      }
      redirect('?module=auth&action=info');
    }
    else {
      setFlashData('msg', 'Vui lòng kiểm tra lại dữ liệu!');
      setFlashData('msg_type', 'danger');
      setFlashData('errors', $errors);
      redirect('?module=auth&action=info');
    }
  }

  $msg = getFlashData('msg');
  $msg_type = getFlashData('msg_type');
  $errors = getFlashData('errors');
?>

<section class="register">
  <div class="container">
    <div class="row">
    <div class="col-12">
      
    <!-- Thông báo lỗi -->
      <?php
        if (!empty($msg)) {
          getmsg($msg, $msg_type);
        } 
      ?>

    <form action="" method="post" class="form-register">
          <div class="input-firstname">
            <input type="text" placeholder="Tên" class="form-control" name="firstname" value="<?php 
              echo $userFirstname;
            ?>">
            <?php
              echo form_error('firstname', $errors);
            ?>
          </div>

          <div class="input-lastname">
            <input type="text" placeholder="Họ" class="form-control" name="lastname" value="<?php 
              echo $userLastname;
            ?>">
            <?php
              echo form_error('lastname', $errors);
            ?>
          </div>

          <div class="input-email">
            <input type="email" placeholder="Email" class="form-control" name="email" value="<?php 
              echo $userEmail;
            ?>" readonly>
          </div>

          <div class="input-phone">
            <input type="tel" placeholder="Số điện thoại" class="form-control" name="phone" value="<?php 
              echo $userPhone;
            ?>">
          </div>

          <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>  
    </div>
    </div>
  </div>
</section>



<?php
layouts('footer-logined');
?>