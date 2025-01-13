<?php

if (isset($_GET["subject_id"])) {
  $subject_id = $_GET["subject_id"];

  if ($subject_id == "") {
    $sql = "SELECT q.*, s.name_subject FROM `questions` q INNER JOIN `subjects` s ON q.subject_id = s.id";
  } else {
    $sql = "SELECT q.*, s.name_subject FROM `questions` q INNER JOIN `subjects` s ON q.subject_id = s.id WHERE q.subject_id = $subject_id";
  }

  $questions = getRows($sql);

  if ($questions) {
    foreach ($questions as $key => $row) { // Thêm $key cho STT
      echo "<tr>";
      echo "<td>" . ($key + 1) . "</td>"; // Hiển thị STT
      echo "<td>" . $row["question"] . "</td>";
      ?>
    <td><a href="?module=home&action=delete_question&id=<?php echo $row['id']; ?>">Xóa</a></td> 

      <?php
      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='3'>Không có câu hỏi nào.</td></tr>";
  }
}
?>