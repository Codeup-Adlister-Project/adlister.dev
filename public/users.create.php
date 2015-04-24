<!-- Displays a form to create a user in the database -->

<?php
	// Require Classes and start a session for the page
	require_once($_SERVER['DOCUMENT_ROOT'].'../../bootstrap.php');

	// If user is already logged in, redirect to profile page and don't run rest of PHP
	if(Auth::check()){
		header("Location: users.show.php");
		exit();
	}

    // set default timezone
    date_default_timezone_set('America/Chicago');

    // Array to hold user input in case of errors
    $savedInput = ['username'=>'', 'password'=>'', 'checkPswd'=>'', 'contactEmail'=>''];
    // if there is data submited from form, save it to the array above
    if(isset($_POST['create'])) {
        $savedInput = array_replace($savedInput, $_POST);   // replace initial values of user input array with $_POST data
    }


    // initialize an array to catch all the generic errors, and another to hold any custom messages for display
    $errors = [];
    $errorMessages = ['username'=>'', 'password'=>'', 'checkPswd'=>'', 'contactEmail'=>''];


    // Retrieve and sanitize user input into 'Create an Ad' form, retrieve and display any errors that occur
    if (!empty($_POST)) {

        try {

            $newUsername = Input::getString('username', 2, 25);

        } catch (DomainException $e) {
            $errors[] = $e->getMessage();
            $errorMessages['username'] = "The username must be an alphanumeric string of characters.";
        } catch (LengthException $e) {
            $errors[] = $e->getMessage();
            $errorMessages['username'] = "The username must be between 2 and 75 characters long.";
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
            $errorMessages['username'] = "Woops, an error occured, please try entering a different username.";
        }

        try {

            $newPassword = Input::getString('password', 8, 75);

        } catch (DomainException $e) {
            $errors[] = $e->getMessage();
            $errorMessages['password'] = "The password must be an alphanumeric string of characters.";
        } catch (LengthException $e) {
            $errors[] = $e->getMessage();
            $errorMessages['password'] = "The password must be at least 8 characters long.";
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
            $errorMessages['password'] = "Woops! An error occured, please try again.";
        }

        try {
            // Make sure both passwords entered are identical
            Input::areIdentical('password', 'checkPswd');

        } catch (Exception $e) {
            $errors[] = $e->getMessage();
            $errorMessages['checkPswd'] = "Woops, passwords don't match.";
        }

        try {

            $newEmail = Input::validateEmail('contactEmail');

        } catch (Exception $e) {
            $errors[] = $e->getMessage();
            $errorMessages['contactEmail'] = "Invalid email format";
        }



        // If no errors occur, go ahead and insert the form into the database
        if (empty($errors)) {

            $user = new User;
            $user->username = $newUsername;
            $user->password = password_hash($newPassword, PASSWORD_DEFAULT);
            $user->contact_email = $newEmail;   // add a try/catch and a method in BaseModel that checks to see if email already exists
            $user->date_created = date('l\, F jS\, Y \a\t h:i:s A');    // current date/time of submission
            $user->save();

            // Reset the $savedInput array back to its original content so the form appears blank.
            $savedInput = ['username'=>'', 'password'=>'', 'contactEmail'=>''];

            // Log them in automatically, and take them to their profile page.
            Auth::attempt($newUsername, $newPassword);
            header("Location: users.show.php");
        }
    }
?>

<!doctype html>
<html lang="en-US" class="no-js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adlister | Create an Account</title>

<?php require_once '../views/partials/header.php'; ?>
</head>
<body>

<?php require_once '../views/partials/navbar.php'; ?>


<!----------------------- Start Form Field to Create a New User ---------------------->

<section class="form">
    <div class="row">
        <div class="small-12 columns">
            <h2>Create an Account</h2>
                <?php if(!empty($errors)){
                            echo "<span class='error'>*See errors below:</span>";
                    }
                ?>
            <form method="POST" action=''>
        		<input type='text' name='username' value='' placeholder='Username' required />
        	       <?php if(!empty($errorMessages['username'])){
                                echo "<span class='error'>" . $errorMessages['username'] . "</span>";
                         }
                    ?>
        		<input type='password' name='password' value='' placeholder='Password' required />
        	       <?php if(!empty($errorMessages['password'])){
                                echo "<span class='error'>" . $errorMessages['password'] . "</span>";
                         }
                    ?>
        		<input type='password' name='checkPswd' value='' placeholder='Confirm Password' required />
        	       <?php if(!empty($errorMessages['checkPswd'])){
                                echo "<span class='error'>" . $errorMessages['checkPswd'] . "</span>";
                         }
                    ?>
        		<input type='text' name='contactEmail' value='' placeholder='Email' required />
        	       <?php if(!empty($errorMessages['contactEmail'])){
                                echo "<span class='error'>" . $errorMessages['contactEmail'] . "</span>";
                         }
                    ?>

        <!-- Need to add an image-upload feature for profile photo here -->

                <div class="row">
                    <div class="large-8 columns">
                        <input type='submit' name='create' value='Do it!' class="button small radius">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once '../views/partials/footer.php'; ?>

</body>
</html>

