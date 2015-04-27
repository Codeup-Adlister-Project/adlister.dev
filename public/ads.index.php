<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'../../bootstrap.php');

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

    <section id="all">
        <div class="row">
            <div class="small-12 columns">
                <h5 class="featured">All ads</h5>
            </div>
        </div>
        <div class="row">
            <?php foreach($ads as $ad) { ?>
                <div class="large-4 medium-6 columns <?php if($ad['id'] == 1){ echo 'end'; }?>">
                    <div class="post">
                        <div class="panel">
                            <h3>
                                <a href="ads.show.php?id=<?= $ad['id']; ?>">
                                    <?= $ad['title']; ?>
                                </a>
                            </h3>
                            <a href="ads.show.php?id=<?= $ad['id']; ?>">
                                <img src="<?= $ad['image_url']; ?>" alt="No image provided.">
                            </a>
                            <p>
                                <span class="pre">Description</span>
                                <span class="description"><?= $ad['description']; ?></span>
                            </p>
                            <p>
                                <span class="pre">Price</span>
                                <span class="price">$<?= $ad['price']; ?></span>
                            </p>
                            <p class="view-post">
                                <a href="ads.show.php?id=<?= $ad['id']; ?>">
                                    View ad <i class="fa fa-chevron-circle-right"></i>
                                </a>
                            </p>
                            <p class="view-post">
                                <a data-dropdown="<?= 'drop' . $ad['id']; ?>" aria-controls="drop2" aria-expanded="false">
                                    Quick View <i class="fa fa-chevron-circle-right"></i>
                                </a>
                            </p>
                        </div>
                        <div id="<?= 'drop' . $ad['id']; ?>" data-dropdown-content class="f-dropdown content panel view" aria-hidden="true" tabindex="-1">
                            <p>
                                Contact <span class="contact"><?= $ad['contact_name']; ?></span> if interested: 
                            </p>
                            <ul>
                                <li>
                                    <span class="pre">Email</span><?= $ad['contact_email']; ?>
                                </li>
                                <li>
                                    <span class="pre">Phone</span><?= $ad['contact_phone']; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

<?php require_once '../views/partials/footer.php'; ?>

</body>
</html>
