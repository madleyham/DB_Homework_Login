		<?PHP
	session_start();
	// Create connection to Oracle
	$conn = oci_connect("system", "560610571", "//localhost/XE");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 
?>
Change Password
<hr>

<?PHP
	if(isset($_POST['changepass']))
	{
		$old_pass = trim($_POST['oldpass']);
		$new_pass = trim($_POST['newpass']);
		$query = "SELECT PASSWORD FROM AA_LOGIN WHERE password ='$old_pass'";
		$parseRequest = oci_parse($conn, $query);
		oci_execute($parseRequest);
		// Fetch each row in an associative array
		$row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC);
		if($row)
		{
			$query = "UPDATE AA_LOGIN SET password ='$new_pass' WHERE password ='$old_pass'";
			$parseRequest = oci_parse($conn, $query);
			oci_execute($parseRequest);
			echo '<script>window.location = "MemberPage.php";</script>';
		}
		else
		{
		 echo "Change Password fail.";
		}
	};
	oci_close($conn);
?>

<form action='Changepass.php' method='post'>
	Set new password<br><br>
	Old Password <br>
	<input name='oldpass' type='password'><br><br>
	New Password <br>
	<input name='newpass' type='password'><br><br>
	<input name='changepass' type='submit' value='Change Password'>
</form>