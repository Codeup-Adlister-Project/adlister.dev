<?php 

    function pageController()
    {
        $data =['ads' => Ad::random(5)];

        return $data;   

    }
    // extract() will turn all the associative indices in the above $data array into variables that can be called directly later.
    // For example: $data['ads'] can now just be called by $ads
    extract(pageController()); 
        
?>

    <section id="featured">
        
        <div class="row">
            <div class="small-12 columns">
                <h5 class="featured">Featured ads</h5>
            </div>
        </div>   
        <div class="row">
            
            <?php foreach($ads as $ad){ ?>
                <div class="large-4 medium-6 columns">       
                    <div class="post">
                        <div class="panel">
                            <h3><a href="ads.show.php?id=<?= $ad['id']; ?>"><?= $ad['title']; ?></a></h3>
                            <a href="ads.show.php?id=<?= $ad['id']; ?>"><img src="<?= $ad['image_url']; ?>" alt="No image provided."></a>
                            <p><span class="pre">Description</span><span class="description"><?= $ad['description']; ?></span></p>
                            <p><span class="pre">Price</span><span class="price">$<?= $ad['price']; ?></p>
                            <p class="view-post"><a href="ads.show.php?id=<?= $ad['id']; ?>">View <i class="fa fa-chevron-circle-right"></i></a></span></p>
                        </div>
                    </div>
                </div>
            <?php } ?>  

            <div class="large-4 medium-6 columns end">
                <div class="post post-disabled">
                    <div class="panel panel-disabled">
                        <p class="view-post"><a href="ads.index.php">View all ads <i class="fa fa-chevron-circle-right"></i></a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
