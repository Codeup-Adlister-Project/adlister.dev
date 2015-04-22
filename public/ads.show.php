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

<section id="show">
    <div class="row">
    	<div class="medium-8 columns">       
            <div class="post">
                <div class="panel view">

    				<?php foreach($ads as $ad) { ?>
    					<?php if($ad['id'] == $_GET['id']) { ?>
    						<h3><?= $ad['title']; ?></h3>
    					    <a href="#"><img src="<?= $ad['image_url']; ?>"></a>
    					    <p><span class="pre">Description</span><span class="description"><?= $ad['description']; ?></span></p>
    					    <p><span class="pre">Price</span><span class="price">$<?= $ad['price']; ?></span></p>
    					    <p>Contact <span class="contact"><?= $ad['contact_name']; ?></span> if interested: </p>
					        <ul>
					            <li><span class="pre">Email</span><?= $ad['contact_email']; ?></li>
					            <li><span class="pre">Phone</span><?= $ad['contact_phone']; ?></li>
					        </ul>
                                <?php if(count($ads) == $ad['id']) { ?>
                                        <p class="view-post"><a href="ads.index.php">Back to all ads <i class="fa fa-chevron-circle-right"></i></a></p>
                                <?php } else { ?>
                                        <p class="view-post"><a href="ads.show.php?id=<?= $ad['id']-1; ?>">View next ad <i class="fa fa-chevron-circle-right"></i></a></p>
        					<?php } ?>
        				<?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../views/partials/footer.php'; ?>

</body>
</html>
