<!-- Displays a form for creating a new add in the database -->
<!doctype html>

<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'../../bootstrap.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'../../models/Ad.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'../../utils/Input.php');

   	// set default timezone
   	date_default_timezone_set('America/Chicago');

    // Array to hold user input in case of errors
	$savedInput = ['title'=>'', 'description'=>'', 'price'=>'', 'contactName'=>'', 'contactEmail'=>'', 'contactPhone'=>''];
	// if there is data submited from form, save it to the array above
	if(isset($_POST['submit'])) {
  		$savedInput = array_replace($savedInput, $_POST);	// replace initial values of user input array with $_POST data
	}


	// initialize an array to catch all the generic errors, and another to hold any custom messages for display
	$errors = [];
	$errorMessages = ['title'=>'', 'price'=>'', 'contactName'=>'', 'contactEmail'=>'', 'contactPhone'=>''];


	// Retrieve and sanitize user input into 'Create an Ad' form, retrieve and display any errors that occur
	if (!empty($_POST)) {
		
		$newDescription = Input::get('description');

		try {
			
			$newTitle = Input::getString('title', 2, 75);
		
		} catch (DomainException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['title'] = "The title must be an alphanumeric string of characters.";
		} catch (LengthException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['title'] = "The title must be between 2 and 75 characters long.";
		} catch (Exception $e) {
			$errors[] = $e->getMessage();
			$errorMessages['title'] = "Woops, an error occured, please try entering a different title.";
		}

		try {
		
			$newPrice = Input::getNumber('price');

		} catch (Exception $e) {
			$errors[] = $e->getMessage();
			$errorMessages['price'] = "Woops, an error occured, please try entering a valid monetary amount.";
		}

		try {
			
			$newName = Input::getString('contactName', 2, 75);
		
		} catch (DomainException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['contactName'] = "Your name must be an alphanumeric string of characters.";
		} catch (LengthException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['contactName'] = "Your name must be between 2 and 75 characters long.";
		} catch (Exception $e) {
			$errors[] = $e->getMessage();
			$errorMessages['contactName'] = "Woops, an error occured, please try again.";
		}

		try {
			
			$newEmail = Input::getString('contactEmail', 2, 75);
		
		} catch (DomainException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['contactEmail'] = "Your email must be an alphanumeric string of characters.";
		} catch (LengthException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['contactEmail'] = "Your email must be between 2 and 75 characters long.";
		} catch (Exception $e) {
			$errors[] = $e->getMessage();
			$errorMessages['contactEmail'] = "Woops, an error occured, please try entering a valid email.";
		}
	
		try {
			
			$newPhone = Input::getString('contactPhone', 0, 16);
		
		} catch (DomainException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['contactPhone'] = "Please enter a valid phone number: ###-###-####.";
		} catch (LengthException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['contactPhone'] = "The phone number you entered is too long.";
		} catch (Exception $e) {
			$errors[] = $e->getMessage();
			$errorMessages['contactPhone'] = "Woops, please try entering a valid phone number: ###-###-####.";
		}

		// If no errors occur, go ahead and insert the form into the database
		if (empty($errors)) {
			$ad = new Ad;
			$ad->user_id = 500;
			$ad->contact_name = $newName;
			$ad->contact_email = $newEmail;
			$ad->contact_phone = $newPhone;
			$ad->title = $newTitle;
			$ad->description = $newDescription;
			$ad->price = $newPrice;
			$ad->save();


			// $userInput = "INSERT INTO ads (contact_name, contact_email, contact_phone, title, description, price)
			// 				VALUES (:contactName, :contactEmail, :contactPhone, :title, :description, :price)";
			// $insert = $dbc->prepare($userInput);

			// $insert->bindValue(':contactName', $newName, PDO::PARAM_STR);
			// $insert->bindValue(':contactEmail', $newEmail, PDO::PARAM_STR);
			// $insert->bindValue(':contactPhone', $newPhone, PDO::PARAM_STR);
			// $insert->bindValue(':title', $newTitle, PDO::PARAM_STR);
			// $insert->bindValue(':description', $newDescription, PDO::PARAM_STR);
			// $insert->bindValue(':price', $newPrice, PDO::PARAM_STR);
			// $insert->execute();
		}

		// Reset the $savedInput array back to its original content so the form appears blank.
		$savedInput = ['title'=>'', 'description'=>'', 'price'=>'', 'contactName'=>'', 'contactEmail'=>'', 'contactPhone'=>''];
		echo "<h3>Add successfuly posted!</h3>";
		echo "<a href='ads.index.php'><button type='button' name='seeAd' autofocus>View your ad</button></a>";
	}

?>	

<html lang="en-US" class="no-js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adlister | Create Ad</title>

<?php require_once '../views/partials/header.php'; ?>
</head>
<body>

<?php require_once '../views/partials/navbar.php'; ?>


<!----------------------- Form Field to Create a New Ad ---------------------->

<h2>Create New Ad</h2>
<form id="createAd" method="POST">
	<input type='hidden' name='date' value="<?= date('l\, F jS\, Y \a\t h:i:s A'); ?>"
	<p>
		<input type='text' id='title' name='title' value="<?= $savedInput['title']; ?>" placeholder='Title' required />
		<span><?= $errorMessages['title'] ?></span>
	</p>
	<p>
		<textarea type='text' id='description' name='description' placeholder='Description' rows='10' cols='75' maxlength="4000"><?= $savedInput['description']; ?></textarea>
	</p>
	<p>$
		<input type='text' id='price' name='price' value="<?= $savedInput['price']; ?>" placeholder='Price' required />
		<span><?= $errorMessages['price'] ?></span>
	</p>
	<p>
		<input type='text' id='contactName' name='contactName' value="<?= $savedInput['contactName']; ?>" placeholder='Your name' required />
		<span><?= $errorMessages['contactName'] ?></span>
	</p>
	<p>
		<input type='text' id='contactEmail' name='contactEmail' value="<?= $savedInput['contactEmail']; ?>" placeholder='Your email address' required />
		<span><input type='radio' name='radioButton' value='email is preferred' checked />Email is preferred</span>
		<span><?= $errorMessages['contactEmail'] ?></span>
	</p>
	<p>
		<input type='text' id='contactPhone' name='contactPhone' value="<?= $savedInput['contactPhone']; ?>" placeholder='Your phone number' />
		<span><input type='radio' name='radioButton' value='text is preferred' />Text message is preferred</span>
		<span><?= $errorMessages['contactPhone'] ?></span>
	</p>
		<input type='submit' name='submit' value='Post Ad' />


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
