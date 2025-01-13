
<?php

// Khởi tạo session

// Hàm gán session
function setSession($key, $value) {
  return $_SESSION[$key] = $value;
}

// Hàm đọc session
function getSession($key = '') {
  if (empty($key)) {
    return $_SESSION;
  } else {
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    } else {
      // Xử lý lỗi khi không tìm thấy key
      // Ví dụ: throw new Exception("Key '$key' không tồn tại trong session.");
      return null; 
    }
  }
}

// Hàm xoá session
function removeSession($key = '') {
  if (empty($key)) {
    session_unset(); // Xóa nội dung session
    return true;
  } else {
    if (isset($_SESSION[$key])) {
      unset($_SESSION[$key]);
      return true;
    }
  }
}

// Hàm gán flash data
function setFlashData($key, $value) {
  // Sử dụng mảng riêng biệt cho flash data
  $key = 'flash_' .$key;
  return setSession($key, $value);
}

// Hàm đọc flash data
function getFlashData($key) {
  $key = 'flash_' .$key;
  $data = getSession($key);
  removeSession($key);
  return $data;
}

?> 