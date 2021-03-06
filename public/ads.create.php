<!-- Displays a form for creating a new add in the database -->

<?php require_once($_SERVER['DOCUMENT_ROOT'].'../../bootstrap.php');

	// If user is not logged in and gets to ads.create.php manually, redirect to home page and don't run rest of PHP
	if(!Auth::check()){
		header("Location: index.php");
		exit();
	}

   	// set default timezone
   	date_default_timezone_set('America/Chicago');

    // Array to hold user input in case of errors
	$savedInput = ['title'=>'', 'description'=>'', 'price'=>'', 'contactName'=>'', 'contactEmail'=>$userArray['contact_email'], 'contactPhone'=>''];
	// if there is data submited from form, save it to the array above
	if(isset($_POST['create'])) {
  		$savedInput = array_replace($savedInput, $_POST);	// replace initial values of user input array with $_POST data
	}


	// initialize an array to catch all the generic errors, and another to hold any custom messages for display
	$errors = [];
	$errorMessages = ['title'=>'', 'price'=>'', 'contactName'=>'', 'contactEmail'=>'', 'contactPhone'=>''];


	// Retrieve and sanitize user input into 'Create an Ad' form, retrieve and display any errors that occur
	if (!empty($_POST['create'])) {

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

            $newEmail = Input::validateEmail('contactEmail');

        } catch (Exception $e) {
            $errors[] = $e->getMessage();
            $errorMessages['contactEmail'] = "Invalid email format";
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

///////////////////////////////////// Image Upload
		$image_url = null;

        //if they DID upload a file...
        if($_FILES['image']['name'])
        {
            //if no errors...
            if(!$_FILES['image']['error'])
            {
                //now is the time to modify the future file name and validate the file
                $new_file_name = strtolower($_FILES['image']['tmp_name']); //rename file

                if($_FILES['image']['size'] > (1024000)) //can't be larger than 1 MB
                {
                    $valid_file = false;
                    $errorMessages['image'] = 'Oops!  Your file\'s size is to large.';
                } else {
                    $valid_file = true;
                }

                //if the file has passed the test
                if($valid_file)
                {
                    //move it to where we want it to be
                    $currentdir = getcwd();
					$target = $currentdir .'/uploads/' . basename($_FILES['image']['name']);
					move_uploaded_file($_FILES['image']['tmp_name'], $target);
                }
            }
            //if there is an error...
            else
            {
                //set that to be the returned message
                $errorMessages['image'] = 'Ooops!  Your upload triggered the following error:  '.$_FILES['image']['error'];
            }

            $image_url = '/uploads/' . basename($_FILES['image']['name']);
        }

        //you get the following information for each file:
        // $_FILES['field_name']['name']
        // $_FILES['field_name']['size']
        // $_FILES['field_name']['type']
        // $_FILES['field_name']['tmp_name']


		// If no errors occur, go ahead and insert the form into the database
		if (empty($errors)) {
			$ad = new Ad;
			$ad->user_id = $userArray['user_id'];
			$ad->contact_name = $newName;
			$ad->contact_email = $newEmail;
			$ad->contact_phone = $newPhone;
			$ad->title = $newTitle;
			$ad->description = $newDescription;
			$ad->price = $newPrice;
			$ad->date_created = date('l\, F jS\, Y \a\t h:i:s A');    // current date/time of submission
			$ad->image_url = $image_url;
			$ad->save();

			// Reset the $savedInput array back to its original content so the form appears blank.
			$savedInput = ['title'=>'', 'description'=>'', 'price'=>'', 'contactName'=>'', 'contactEmail'=>'', 'contactPhone'=>''];
			echo "<div class='row'>
					<div class='large-12 columns'>
						<h3>Add successfuly posted!</h3>
						<a href='ads.index.php'>
							<button type='button' name='seeAd'>View your ad</button>
						</a>
					</div>
				</div>";

		}

	}

?>

<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adlister | Create Ad</title>

<?php require_once '../views/partials/header.php'; ?>

