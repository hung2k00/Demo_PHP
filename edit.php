<?php
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'demo_php');

// Kiểm tra kết nối
if (!$conn) {
    die('Kết nối không thành công: ' . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin người dùng cần sửa
    $sql = "SELECT * FROM employee WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Người dùng không tồn tại!";
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $birth = $_POST['date'];
    $gt = $_POST['gt'];
    $pass = $_POST['pass'];
    $pos = $_POST['pos'];
    $dc = $_POST['dc'];
    $hash = md5($pass);

    // Cập nhật thông tin người dùng trong cơ sở dữ liệu
    $sql = "UPDATE employee SET username='$name', email='$email', birthdate='$birth', gender='$gt', password='$hash', position='$pos', address='$dc' WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Cập nhật thông tin người dùng thành công!";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

// Đóng kết nối
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sửa người dùng</title>
</head>

<body>
    <h1>Sửa người dùng</h1>

    <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])): ?>
        <form action="edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label>Tên:</label>
            <input type="text" name="name" value="<?php echo $row['username']; ?>" required><br>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
            <label>BirthDay:</label>
            <input type="date" name="date" value="<?php echo $row['birthdate']; ?>" required><br>
            <label>Gender:</label>
            <select name="gt" value="<?php echo $row['gender']; ?>"  required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br>
            <label>Password:</label>
            <input type="password" name="pass" value="<?php echo $row['password']; ?>"required><br>
            <label>Position:</label>
            <input type="text" name="pos" value="<?php echo $row['position']; ?>" required ><br>
            <label>Address:</label>
            <input type="text" name="dc" value="<?php echo $row['address']; ?>" required ><br>
            <input type="submit" value="Lưu">
        </form>
    <?php endif; ?>
</body>

</html>