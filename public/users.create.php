<!-- Displays a form to create a user in the database -->

<?php
	// Require Classes and start a session for the page
	require_once($_SERVER['DOCUMENT_ROOT'].'../../bootstrap.php');
	
	// If user is already logged in, redirect to profile page and don't run rest of PHP
	if(Auth::check()){
		header("Location: users.show.php");
		exit();
	}
?>

<!doctype html>
<html lang="en-US" class="no-js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adlister | Home</title>

<?php require_once '../views/partials/header.php'; ?>
</head>
<body>

<?php require_once '../views/partials/navbar.php'; ?>

<h2>Create an Account</h2>
<form method="POST" action=''>
	<p>
		<input type='text' name='username' value='' placeholder='Username' required></input>
	</p>
	<p>
		<input type='password' name='password' value='' placeholder='Password' required></input>
	</p>
	<p>
		<input type='password' name='confirmPass' value='' placeholder='Confirm Password' required></input>
	</p>
	<p>
		<input type='text' name='email' value='' placeholder='Email' required></input>
	</p>
		<input type='submit' name='submit' value='Submit'></input>


<!-- Need to add an image-upload feature for profile photo here -->

<?php require_once '../views/partials/footer.php'; ?>
    <script src="/js/vendor/jquery.js"></script>
    <script src="/js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>
	
</form>