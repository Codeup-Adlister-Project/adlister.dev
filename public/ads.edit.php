<?php
    // Require Classes and resume current session
    require_once($_SERVER['DOCUMENT_ROOT'].'../../bootstrap.php');

    // If user is not logged in, and gets to this page manually, redirect them to homepage
    if(!Auth::check()){
        header("Location: index.php");
        exit();
    }

	// Get the selected ad and return an array of all its content from database.
    $ad = Ad::find($_GET['id']);


    // Array to hold user input in case of errors
	$savedInput = ['title'=>'', 'description'=>'', 'price'=>'', 'contactName'=>'', 'contactEmail'=>'', 'contactPhone'=>''];
	// if there is data submited from form, save it to the array above
	if(isset($_POST['edit'])) {
  		$savedInput = array_replace($savedInput, $_POST);	// replace initial values of user input array with $_POST data
	}


	// initialize an array to catch all the generic errors, and another to hold any custom messages for display
	$errors = [];
	$errorMessages = ['title'=>'', 'price'=>'', 'contactName'=>'', 'contactEmail'=>'', 'contactPhone'=>''];


	// Retrieve and sanitize user input into 'Create an Ad' form, retrieve and display any errors that occur
	if (!empty($_POST['edit'])) {

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

///////////////////////////////////// Image Uploader
		$image_url = $ad['image_url'];

        //if they DID upload a file...
        if(!empty($_FILES['image']['name']))
        {
            //if no errors...
            if(empty($_FILES['image']['error']))
            {
                //now is the time to modify the future file name and validate the file
                $new_file_name = strtolower($_FILES['image']['tmp_name']); //rename file

                if($_FILES['image']['size'] > (1024000)) //can't be larger than 1 MB
                {
                    $valid_file = false;
                    $errors[] = 'img too large.';
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
                $errors[] = $_FILES['image']['error'];
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

			$update = new Ad;
			$update->id = $_GET['id'];
			$update->contact_name = $newName;
			$update->contact_email = $newEmail;
			$update->contact_phone = $newPhone;
			$update->title = $newTitle;
			$update->description = $newDescription;
			$update->price = $newPrice;
			$update->image_url = $image_url;
			$update->update();

			header("Location: users.show.php#myads");
			exit();
		}

	}
?>

<!-- A form that populates the selected ad's content for editting, and then updates the ad in the database
with the new input-->
<!doctype html>
<html lang="en-US" class="no-js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adlister | Edit Ad</title>

<?php require_once '../views/partials/header.php'; ?>
</head>
<body>

<?php require_once '../views/partials/navbar.php'; ?>

<section class="form">
	<div class="row">
		<div class="small-12 columns">
			<h2>Edit Ad</h2>
				<?php if(!empty($errors)){
							echo "<span class='error'>*See errors below:</span>";
						}
				?>
			<form method="POST" action=''>
				<div class="row">
					<div class="large-8 columns">
						<fieldset>
							<legend>Ad information</legend>
							<label for="title">Title</label>
							<input id="title" type="text" name="title" placeholder="User title here..." value="<?= $ad['title']; ?>" />
								<?php if(!empty($errorMessages['title'])){
										echo "<span class='error'>" . $errorMessages['title'] . "</span>";
									 }
								?>
							<label for="description">Description</label>
							<textarea id="description" name="description" rows="10" maxlength="4000" placeholder="500 words or less"><?= $ad['description']; ?></textarea>
							<label for="price">Price</label>
							<div class="row collapse">
								<div class="small-2 medium-1 columns">
									<span class="prefix">$</span>
								</div>
								<div class="small-10 medium-11 columns">
									<input id="price" type="text" name="price" placeholder="User price here..." value="<?= $ad['price']; ?>" />
								</div>
									<?php if(!empty($errorMessages['price'])){
											echo "<span class='error'>" . $errorMessages['price'] . "</span>";
										 }
									?>
							</div>
							<label for="image">Change Image?</label>
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
							<input id="contactName" type="text" name="contactName" placeholder="User name here..." value="<?= $ad['contact_name']; ?>" />
								<?php if(!empty($errorMessages['contactName'])){
										echo "<span class='error'>" . $errorMessages['contactName'] . "</span>";
									 }
								?>
							<label for="contactEmail">Email</label>
							<input id="contactEmail" type="text" name="contactEmail" placeholder="User email here..." value="<?= $ad['contact_email']; ?>" />
								<?php if(!empty($errorMessages['contactEmail'])){
										echo "<span class='error'>" . $errorMessages['contactEmail'] . "</span>";
									 }
								?>
							<label for="contactPhone">Phone number</label>
							<input id="contactPhone" type="text" name="contactPhone" placeholder="User phone number here..." value="<?= $ad['contact_phone']; ?>" />
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

			<!-- Need to add an image-upload/delete feature here -->

				<div class="row">
					<div class="large-8 columns">
						<input type='submit' name='edit' value='Submit edits' class="button small radius">
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

<?php require_once '../views/partials/footer.php'; ?>

</body>
</html>