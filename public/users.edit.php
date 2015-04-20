<!-- Displays a form containing user data from database, and updates the database with changed input -->

<?php
  	// Require Classes and resume current session
	require_once($_SERVER['DOCUMENT_ROOT'].'../../bootstrap.php');
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

<h2>Edit Profile</h2>
<form method="POST" action=''>
	<p>
		<input type='text' name='username' value='' placeholder='Username' required></input>
	</p>
	<p>
		<input type='password' name='password' value='' placeholder='Current Password' required></input>
	</p>
	<p>
		<input type='password' name='password' value='' placeholder='New Password' required></input>
	</p>
	<p>
		<input type='password' name='confirmPass' value='' placeholder='Confirm New Password' required></input>
	</p>
	<p>
		<input type='text' name='email' value='' placeholder='Email' required></input>
	</p>
		<input type='submit' name='submit' value='Submit'></input>
	


<!-- Need to add an image-upload feature that alters profile photo here -->


<?php require_once '../views/partials/footer.php'; ?>
    <script src="/js/vendor/jquery.js"></script>
    <script src="/js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>


</form>