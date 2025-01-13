<?php
if (!defined("_CODE")) {
  return die("Access denied");
}

$data = [
  'pageTitle' => 'Kiểm tra',
];

if (!isLogin()) {
  redirect('?module=auth&action=login');
}
layouts('header-kiemtra', $data);
?>
<section class="kiemtra">
  <div class="container" style="width: auto;
      height: auto;">
    <div class="quiz_wrapper col-12">
      <div class="quiz_header">
        <div class="quiz_timer">
          <i class="fa-regular fa-clock"></i>
          <div class="quiz_timer_text">
            <span>Time remaining</span>
            <p id="timer">14:00:00</p>
          </div>
        </div>
        <button id="quiz_submit">SUBMIT</button>
      </div>
      <div class="quiz_container">
        <div class="quiz_question">
          <h5>Question 1 of 10</h5>
          <p id="quiz_title">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum
            delectus et magni harum atque, ex nostrum quaerat?
          </p>
          <ul>
            <li><span>A.</span><span class="quiz_answer_item">harum</span></li>
            <li><span>B.</span><span class="quiz_answer_item">harum</span></li>
            <li><span>C.</span><span class="quiz_answer_item">harum</span></li>
            <li><span>D.</span><span class="quiz_answer_item">harum</span></li>
          </ul>
        </div>
        <div class="quiz_progress">
          <svg>
            <circle r="50"></circle>
            <circle id="progress" r="50"></circle>
          </svg>
          <span id="progress_text">9/10</span>
        </div>
      </div>
      <div class="quiz_numbers">
        <button id="quiz_prev">Prev</button>
        <ul></ul>
        <button id="quiz_next">Next</button>
      </div>
    </div>
  </div>

</section>

<script>
  var time = <?php echo json_encode(getSession('time') ?? 60); ?>; // Mặc định là 60 giây
  var questions = <?php echo json_encode(getSession('questions') ?? []); ?>; // Mặc định là mảng rỗng
</script>

<?php

// Số thời gian
$time = getSession('time');

//Số lượng câu hỏi
$questions = getSession('questions');

//skip câu hỏi
$skip = getSession('skip');

//Môn học
$subject = getSession('subject');

//API data
$url = _HOST . _WEB . '/API/data.php?limit=' . $questions . '&skip=' . $skip . '&subject=' . $subject;

removeSession('time');
removeSession('skip');
?>
<script>
  var timer = <?php echo json_encode($time); ?>; // Giá trị từ PHP
  timer = parseInt(time, 10); // Ép kiểu thành số nguyên

  var url = <?php echo json_encode($url); ?>;
</script>

<?php
layouts('footer-kiemtra');
?>