<!-- Shows a single ad that has been clicked from the ads.index.php-->

<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'../../bootstrap.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'../../models/Ad.php');

    function pageController()
    {
        $data =['ads' => Ad::all()];

        return $data;   

    }
    // extract() will turn all the associative indices in the above $data array into variables that can be called directly later.
    // For example: $data['ads'] can now just be called by $ads
    extract(pageController()); 

?>

<!doctype html>
<html lang="en-US" class="no-js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adlister | Show Ad</title>

<?php require_once '../views/partials/header.php'; ?>
</head>
<body>

<?php require_once '../views/partials/navbar.php'; ?>

<div class="ads">
	<div class="large-4 medium-6 columns">       
        <div class="ad">
            <div class="panel">

				<?php foreach($ads as $ad) { ?>
					<?php if($ad['id'] == $_GET['id']) { ?>
						<h3><?= $ad['title']; ?></h3>
					    <a href="#"><img src="<?= $ad['image_url']; ?>"></a>
					    <p><span class="pre">Description</span><span class="description"><?= $ad['description']; ?></span></p>
					    <p><span class="pre">Price</span><span class="price">$<?= $ad['price']; ?></span></p>
					    <p>Contact <?= $ad['contact_name']; ?> if interested:
					        <ul>
					            <li>Email: <?= $ad['contact_email']; ?></li>
					            <li>Cell: <?= $ad['contact_phone']; ?></li>
					        </ul>
					    </p>
					<?php } ?>
				<?php } ?>

            </div>
        </div>
    </div>
</div>

<?php require_once '../views/partials/footer.php'; ?>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>
