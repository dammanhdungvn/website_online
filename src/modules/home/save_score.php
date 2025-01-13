<?php
if (isPost()) {
  $data = json_decode(file_get_contents('php://input'), true);
  $score = $data['score']; 
  $questions = getSession('questions');
    removeSession('questions');

    $insData = [
        'POINT' => $score,
        'QUESTIONS' => $questions
    ];

    $statusInsert = insertData('SCORE', $insData);

    if ($statusInsert) {
        echo "Điểm số đã được lưu: " . $score; 
    }
    else {
        echo "Điểm số chưa được lưu: " . $score; 
    }
}
?>