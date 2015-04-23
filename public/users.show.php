<!-- Displays a logged in user's profile -->

<?php
    // Require Classes and resume current session
    require_once($_SERVER['DOCUMENT_ROOT'].'../../bootstrap.php');

    // If user is logged in, get their username, otherwise redirect them to homepage
    if(Auth::check()){
        $user = Auth::user(); 
    } else {
        header("Location: index.php");
        exit();
    }
?>

<!doctype html>
<html lang="en-US" class="no-js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adlister | Profile</title>

<?php require_once '../views/partials/header.php'; ?>
</head>
<body>

<?php require_once '../views/partials/navbar.php'; ?>

	<h1>You are logged in <?= $user; ?>!</h1>
	<h3>Look at your beautiful profile page! @_@</h3>
	<ul>
		<li>Username: <?= $user; ?></li>
		<li><a href="users.edit.php">Change Password</a></li>
		<li>Email: <a href="users.edit.php">Change Email</a></li>
	</ul>

		<a href="users.edit.php"><button>Edit Profile</button></a>
        <a href="ads.create.php"><button>Create New Ad</button></a>
	
    <br>
    <hr>
    <h3>Your Ads:</h3>
<!-- Add a section that shows the user's posted ads -->


<?php require_once '../views/partials/footer.php'; ?>

</body>
</html>