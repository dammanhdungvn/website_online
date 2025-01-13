<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btl_web_humg";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    echo json_encode(["error" => "Failed to connect to database"]);
    exit();
}

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : null;
$skip = isset($_GET['skip']) ? intval($_GET['skip']) : null;
$skip -= $skip;
$subject = isset($_GET['subject']) ? intval($_GET['subject']) : null;

// Lấy câu hỏi và câu trả lời trong một truy vấn
$sql_questions = "SELECT 
    q.id AS quiz_id, 
    q.question,
    GROUP_CONCAT(a.answer) AS answers,
    (SELECT answer FROM answers WHERE question_id = q.id AND is_correct = 1) AS correct_answer
FROM questions q
LEFT JOIN answers a ON q.id = a.question_id";

if ($subject) {
    $sql_questions .= " WHERE q.subject_id = '$subject'";
}

$sql_questions .= " GROUP BY q.id";

if ($limit) {
    $sql_questions .= " LIMIT $limit";
}

if ($skip) {
    $sql_questions .= " OFFSET $skip";
}

$result_questions = mysqli_query($conn, $sql_questions);

$questions = [];
$correct_answers = [];

if (mysqli_num_rows($result_questions) > 0) {
    while ($row = mysqli_fetch_assoc($result_questions)) {
        // Xử lý câu hỏi và câu trả lời
        $questions[] = [
            "quiz_id" => $row['quiz_id'],
            "question" => $row['question'],
            "answers" => $row['answers'] ? explode(',', $row['answers']) : []
        ];

        // Xử lý đáp án đúng
        if ($row['correct_answer']) {
            $correct_answers[] = [
                "quiz_id" => $row['quiz_id'],
                "answer" => $row['correct_answer']
            ];
        }
    }
}

// Kết hợp hai mảng
$response = [
    "questions" => $questions,
    "correct_answers" => $correct_answers
];

// Trả về JSON
echo json_encode($response, JSON_PRETTY_PRINT);

mysqli_close($conn);
?>