<?php
session_start();
ob_start();
include 'register_globals.php';
register_globals();
require_once "functions.php";
$user = new LogingRegistration();
$uid = $_SESSION['uid'];
$username = $_SESSION['uname'];

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
} else {
    header('Location: index.php');
}

if (!$user->getSession()) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html >

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>PHP OOP - User Profile</title>
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
			<span class="login_msg" align="center">
			</span>
			<h2>Welcome, <span style="color:green;"><?php echo $username; ?></h2></span>
			<p class="userlist"> Profile of :<?php $user->getUsername($id);?> </p>
			<table class="tbl_one">
				<?php
					$getUser = $user->getUserByid($id);
					foreach ($getUser as $user) {
				?>

				<tr>
					<td>User Name</td>
					<td><?php echo $user['username']; ?></td>
				</tr>
				<tr>
					<td>Name</td>
					<td><?php echo $user['name']; ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><?php echo $user['email']; ?></td>
				</tr>
				<tr>
					<td>Web Site</td>
					<td><?php echo $user['website']; ?></td>
				</tr>
				<?php
					if ($user['id'] == $uid) {
				?>
				<tr>
					<td>Update Profile</td>
					<td><a href="update.php?id=<?php echo $user['id']; ?>">Edit Profile</a></td>
				</tr>
				<?php }?>

				<?php }?>
			</table>
		</div>

		<div class="back">
				<a href="index.php" class="back-button"> Go Back </a>
			</div>
		</div>

	</div>
</body>

</html>