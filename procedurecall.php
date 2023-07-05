<?php
include('config.php');
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$contact=$_POST['contact'];
$addrss=$_POST['addrss'];
// This is how to create store procedure for insertion start
// DELIMITER $
// CREATE PROCEDURE insertuser
// (IN name VARCHAR(255), IN email VARCHAR(255), IN contactno BIGINT, IN addrss LONGTEXT)
//  insert into user(name,email,contactno,addrss) VALUES(name,email,contactno,addrss)$
// Code for execute the Store Procedure
// Argument Modes
// IN : Data Values comes in form the calling process and is not changed.
// OUT : No Data Value comes in form the calling process; on normal exit, value of argument is passed back to caller.
// IN OUT : Data Values comes in form the calling process, and another value is returned on normal exit.
// This is how to create store procedure for insertion start
$sql=mysqli_query($con,"CALL insertuser('$name','$email','$contact','$addrss')");
if($sql)
{
echo "<script>alert('Data Inserted');</script>";
}
else
{
echo "<script>alert('not inserted');</script>";
}
 }

 

?>
<form name="stmt" method="post">
<table>
<tr>
<td>Name :</td>
<td><input type="text" name="name" required="required" /> </td>
</tr>
<tr>
<td>Email :</td>
<td><input type="email" name="email" required="required" /></td>
</tr>
<tr>
<td>Contact no. :</td>
<td><input type="text" name="contact" required="required" /></td>
</tr>
<tr>
<td>Address :</td>
<td><textarea name="addrss" cols="30" rows="4" required="required"></textarea></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="submit" value="Submit" /></td>
</tr>
</table>
</form>
<table>
	<thead>
	<th>Id</th>
	<th>Name</th>
	<th>email</th>
	<th>contact</th>
	<th>address</th>
	</thead>
	
	<?php 
	$getdata=mysqli_query($con,"CALL fetechuser()");

	while($getuser=mysqli_fetch_array($getdata)) {
		
	 ?><tr>
	 	<td><?php echo $getuser['id']; ?></td>
		<td><?php echo $getuser['name']; ?></td>
		<td><?php echo $getuser['email']; ?></td>
		<td><?php echo $getuser['contactno']; ?></td>
		<td><?php echo $getuser['addrss']; ?></td>



		<?php }?>
	</tr>
</table>
<?php 
$getiddata=mysqli_query($con,"CALL getiddata()");
$getiduser=mysqli_fetch_array($getiddata);
	print_r($getiduser);
?>