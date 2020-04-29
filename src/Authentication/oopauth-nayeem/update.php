<?php
session_start();
ob_start();
include 'register_globals.php';
register_globals();
require_once "functions.php";
$user = new LogingRegistration();
$uid = $_SESSION['uid'];
$username = $_SESSION['uname'];
$password = "";

if (!$user->getSession()) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>PHP OOP - Update Profile</title>
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
			<h2> Update Your Profile</h2>
			<p class="msg" align="center">

				<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						$username = $_POST['username'];
						$password = md5($password);
						$name = $_POST['name'];
						$email = $_POST['email'];
						$website = $_POST['website'];
						if (empty($username) or empty($name) or empty($email) or empty($website)) {
							echo "<span style='color:red;'>Fields Must not be empty</span>";
						} else {

							$update = $user->updateUser($uid, $username, $name, $email, $website);
							if ($update) {
								echo "<span style='color:green;'>Profile Updated successfully</span>";
							}

						}
					}
				?>

			</p>

			<?php
				$result = $user->getUserdetails($uid);
				foreach ($result as $row) {
			?>
			<div class="login_reg">
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="reg">
					<table>
						<tr>
							<td>Username</td>
							<td><input type="text" name="username" value="<?php echo $row['username']; ?>" /></td>
						</tr>

						<tr>
							<td>Name</td>
							<td><input type="text" name="name" value="<?php echo $row['name']; ?>" /></td>
						</tr>


						<tr>
							<td>Email</td>
							<td><input type="text" name="email" value="<?php echo $row['email']; ?>" /> </td>
						</tr>

						<tr>
							<td>Website</td>
							<td><input type="text" name="website" value="<?php echo $row['website']; ?>" /> </td>
						</tr>

						<tr>
							<td colspan="2">
								<input type="submit" name="update" value="Update" />

							</td>
						</tr>

					</table>
				</form>
			</div>
			<?php }?>

		</div>
		<div class="back">
			<a href="index.php" class="back-button"> Go Back </a>
		</div>
	</div>
</body>

</html>