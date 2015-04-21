<!-- Displays a logged in user's profile -->

<?php
    // Require Classes and resume current session
    require_once($_SERVER['DOCUMENT_ROOT'].'../../bootstrap.php');

    if(Auth::check()){
        $user = Auth::user(); 
    } else {
        header("Location: auth.login.php");
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

	<form action="users.edit.php">
		<input type='submit' value="Edit Profile">
	</form>
    <br>
    <hr>
    <h3>Your Ads:</h3>
<!-- Add a section that shows the user's posted ads -->


<?php require_once '../views/partials/footer.php'; ?>
    <script src="/js/vendor/jquery.js"></script>
    <script src="/js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>