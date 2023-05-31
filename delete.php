<!-- delete.php -->
<?php
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'demo_php');

// Kiểm tra kết nối
if (!$conn) {
    die('Kết nối không thành công: ' . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa người dùng khỏi cơ sở dữ liệu
    $sql = "DELETE FROM employee WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Xóa người dùng thành công!";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

// Đóng kết nối
mysqli_close($conn);
?>