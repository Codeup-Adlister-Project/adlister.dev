<?php require_once '../bootstrap.php'; ?>

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

<section id="homepage-hero">

    <div class="row">
        <div class="medium-12 columns">
            <h1 class="hero">Unlimited free ad listing. <br class="hide-for-small">Local and world-wide.</h1>
            <h3 class="call">View our featured ads&nbsp;below.</h3>
        </div>
    </div>

    <div class="row main-button">
        <!-- If user already logged in, show 'create new ad' and 'view all ads' buttons -->
        <?php if(Auth::check()) { ?>
            <div class="large-3 medium-4 columns">
                <a class="small button radius hide-for-small" href="ads.create.php">Create new ad</a>
                <a class="small button radius show-for-small" href="ads.create.php">Create new ad</a>
            </div>
            <div class="large-3 medium-4 columns end">
                <a class="small button radius secondary hide-for-small" href="ads.index.php">View all ads</a>
                <a class="small button radius secondary show-for-small" href="ads.index.php">View all ads</a>
            </div>
        <!-- If user not logged in, show 'log in' and 'sign up' buttons -->
        <?php } else { ?>
            <div class="large-3 medium-3 columns">
                <a class="small button radius hide-for-small" href="#" data-reveal-id="loginModal">Log in</a>
                <a class="small button radius show-for-small" href="#" data-reveal-id="loginModal">Log in</a>
            </div>
            <div class="large-3 medium-3 columns end">
                <a class="small button radius secondary hide-for-small" href="users.create.php">Sign up</a>
                <a class="small button radius secondary show-for-small" href="users.create.php">Sign up</a>
            </div>
        <?php } ?>
    </div>

    <div class="row">
        <div class="medium-12 columns text-center">
            <p class="arrow"><i class="fa fa-angle-down"></i></p>
        </div>
    </div>

</section>

<?php require_once 'featured.index.php'; ?>

<?php require_once '../views/partials/footer.php'; ?>

</body>
</html>
