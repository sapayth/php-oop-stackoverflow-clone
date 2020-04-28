<?php
session_start();
ob_start();
include 'register_globals.php';
register_globals();
require_once "functions.php";
$user = new LogingRegistration();
$uid = $_SESSION['uid'];
$password = "";

if (!$user->getSession()) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>PHP OOP - Change Password</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
	<div class="wrapper">

		<div class="mainmenu">
			<ul>
				<?php if ($user->getSession()) {?>
				<li><a href="index.php"> Home</a></li>
				<li><a href="profile.php"> Show Profile</a></li>
				<li><a href="ChangePassword.php">Change Password</a></li>
				<li><a href="logout.php">Logout</a></li>

				<?php } else {?>

				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Register</a></li>
				<?php }?>
			</ul>
		</div>

		<div class="content" style="display: block;">
			<h2> Change Your Password</h2>
			<p class="msg" align="center">
				<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						$password = md5($password);

						$old_pass = $_POST['old_password'];
						$new_pass = $_POST['new_password'];
						$confirm_pass = $_POST['confirm_password'];

						if (empty($old_pass) or empty($new_pass) or empty($confirm_pass)) {
							echo "<span style='color:red;'>Error ...Field must not be empty</span>";
						} else if ($new_pass != $confirm_pass) {
							echo "<span style='color:red;'>Password Not Matched</span>";
						} else {
							$old_pass = md5($old_pass);
							$new_pass = md5($new_pass);
							$passUpdate = $user->updatePassword($uid, $new_pass, $old_pass);
						}
					}
				?>
			</p>

			<div class="login_reg">
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="reg">
					<table>
						<tr>
							<td>Old Password </td>
							<td><input type="text" name="old_password" palceholder="Please Enter Your Old  Password" />
							</td>
						</tr>
						<tr>
							<td>New Password</td>
							<td><input type="text" name="new_password" palceholder="please Enter Your New Password" />
							</td>
						</tr>
						<tr>
							<td>Confirm:</td>
							<td><input type="text" name="confirm_password" palceholder="Please Type Password Again" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" name="update" value="Update" />
							</td>
						</tr>
					</table>
				</form>
			</div>

			<div class="back">
				<a href="index.php" class="back-button"> Go Back </a>
			</div>
		</div>
</body>

</html>