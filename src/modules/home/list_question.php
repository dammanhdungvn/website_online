<?php
if (!defined("_CODE")) {
  return die("Access denied");
}
?>

<?php

$data = [
  'pageTitle' => 'Ngân hàng câu hỏi',
];

layouts('header-logined', $data);


if (!isLogin()) {
  redirect('?module=auth&action=login');
}

?>

<?php
// Lấy danh sách môn học từ cơ sở dữ liệu
$sql = "SELECT * FROM `subjects`";
$subjects = getRows($sql);
// Lấy danh sách câu hỏi (ban đầu hiển thị tất cả)
$sql = "SELECT q.*, s.name_subject FROM `questions` q INNER JOIN `subjects` s ON q.subject_id = s.id";
$questions = getRows($sql);
?>

<form action="get" class="container" style="width: 200px;">
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
</form>
<div class="fui-table-ui-basic-linh table-wrap list_question">
  <div class="container">
    <table>
      <thead>
        <tr>
          <th>STT</th>
          <th>Câu hỏi</th>
          <th>Chức năng</th>
        </tr>
      </thead>
      <tbody id="question-list"> 
      <?php
        if ($questions) {
          foreach ($questions as $key => $row) {
            echo "<tr>";
            echo "<td>" . ($key + 1) . "</td>"; // Hiển thị STT bắt đầu từ 1
            echo "<td>" . $row["question"] . "</td>";
        ?>
            <td><a href="?module=home&action=delete_question&id=<?php echo $row['id']; ?>">Xóa</a></td> 
            <?php
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='3'>Không có câu hỏi nào.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script>
$(document).ready(function() {
  $("#floatingSelect").change(function() {
    var subject_id = $(this).val();
    $.ajax({
      url: "?module=home&action=get_questions", // Thay đổi đường dẫn AJAX
      type: "GET",
      data: { subject_id: subject_id },
      success: function(response) {
        $("#question-list").html(response);
      }
    });
  });
});
</script>



<?php
layouts('footer-logined');

?>