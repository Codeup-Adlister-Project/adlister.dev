<!-- Displays a login form for the user, calls the Auth class, starts a session,and redirects to site upon success -->

<?php
	// Require Classes and start a session for the page
	require_once($_SERVER['DOCUMENT_ROOT'].'../../bootstrap.php');


	// If user is already logged in, redirect to profile page and don't run rest of PHP
	if(Auth::check()){
		header("Location: users.show.php");
		exit();
	}
	
	// If user is not logged in, ask for credentials
	$username = Input::has('username') ? Input::get('username') : '';
	$password = Input::has('password') ? Input::get('password') : '';
	$errorMessage = '';

	if($_POST) {

		Auth::attempt($username, $password);

		if(isset($_SESSION['LOGGED_IN_USER'])){
			// redirect to authorization page and exit() any remaining PHP script
			header("Location: users.show.php");
			exit();
		} else {
			$errorMessage = "Wrong username or password";
		}
	}

?>

<?php if(!empty($errorMessage)): ?>
	<h1><?= $errorMessage; ?></h1>
<?php endif; ?>
<h2 id="login">Log in</h2>
<form method="POST" action="#">
	<label for="name">Username</label>
	<input type="text" name="username" id="name" />
	<label for="pswd">Password</label>
	<input type="password" name="password" id="pswd" />
	<input type="submit" class="button small radius" value="Get posting!" />
</form>
