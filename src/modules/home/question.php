<?php
if (!defined("_CODE")) {
  return die("Access denied");
}

if (!isLogin()) {
  redirect('?module=auth&action=login');
}

$data = [
  'pageTitle' => 'Thêm câu hỏi',
];
?>

<?php


layouts('header-logined', $data);
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$oldData = getFlashData('oldData');
?>

<section class="register">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="title">Thêm câu hỏi</h1>
        <?php
        if (!empty($msg)) {
          getMsg($msg, $msg_type);
        }
        ?>

        <form id="questionForm" action="?module=home&action=query_add_question" method="post" class="form-login">
          <!-- Nhập đề bài -->
          <textarea id="question" name="question" class="form-control" required><?php echo trim(form_value('question', $oldData)); ?></textarea>

          <!-- Nhập đáp án và chọn đáp án đúng -->
          <div class="answers">
            <div>
              <input type="text" name="answers[0][text]" class="form-control" placeholder="Đáp án A" required
                value="<?php echo form_value('answers[0][text]', $oldData); ?>">

              <input type="hidden" name="answers[0][is_correct]" value="0">

              <!-- Thêm kiểm tra và đánh dấu radio nếu giá trị đúng đã chọn là 0 -->
              <input type="radio" name="correct_answer" value="0" class="form-check-input"
                <?php echo (isset($oldData['correct_answer']) && $oldData['correct_answer'] == 0) ? 'checked' : ''; ?>>
            </div>

            <div>
              <input type="text" name="answers[1][text]" class="form-control" placeholder="Đáp án B" required
                value="<?php echo form_value('answers[1][text]', $oldData); ?>">

              <input type="hidden" name="answers[1][is_correct]" value="0">

              <!-- Thêm kiểm tra cho đáp án đúng đã chọn là 1 -->
              <input type="radio" name="correct_answer" value="1" class="form-check-input"
                <?php echo (isset($oldData['correct_answer']) && $oldData['correct_answer'] == 1) ? 'checked' : ''; ?>>
            </div>

            <div>
              <input type="text" name="answers[2][text]" class="form-control" placeholder="Đáp án C" required
                value="<?php echo form_value('answers[2][text]', $oldData); ?>">

              <input type="hidden" name="answers[2][is_correct]" value="0">

              <!-- Thêm kiểm tra cho đáp án đúng đã chọn là 2 -->
              <input type="radio" name="correct_answer" value="2" class="form-check-input"
                <?php echo (isset($oldData['correct_answer']) && $oldData['correct_answer'] == 2) ? 'checked' : ''; ?>>
            </div>

            <div>
              <input type="text" name="answers[3][text]" class="form-control" placeholder="Đáp án D" required
                value="<?php echo form_value('answers[3][text]', $oldData); ?>">

              <input type="hidden" name="answers[3][is_correct]" value="0">

              <!-- Thêm kiểm tra cho đáp án đúng đã chọn là 3 -->
              <input type="radio" name="correct_answer" value="3" class="form-check-input"
                <?php echo (isset($oldData['correct_answer']) && $oldData['correct_answer'] == 3) ? 'checked' : ''; ?>>
            </div>
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

          <button type="submit" class="btn btn-primary">Thêm câu hỏi</button>
        </form>

      </div>
    </div>
  </div>
</section>

<script>
  function setCorrectAnswer(index) {
    // Đặt lại tất cả các đáp án về 0
    const hiddenInputs = document.querySelectorAll('input[type="hidden"][name^="answers"]');
    hiddenInputs.forEach(input => input.value = "0");

    // Đặt giá trị của đáp án được chọn thành 1
    const correctInput = document.querySelector(`input[type="hidden"][name="answers[${index}][is_correct]"]`);
    if (correctInput) {
      correctInput.value = "1";
    }
  }
</script>

<?php
layouts('footer-logined', $data);

?>