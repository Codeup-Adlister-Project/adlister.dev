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
    <title>Adlister | Edit Profile</title>

<?php require_once '../views/partials/header.php'; ?>
</head>
<body>

<?php require_once '../views/partials/navbar.php'; ?>

<section class="form">
    <div class="row">
        <div class="small-12 columns">
            <h2>Edit Profile</h2>
            <form method="POST" action=''>
            	<p>
            		<input type='text' name='username' value='' placeholder='Username' required />
            	</p>
            	<p>
            		<input type='password' name='password' value='' placeholder='Current Password' required />
            	</p>
            	<p>
            		<input type='password' name='password' value='' placeholder='New Password' required />
            	</p>
            	<p>
            		<input type='password' name='confirmPass' value='' placeholder='Confirm New Password' required />
            	</p>
            	<p>
            		<input type='text' name='email' value='' placeholder='Email' required />
            	</p>
            		<input type='submit' name='submit' value='Submit' />
            	
            <!-- Need to add an image-upload feature that alters profile photo here -->

            </form>
        </div>
    </div>
</section>

<?php require_once '../views/partials/footer.php'; ?>

</body>
</html>


