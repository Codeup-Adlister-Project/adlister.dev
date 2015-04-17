<!-- Displays a login form for the user, calls the Auth class, starts a session,and redirects to site upon success -->

<?php
	// Required Classes
	require_once '../utils/Auth.php';
	require_once '../utils/Input.php';

	// Start a session for the page
	session_start();

	// If user is already logged in, redirect to authorization page and don't run rest of PHP
	if(Auth::check()){
		header("Location: users.show.php");		// header() is a redirect function
		exit();
	}
	
	// If user is not logged in, ask for credentials
	$username = Input::has('username') ? Input::get('username') : '';
	$password = Input::has('password') ? Input::get('password') : '';
	$message = '';

	if($_POST) {

		Auth::attempt($username, $password);

		if(isset($_SESSION['LOGGED_IN_USER'])){
			// redirect to authorization page and exit() any remaining PHP script
			header("Location: users.show.php");
			exit();
		} else {
			$message = "Wrong username or password";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>POST,Session,Class</title>
</head>
<body>
	<? if(!empty($message)): ?>
		<h1><?= $message; ?></h1>
	<? endif; ?>
	<form method="POST" action="auth.login.php">
		<p>
			<label for="name">Username: </label>
			<input type="text" name="username" id="name">
		</p>
		<p>
			<label for="pswd">Password: </label>
			<input type="password" name="password" id="pswd">
		</p>
		<button type="submit">Submit</button>
	</form>
</body>
</html>