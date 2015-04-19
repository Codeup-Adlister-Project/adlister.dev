<!doctype html>
<html lang="en-US" class="no-js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adlister</title>

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

    <div class="row">
        <div class="medium-12 columns text-center">
            <p class="arrow"><i class="fa fa-angle-down"></i></p>
        </div>
    </div>

</section>

<?php require_once 'ads.index.php'; ?>

<?php require_once '../views/partials/footer.php'; ?>
    <script src="/js/vendor/jquery.js"></script>
    <script src="/js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>
