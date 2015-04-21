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
    <title>Adlister | All Ads</title>

<?php require_once '../views/partials/header.php'; ?>
</head>
<body>

<?php require_once '../views/partials/navbar.php'; ?>

    <section id="all-ads"> 
        <div class="row">
            <div class="small-12 columns">
                <h5 class="featured-ads">All ads</h5>
            </div>
        </div>   
        <div class="row">
           
            <?php foreach($ads as $ad){ ?>
                <div class="large-4 medium-6 columns">       
                    <div class="ad">
                        <div class="panel">
                            <h3><a href="ads.show.php?id=<?= $ad['id']; ?>"><?= $ad['title']; ?></a></h3>
                            <a href="ads.show.php?id=<?= $ad['id']; ?>"><img src="<?= $ad['image_url']; ?>"></a>
                            <p><span class="pre">Description</span><span class="description"><?= $ad['description']; ?></span></p>
                            <p><span class="pre">Price</span><span class="price">$<?= $ad['price']; ?></p>
                            <p class="view-ad"><a href="ads.show.php?id=<?= $ad['id']; ?>">View <i class="fa fa-chevron-circle-right"></i></a></span></p>
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
