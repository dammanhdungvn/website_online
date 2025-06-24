
<?php
// Hàm INSERT
function insertData($table, $data) {
  global $conn;
  // Tạo danh sách cột và giá trị
  $columns = implode(", ", array_keys($data));
  $values = "'" . implode("', '", array_values($data)) . "'";

  // Tạo câu lệnh SQL
  $sql = "INSERT INTO $table ($columns) VALUES ($values)";

  // Thực thi câu lệnh
  if (mysqli_query($conn, $sql)) {
    return true;
  } else {
    return false;
  }
}

// Hàm UPDATE
function updateData($table, $data, $where) {
  global $conn;
  // Tạo danh sách cập nhật
  $updates = "";
  foreach ($data as $key => $value) {
    $updates .= "$key = '$value', ";
  }
  $updates = rtrim($updates, ", ");

  // Tạo câu lệnh SQL
  $sql = "UPDATE $table SET $updates WHERE $where";

  // Thực thi câu lệnh
  if (mysqli_query($conn, $sql)) {
    return true;
  } else {
    return false;
  }
}

// Hàm SELECT
function selectData($conn, $table, $columns = "*", $where = null, $order = null, $limit = null) {
  // Tạo câu lệnh SQL
  $sql = "SELECT $columns FROM $table";
  if ($where) {
    $sql .= " WHERE $where";
  }
  if ($order) {
    $sql .= " ORDER BY $order";
  }
  if ($limit) {
    $sql .= " LIMIT $limit";
  }

  // Thực thi câu lệnh
  $result = mysqli_query($conn, $sql);

  // Trả về kết quả
  if ($result) {
    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    return $rows;
  } else {
    echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    return false;
  }
}

// Hàm DELETE
function deleteData($table, $where) {
  global $conn;
  // Tạo câu lệnh SQL
  $sql = "DELETE FROM $table WHERE $where";

  // Thực thi câu lệnh
  if (mysqli_query($conn, $sql)) {
    return true;
  } else {
    return false;
  }
}

// Lấy nhiều dòng dữ liệu
function getRows($sql) {
  global $conn;
  $result = mysqli_query($conn, $sql);
  if (!$result) {
      return false; // Trả về false nếu truy vấn thất bại
  }

  $arr = [];
  while ($row = mysqli_fetch_assoc($result)) {
      $arr[] = $row;
  }
  return $arr; // Trả về mảng dữ liệu
}

// Lấy một dòng dữ liệu
function getRow($sql) {
  global $conn;
  $result = mysqli_query($conn, $sql);
  if (!$result) {
      return false; // Trả về false nếu truy vấn thất bại
  }

  return mysqli_fetch_assoc($result); // Trả về một dòng dữ liệu (mảng liên kết)
}

  // Đếm số lượng dòng 
  function countRows($sql) {
    global $conn;
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        return false; // Trả về false nếu truy vấn thất bại
    }
    return mysqli_num_rows($result); // Trả về số dòng
  }


?>
