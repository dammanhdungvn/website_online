<?php
if (!defined("_CODE")) {
    die("Access denied");
}

$data = [
    'pageTitle' => 'Đang thêm câu hỏi',
];

layouts('header-logined', $data);

if (!isLogin()) {
    redirect('?module=auth&action=login');
}

// Kiểm tra nếu dữ liệu được gửi qua phương thức POST
if (isPost()) {
    // Lấy dữ liệu từ form
    $filterAll = filter();
    $question_text = trim($filterAll['question']);
    $answers = $filterAll['answers'];
    $subject = trim($filterAll['subject']);  // Lấy giá trị môn học từ form

    // Kiểm tra nếu 'correct_answer' có tồn tại trong $_POST
    if (!isset($filterAll['correct_answer'])) {
        setFlashData('msg', "Bạn chưa chọn đáp án đúng");
        setFlashData('msg_type', 'danger');
        setFlashData('oldData', $filterAll);
        redirect('?module=home&action=question');
    }

    $correct_index = intval($filterAll['correct_answer']); // Đảm bảo là số nguyên

    // Kiểm tra dữ liệu nhập vào câu hỏi
    if (empty($question_text) || ctype_space($question_text) || strlen($question_text) === 0) {
        setFlashData('msg', "Câu hỏi không hợp lệ!");
        setFlashData('msg_type', 'danger');
        setFlashData('oldData', $filterAll);
        redirect('?module=home&action=question');
    }

    if (!$subject) {
        setFlashData('msg', "Chọn môn học!");
        setFlashData('msg_type', 'danger');
        setFlashData('oldData', $filterAll);
        redirect('?module=home&action=question');
    }

    // Kiểm tra đáp án
    foreach ($answers as $index => $answer) {
        $answer_text = trim($answer['text']); // Loại bỏ khoảng trắng

        // Kiểm tra nếu đáp án trống hoặc chỉ có khoảng trắng
        if (empty($answer_text) || ctype_space($answer_text)) {
            setFlashData('msg', "Đáp án không được để trống hoặc chỉ chứa khoảng trắng.");
            setFlashData('msg_type', 'danger');
            setFlashData('oldData', $filterAll);
            redirect('?module=home&action=question');
        }
    }

    // Thêm câu hỏi vào bảng `questions`
    $query = "INSERT INTO questions (question, subject_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $question_text, $subject);

    if (mysqli_stmt_execute($stmt)) {
        $question_id = mysqli_insert_id($conn);

        // Thêm các đáp án vào bảng `answers`
        $query = "INSERT INTO answers (question_id, answer, is_correct) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        foreach ($answers as $index => $answer) {
            $answer_text = trim($answer['text']); // Loại bỏ khoảng trắng
            $is_correct = ($index === $correct_index) ? 1 : 0;
            mysqli_stmt_bind_param($stmt, "isi", $question_id, $answer_text, $is_correct);
            mysqli_stmt_execute($stmt);
        }

        setFlashData('msg', "Thêm câu hỏi và đáp án thành công!");
        setFlashData('msg_type', 'success');
    } else {
        setFlashData('msg', "Lỗi khi thêm câu hỏi!");
        setFlashData('msg_type', 'danger');
        setFlashData('oldData', $filterAll);
    }

    // Redirect sau khi xử lý
    redirect('?module=home&action=question');
}

?>