<?php 
if (!defined("_CODE") ) {
  return die("Access denied");
}
?>

<?php

  $data = [
    'pageTitle' => 'Kết quả kiểm tra',
  ];

  layouts('header-logined', $data);
  

  if (!isLogin()) {
    redirect('?module=auth&action=login');
  }

?>

<?php
  $sql = "SELECT * FROM `SCORE`;";
  $scores = getRows($sql);
?>

<!-- CSS -->
<style>
    tr {
        display: grid; grid-template-columns: repeat(3, 1fr);
    }

</style>

<div class="fui-table-ui-basic-linh table-wrap list_question">
  <div class="container">
  <table style="width: 100%;">
    <thead>
      <tr>
        <th>Lần thi</th>
        <th>Số câu làm đúng / tổng số câu hỏi</th>
        <th>Ngày thi</th>
      </tr>
    </thead>
    <tbody>
        <?php

        for ($i = 0; $i < count($scores); $i++) {
            $id = $scores[$i]['ID'];
            $score = $scores[$i]['POINT'];
            $questions = $scores[$i]['QUESTIONS'];
            $date = $scores[$i]['CREATED_AT'];
        ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $score; ?>/<?php echo $questions ?></td>
            <td><?php echo $date; ?></td>
        </tr>
        <?php } ?>
    </tbody>
  </table>
  </div>
</div>



<?php
  layouts('footer-logined');
?>