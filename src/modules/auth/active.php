<?php
  if (!defined("_CODE") ) {
    return die("Access denied");
  }

  layouts('header', 'active');
?>

<?php
  $token = filter()['token'];

// Xử lý kích hoạt tài khoản
if (!empty($token)) {
    // Truy vấn để kiểm  tra token với CSDL 
    $sql = "SELECT `ID` FROM USERS WHERE ACTIVE_TOKEN = '$token'";
    $tokenQuery = getRow($sql);

  if (!empty($tokenQuery)) {
    $userId = $tokenQuery['ID'];
    $dataUpdate = [
      'STATUS' => 1,
      'ACTIVE_TOKEN' => null,
    ];
    $updateStatus = updateData('USERS', $dataUpdate, "ID = '$userId'");

    if ($updateStatus) {
      setFlashData('msg', 'Kích hoạt tài khoản thành công!');
      setFlashData('msg_type', 'success');
    } else {
      setFlashData('msg', 'Kích hoạt tài khoản không thành công!');
      setFlashData('msg_type', 'danger');
    }
    redirect('?module=auth&action=login');
  } else {
    getMsg('Liên kết không tồn tại hoặc đã hết hạn!', 'danger');
  }
} else {
  getMsg('Liên kết không tồn tại hoặc đã hết hạn!', 'danger');
}

?>

<?php
  layouts('footer');
?>