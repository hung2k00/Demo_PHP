<?php
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'demo_php');

// Kiểm tra kết nối
if (!$conn) {
    die('Kết nối không thành công: ' . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $birth = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $position = $_POST['position'];
    $address = $_POST['address'];
    $hash = md5($password);
    // Thêm người dùng vào cơ sở dữ liệu
    $sql = "INSERT INTO employee (username, email, birthdate, gender, password, position, address) 
    VALUES ('$name', '$email', '$birth', '$gender', '$hash', '$position', '$address')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Thêm người dùng thành công!";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

// Đóng kết nối
mysqli_close($conn);
?>