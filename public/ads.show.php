<!-- Shows a single ad that has been clicked from the ads.index.php-->
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
	<h3>2005 Chrysler Sebring</h3>
	<img src="img/myVehicle.jpg">
	<p><Description:</strong> Good condition, minor body work, no mechanical problems.</p>
	<p>Price: $2,500</p>
	<p>Contact Jamie if interested:
		<ul>
			<li>Email: email@gmail.com</li>
			<li>Cell: 555-555-5555</li>
		</ul>
	</p>
</div>

<?php require_once '../views/partials/footer.php'; ?>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>
