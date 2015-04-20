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
    <title>Adlister | Home</title>

<?php require_once '../views/partials/header.php'; ?>
</head>
<body>

<?php require_once '../views/partials/navbar.php'; ?>

    <section id="featured">
        
        <div class="row">
            <div class="small-12 columns">
                <h5 class="featured-ads">Featured ads</h5>
            </div>
        </div>   

        <div class="row">
            <?php foreach($ads as $ad){ ?>
                <div class="large-4 medium-6 columns">       
                    <div class="ad">
                        <div class="panel">
                            <h3><a href="ads.show.php"><?= $ad['title']; ?></a></h3>
                            <a href="ads.show.php"><img src="<?= $ad['image_url']; ?>"></a>
                            <p>Description: <?= $ad['description']; ?></p>
                            <p>Price: $<?= $ad['price']; ?></p>
                            <p>Contact <?= $ad['contact_name']; ?> if interested:
                                <ul>
                                    <li>Email: <?= $ad['contact_email']; ?></li>
                                    <li>Cell: <?= $ad['contact_phone']; ?></li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>  

    </section>

<?php require_once '../views/partials/footer.php'; ?>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>
