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
<html>

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
			<h2>Register</h2>
		</div>

		<p class="msg" align="center">
			<?php
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$username = $_POST['username'];
					$password = $_POST['password'];
					$password = md5($password);
					$name = $_POST['name'];
					$email = $_POST['email'];
					$website = $_POST['website'];

					if (empty($username) or empty($password) or empty($name) or empty($email) or empty($website)) {
						echo "<span style='color:red;'>Fields must not be empty</span>";
					} else {
						$register = $user->registerUser($username, $password, $name, $email, $website);
					}
				}
			?>
		</p>
		<div class="login_reg">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table>
					<tr>
						<td>Username</td>
						<td><input type="text" name="username" placeholder="Please Enter username" /> </td>
					</tr>

					<tr>
						<td>Password</td>
						<td><input type="password" name="password" placeholder="Please Enter Password" /> </td>
					</tr>

					<tr>
						<td>Name</td>
						<td><input type="text" name="name" placeholder="Please Enter Name address" /> </td>
					</tr>


					<tr>
						<td>Email</td>
						<td><input type="text" name="email" placeholder="Please Enter email address" /> </td>
					</tr>

					<tr>
						<td>Website</td>
						<td><input type="text" name="website" placeholder="Please Enter Web address" /> </td>
					</tr>


					<tr>
						<td colspan="2">
							<input type="submit" name="register" value="Register" />

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