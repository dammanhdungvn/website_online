<?php
if (!defined("_CODE") ) {
  return die("Access denied");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Hàm thêm layout 
function layouts ($layoutName = 'header', $data = []) {
  if (file_exists(_PATH_TEMPLATES .'/layout/'.$layoutName.'.php')) {
    include _PATH_TEMPLATES .'/layout/'.$layoutName.'.php';
  }
}
 
// Hàm gửi mailer
function sendMail($to, $subject, $content) {
  //Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'btlwebhumg@gmail.com';                     //SMTP username
      $mail->Password   = 'mgzn lxxw gahi qgrk';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('btlwebhumg@gmail.com', 'NHOM 2');
      $mail->addAddress($to);     //Add a recipient

      //Content
      $mail -> CharSet = "UTF-8";
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $content;

      //PHPMailer SSL certificate verify failed
      $mail->SMTPOptions = array (
        'ssl' => array (
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
      );

      $sendMail = $mail->send();
      if ($sendMail == true) {
        return true;
      }
      else {
        return false;
      }
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}


// Kiểm tra phương thức GET
function isGet() {
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    return true;
  }
  return false;
}

// Kiểm tra phương thức POST
function isPost() {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    return true;
  }
  return false;
}

// Hàm Filter lọc dữ liệu
function filter() {
  $filterArr = [];
  if(isGet()) {
      if(!empty($_GET)) {
          foreach($_GET as $key => $value) {
              $key = strip_tags($key);
              if (is_array($value)) {
                  $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
              } else {
                  $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
              }
          }
          return $filterArr;
      }
  }

  if(isPost()) {
      if(!empty($_POST)) {
          foreach($_POST as $key => $value) {
              $key = strip_tags($key);
              if (is_array($value)) {
                  $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
              } else {
                  $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
              }
          }
      }
      return $filterArr; 
  }
}

// Hàm kiểm tra Email
function isEmail($email) {
  $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
  return $checkEmail;
}

// Hàm kiểm tra INT
function isNumberInt($number) {
  $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
  return $checkNumber;
}

// Hàm kiểm tra FLOAT
function isNumberFloat($number) {
  $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
  return $checkNumber;
}

// Hàm kiểm tra số điện thoại
function isPhone($phone) {
  // Kiểm tra độ dài và ký tự đầu tiên (phải là số và không bắt đầu bằng 0)
  if (strlen($phone) != 10 || $phone[0] != '0') {
      return false;
  }

  // Kiểm tra từng ký tự xem có phải là số không
  for ($i = 0; $i < strlen($phone); $i++) {
      if (!ctype_digit($phone[$i])) {
          return false;
      }
  }

  return true;
}

// Thông báo lỗi
function getMsg ($smg, $type = 'success') {
  echo '<div class="alert alert-'.$type.'">';
  echo $smg;
  echo '</div>';
}
 
// Hàm chuyển hướng
function redirect($path = 'index.php') {
  header("Location: $path");
  exit;
}

// Hàm thông báo lỗi từng ô
function form_error($fileName, $errors) {
  return (!empty($errors[$fileName]) ?  '<span class="error">'.reset($errors[$fileName]).'</span>' : null); 
}

// Hàm nhập lại value trong form 
// function form_value($fileName, $oldData, $default= null) {
//   return (!empty($oldData[$fileName]) ? $oldData[$fileName] : $default);
// }
function form_value($key, $oldData, $default = null) {
  // Tách key nếu là chuỗi đa cấp như 'answers[0][text]'
  $keys = explode('[', str_replace(']', '', $key));
  $value = $oldData;

  foreach ($keys as $k) {
      if (!isset($value[$k])) {
          return $default;
      }
      $value = $value[$k];
  }
  
  return htmlspecialchars($value);
}


// Kiểm tra trạng thái đăng nhập
function isLogin() {
  $checkLogin = false;
  if (getSession('loginToken')) {
    $loginToken = getSession('loginToken');
    
    // Kiểm tra Token có giống trong CSDL
    $sql = "SELECT `USER_ID` FROM `login_token` WHERE TOKEN = '$loginToken'";
    $queryToken = getRow($sql);
  
    if (!empty($queryToken)) {
      $checkLogin = true;
    }
    else {
      removeSession('loginToken');
    }
  }
  
  return $checkLogin;
}