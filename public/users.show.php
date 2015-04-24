<!-- Displays a logged in user's profile -->

<?php
    // Require Classes and resume current session
    require_once($_SERVER['DOCUMENT_ROOT'].'../../bootstrap.php');

    // If user is not logged in, and gets to this page manually, redirect them to homepage
    if(!Auth::check()){
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

<section id="account">
    <div class="row">
        <div class="small-12 columns">
            <h5 class="featured">My Account</h5>
        </div>
    </div> 
    <div class="row">
        <div class="small-12 columns">
        	<h2>Hello, <?= $userArray['username']; ?>!</h2>
        	<ul>
        		<li><span class="pre">Username: </span><?= $userArray['username']; ?></li>
        		<li><span class="pre">Email: </span><?= $userArray['contact_email']; ?></li>
                <li><span class="pre">Member since: </span><?= $userArray['date_created']; ?></li>
        	</ul>

    		<a href="users.edit.php" class="button small radius">Edit Profile</a>
            <a href="ads.create.php" class="button small radius">Create New Ad</a>
        	
            <hr>
            <h3>My Ads</h3>
            <!-- Add a section that shows the user's posted ads -->
        </div>
    </div>
</section>

<?php require_once '../views/partials/footer.php'; ?>

</body>
</html>