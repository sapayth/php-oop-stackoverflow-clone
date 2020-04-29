<?php
session_start();
ob_start();
require_once "functions.php";
$user = new LogingRegistration();

if ($user->getSession()) {
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html >

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>PHP OOP - Ragistration Page</title>
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

		<div class="content">
			<h2>Login</h2>
		</div>
		<p class="msg" align="center">
			<span class="login_msg">
				<?php
					if (isset($_GET['response'])) {
						if ($_GET['response'] == 1) {
							echo "Successfuly Logged Out";
						}
					}
				?>
			</span>
			<?php
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$email = $_POST['email'];
					$password = $_POST['password'];
					$password = md5($password);

					if (empty($password) or empty($email)) {
						echo "<span style='color:red;'>Field Must not be empty</span>";
					} else {
						$login = $user->loginUser($email, $password);
						if ($login) {
							header('Location: index.php');
						} else {
							echo "<span style='color:red;'>Invalid Credentials</span>";
						}
					}
				}
			?>
		</p>
		<div class="login_reg">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table>
					<tr>
						<td>Email</td>
						<td><input type="text" name="email" placeholder="Please Enter email address" /> </td>
					</tr>

					<tr>
						<td>Password</td>
						<td><input type="password" name="password" placeholder="Please Enter Password" /> </td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="login" value="Login" />
							<input type="reset" value="Reset" />
						</td>
					</tr>
				</table>
			</form>
		</div>

		<div>
		<div class="back">
			<a href="index.php" class="back-button"> Go Back </a>
		</div>
	</div>
</body>

</html>