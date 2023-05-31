<?php
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'demo_php');

// Kiểm tra kết nối
if (!$conn) {
    die('Kết nối không thành công: ' . mysqli_connect_error());
}

// Lấy danh sách người dùng từ cơ sở dữ liệu
$sql = "SELECT * FROM employee";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý người dùng</title>
</head>
<body>
    <h1>Danh sách người dùng</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Ngày sinh</th>
            <th>Gender: </th>
            <th>Password: </th>
            <th>Position: </th>
            <th>Address: </th>
            <th>Thao tác</th>
        </tr>
        <?php
        // Hiển thị danh sách người dùng
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['birthdate'] . "</td>";
                echo "<td>" . $row['gender'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['position'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>";
                echo "<a href='edit.php?id=" . $row['id'] . "'>Sửa</a> | ";
                echo "<a href='delete.php?id=" . $row['id'] . "'>Xóa</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Không có người dùng</td></tr>";
        }
        ?>
    </table>

    <h2>Thêm người dùng</h2>

    <form action="add.php" method="POST">
        <label>Tên:</label>
        <input type="text" name="username" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Ngày Sinh:</label>
        <input type="date" name="birthdate" required><br>
        <label>Gender:</label>
        <select name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>Position:</label>
        <input type="text" name="position" required><br>
        <label>Address:</label>
        <input type="text" name="address" required><br>
        <input type="submit" value="Thêm">
        
        
    </form>
</body>
</html>