<?php
  $id = $_GET['id'];
 deleteData('questions', "id='$id'");
 header("Location: ?module=home&action=list_question")
?>