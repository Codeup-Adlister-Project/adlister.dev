<!-- Displays a logged in user's profile -->

<?php
    // Require Classes and resume current session
    require_once($_SERVER['DOCUMENT_ROOT'].'../../bootstrap.php');

    // If user is not logged in, and gets to this page manually, redirect them to homepage
    if(!Auth::check()){
        header("Location: index.php");
        exit();
    }

    // Find all the user's created ads
    function pageController()
    {
        $userArray = Auth::user();
        $data =['ads' => Ad::findAds($userArray['user_id'])];

        return $data;

    }
    // extract() will turn all the associative indices in the above $data array into variables that can be called directly later.
    // For example: $data['ads'] can now just be called by $ads
    extract(pageController());

    // Get an array of all the ad id's that the user created
    // It will be used to determine the most recent ad (couldn't use date_created because of its format)
    $ids = [];
    foreach($ads as $ad) {
        $ids[] = $ad['id'];
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
        </div>
    </div>

<!-- User's Created Ads Start -->
    <div class="row">
        <div class="small-12 columns">
            <h3 class="featured">My Ads</h3>
        </div>
    </div>
    <div class="row">
        <?php foreach($ads as $ad) { ?>
            <div class="large-4 medium-6 columns <?php if($ad['id'] == max($ids)){ echo 'end'; }?>">
                <div class="post">
                    <div class="panel">
                        <h3><a href="ads.show.php?id=<?= $ad['id']; ?>"><?= $ad['title']; ?></a></h3>
                        <a href="ads.show.php?id=<?= $ad['id']; ?>"><img src="<?= $ad['image_url']; ?>" alt="No image provided."></a>
                        <p><span class="pre">Description</span><span class="description"><?= $ad['description']; ?></span></p>
                        <p><span class="pre">Price</span><span class="price">$<?= $ad['price']; ?></p>
                        <p class="view-post"><a href="ads.show.php?id=<?= $ad['id']; ?>">View <i class="fa fa-chevron-circle-right"></i></a></span></p>
                        <p class="view-post"><a href="ads.edit.php?id=<?= $ad['id']; ?>">Edit <i class="fa fa-chevron-circle-right"></i></a></span></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<?php require_once '../views/partials/footer.php'; ?>

</body>
</html>