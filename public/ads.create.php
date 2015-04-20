<!-- Displays a form for creating a new add in the database -->
<!doctype html>
<html lang="en-US" class="no-js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adlister | Create Ad</title>

<?php require_once '../views/partials/header.php'; ?>
</head>
<body>

<?php require_once '../views/partials/navbar.php'; ?>

<h2>Create New Ad</h2>
<form method="POST" action=''>
	<p>
		<input type='text' name='title' value='' placeholder='Title' required></input>
	</p>
	<p>
		<textarea type='text' name='description' value='' placeholder='Description' rows='10' cols='75'></textarea>
	</p>
	<p>
		<input type='text' name='price' value='' placeholder='Price' required></input>
	</p>
	<p>
		<input type='text' name='contactName' value='' placeholder='Your name' required></input>
	</p>
	<p>
		<input type='text' name='contactEmail' value='' placeholder='Your email address' required></input>
		<span><input type='radio' name='radioButton' value='email is preferred' checked>Email is preferred</input></span>
	</p>
	<p>
		<input type='text' name='contactPhone' value='' placeholder='Your phone number'></input>
		<span><input type='radio' name='radioButton' value='text is preferred'>Text message is preferred</input></span>
	</p>
		<input type='submit' name='submit' value='Submit'></input>


<!-------- Need to add an image-upload feature here ---------->

	
</form>

<?php require_once '../views/partials/footer.php'; ?>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>
