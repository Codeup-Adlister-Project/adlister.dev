<?php 
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
