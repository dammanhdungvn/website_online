<?php
if (!defined("_CODE") ) {
  return die("Access denied");
}

if (isLogin()) {
  $token = getSession('loginToken');
  deleteData('login_token', "TOKEN = '$token'");
  removeSession('loginToken');
  redirect('?module=auth&action=login');
} 
?>