
<table border="1" align="center">
<tr>

<td>username</td>
<td>Họ và tên</td>
<td>năm sinh</td>
<td>Phonennumber</td>
<td>Password</td>
<td>email</td>
<td>Quyền</td>
<td>Ghi chú</td>
<td>chỉnh sửa</td>
<td>xóa</td>

</tr>
<?php
require 'connect.php';
if(isset($_GET["action"])){
	$tensach=$_GET["tk"];
	$query=mysqli_query($conn,("SELECT * FROM `user` WHERE (`username`) LIKE('%$username%')"));
while($row=mysqli_fetch_array($query)){
?>

<tr>
<td><?php echo $row[0]; ?></td>
<td><?php echo $row[1]; ?></td>
<td><?php echo $row[2]; ?></td>
<td><?php echo $row[3]; ?></td>
<td><?php echo $row[4]; ?></td>
<td><?php echo $row[5]; ?></td>
<td><?php echo $row[6]; ?></td>
<td><?php echo $row[7]; ?></td>
<td><a href="giaodien/edit_user.php?id=<?php echo $row['username']; ?>">Edit</a></td>
<td><a href="giaodien/delete_user.php?id=<?php echo $row['username']; ?>">Delete</a></td>

</tr>
 

<?php
}}
?>
</table>