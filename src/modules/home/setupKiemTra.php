<?php
if (!defined("_CODE")) {
  return die("Access denied");
}

$data = [
  'pageTitle' => 'Tạo đề kiểm tra',
];

if (!isLogin()) {
  redirect('?module=auth&action=login');
}
?>

<?php
  if (isPost()) {
    $errors = [];
    $filterAll = filter();
    $time = $filterAll['time'];
    $questions = $filterAll['questions'];
    $skip = $filterAll['skip'];
    $subject = $filterAll['subject'];

    $sql = "SELECT COUNT(ID) AS count FROM questions WHERE subject_id = '$subject'";
    $queryQuestions = getRow($sql);
    $countQuestions = $queryQuestions['count'];

    if (empty(trim($skip))) {
      $errors['skip']['riquire'] = "Bạn phải nhập số lượng câu hỏi!";
    }
    else {
      if ($skip < 0 || $skip > $countQuestions) {
        $errors['skip']['limited'] = "Số lượng skip câu hỏi phải lớn >= 0 và không được vượt quá trong ngân hàng đề thi là $countQuestions câu hỏi";
      }
    }

    if (empty(trim($questions))) {
      $errors['questions']['riquire'] = "Bạn phải nhập số lượng câu hỏi!";
    }
    else {

      if ($countQuestions < $questions || $questions <= 0) {
        $errors['questions']['limited'] = "Số lượng câu hỏi phải lớn hơn 0 và không được vượt quá trong ngân hàng đề thi là $countQuestions câu hỏi";
      }

    } 

    if (empty(trim($time))) {
      $errors['time']['riquire'] = "Bạn phải nhập thời gian thi!";
    }
    else {
     if ($time <= 0) {
      $errors['time']['limited'] = "Số thời gian làm bài phải lớn hơn 0!";
     } 

     if (empty(trim($subject))) {
      $errors['subject']['riquire'] = "Bạn phải chọn môn học!";
     }
    }

    if (empty($errors)) {
      setSession('questions', $questions);
      setSession('time', $time);
      setSession('skip', $skip);
      setSession('subject', $subject);
      redirect('?module=home&action=kiemtra');
    }
    else {
      setFlashData('msg', 'Vui lòng kiểm tra lại dữ liệu!');
      setFlashData('msg_type', 'danger');
      setFlashData('errors', $errors);
      redirect('?module=home&action=setupKiemTra');
    }
  }

?>

<?php
  layouts('header-logined', $data);
  $msg = getFlashData('msg');
  $msg_type = getFlashData('msg_type');
  $errors = getFlashData('errors');
  $oldData = getFlashData('old');
?>

<section class="login"> 
  <div class="container" style="width: 400px;">
    <div class="row">
    <?php
        if (!empty($msg)) {
          getmsg($msg, $msg_type);
        } 
      ?>
      <form action="" method="post" class="form-login">
      <div class="input-skip">
          <input type="number" placeholder="Bắt đầu câu hỏi từ câu số mấy" class="form-control" name="skip">
          <?php
              echo form_error('skip', $errors);
            ?>
        </div>

        <div class="input-questions">
          <input type="number" placeholder="Nhập vào số lượng câu hỏi" class="form-control" name="questions">
          <?php
              echo form_error('questions', $errors);
            ?>
        </div>

        <div class="input-time">
          <input type="number" placeholder="Nhập vào số thời gian" class="form-control" name="time">
          <?php
              echo form_error('time', $errors);
            ?>
        </div>

        <div class="form-floating">
            <?php
            $sql = "SELECT * FROM `subjects`";
            $subjects = getRows($sql);
            ?>
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="subject">
              <option selected value="">Tất cả môn học</option>
              <?php
              if ($subjects) { // Kiểm tra xem $subjects có phải là mảng (không phải false) hay không
                foreach ($subjects as $row) {
                  echo "<option value='" . $row["id"] . "'>" . $row["name_subject"] . "</option>";
                }
              }
              ?>
            </select>
            <label for="floatingSelect">Môn học</label>
          </div>
          <span>
            <?php
              echo form_error('subject', $errors);
            ?>
            </span>

        <button type="submit" class="btn btn-primary login-btn-login">Ok</button>
      </form>
    </div>
  </div>
</section>

<?php
layouts('footer-logined');
?>