</head>
<body>

<?php require_once '../views/partials/navbar.php'; ?>


<!-- Start Form Field to Create a New Ad -->

<section class="form">
	<div class="row">
		<div class="small-12 columns">
			<h2>Create New Ad</h2>
				<?php if(!empty($errors)){
							echo "<span class='error'>*See errors below:</span>";
					}
				?>
			<form id="createAd" name="createAd" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="large-8 columns">
						<fieldset>
							<legend>Ad information</legend>
							<label for="title">Title</label>
							<input type='text' id='title' name='title' value="<?= $savedInput['title']; ?>" placeholder='Title' required />
								<?php if(!empty($errorMessages['title'])){
									echo "<span class='error'>" . $errorMessages['title'] . "</span>";
								 }
								?>
							<label for="description">Description</label>
							<textarea type='text' id='description' name='description' placeholder='Description' rows='10' cols='75' maxlength="4000"><?= $savedInput['description']; ?></textarea>
							<label for="price">Price</label>
							<div class="row collapse">
								<div class="small-2 medium-1 columns">
									<span class="prefix">$</span>
								</div>
								<div class="small-10 medium-11 columns">
									<input type='text' id='price' name='price' value="<?= $savedInput['price']; ?>" placeholder='Price' required />
								</div>
								<?php if(!empty($errorMessages['price'])){
									echo "<span class='error'>" . $errorMessages['price'] . "</span>";
								 }
								?>
							</div>
							<label for="image">Image</label>
							<input type="file" id="image" name="image" accept="image/*" required />
								<?php if(!empty($errorMessages['image'])){
									echo "<span class='error'>" . $errorMessages['image'] . "</span>";
								 }
								?>

							<!-- Commented code below is a work in progress for making the file uploader prettier -->
							<!-- <div class="row collapse">
								<div class="small-10 columns">
									<input type="text" name="txtFakeText" readonly="true" value="Upload an image...">
								</div>
								<div class="small-2 columns">
								    <input type="button" onclick="handleFileButtonClick();" value="Browse" class="button tiny info postfix">
							    </div>
						    </div> -->
						</fieldset>
					</div>
				</div>
				<div class="row">
					<div class="large-8 columns">
						<fieldset>
							<legend>Your contact information</legend>
							<label for="contactName">Name</label>
							<input type='text' id='contactName' name='contactName' value="<?= $savedInput['contactName']; ?>" placeholder='Your name' required />
								<?php if(!empty($errorMessages['contactName'])){
									echo "<span class='error'>" . $errorMessages['contactName'] . "</span>";
								 }
								?>
							<label for="contactEmail">Email</label>
							<input type='text' id='contactEmail' name='contactEmail' value="<?= $savedInput['contactEmail']; ?>" placeholder='Your email address' required />
								<?php if(!empty($errorMessages['contactEmail'])){
									echo "<span class='error'>" . $errorMessages['contactEmail'] . "</span>";
								 }
								?>
							<label for="contactPhone">Phone number</label>
							<input type='text' id='contactPhone' name='contactPhone' value="<?= $savedInput['contactPhone']; ?>" placeholder='Your phone number' />
								<?php if(!empty($errorMessages['contactPhone'])){
									echo "<span class='error'>" . $errorMessages['contactPhone'] . "</span>";
								 }
								?>
						</fieldset>
					</div>
				</div>
				<div class="row">
					<div class="large-8 columns">
						<fieldset>
							<legend>Preferred contact method</legend>
							<input type="radio" name="contactMethod" value="email-preferred" id="emailPreferred" checked /><label for="emailPreferred">Email</label>
							<input type="radio" name="contactMethod" value="text-preferred" id="textPreferred" /><label for="textPreferred">Text</label>
						</fieldset>
					</div>
				</div>
				<div class="row">
					<div class="large-8 columns">
						<input type='submit' name='create' value='Post' class="button small radius">
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

<?php require_once '../views/partials/footer.php'; ?>

</body>
</html>
