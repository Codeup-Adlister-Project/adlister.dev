<!-- Displays a form containing user data from database, and updates the database with changed input -->

<?php
  	// Require Classes and resume current session
	require_once($_SERVER['DOCUMENT_ROOT'].'../../bootstrap.php');

    // If user is not logged in, and gets to this page manually, redirect them to homepage
    if(!Auth::check()){
        header("Location: index.php");
        exit();
    }

    // Array to hold user input in case of errors
    $savedInput = ['username'=>'', 'newPassword'=>'', 'confirmPass'=>'', 'contactEmail'=>''];
    // if there is data submited from form, save it to the array above
    if(isset($_POST['edit'])) {
        $savedInput = array_replace($savedInput, $_POST);   // replace initial values of user input array with $_POST data
    }


    // initialize an array to catch all the generic errors, and another to hold any custom messages for display
    $errors = [];
    $errorMessages = ['username'=>'', 'password'=>'', 'newPassword'=>'', 'confirmPass'=>'', 'contactEmail'=>''];


    // Retrieve and sanitize user input into 'Create an Ad' form, retrieve and display any errors that occur
    if (!empty($_POST['edit'])) {

        // First, check that the current password entered is correct.
        if(!User::verifyLogin($userArray['username'], $_POST['password'])) {
            $errors[] = "Wrong password.";
            $errorMessages['password'] = "Incorrect password";
        }

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
            if(!empty($_POST['newPassword'])) {
                $newPassword = Input::getString('newPassword', 8, 75);
            }
        } catch (DomainException $e) {
            $errors[] = $e->getMessage();
            $errorMessages['newPassword'] = "The password must be an alphanumeric string of characters.";
        } catch (LengthException $e) {
            $errors[] = $e->getMessage();
            $errorMessages['newPassword'] = "The password must be at least 8 characters long.";
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
            $errorMessages['newPassword'] = "Woops! An error occured, please try again.";
        }

        try {
            // Make sure both passwords entered are identical
            Input::areIdentical('newPassword', 'confirmPass');

        } catch (Exception $e) {
            $errors[] = $e->getMessage();
            $errorMessages['confirmPass'] = "Woops, passwords don't match.";
        }

        try {

            $newEmail = Input::validateEmail('contactEmail');

        } catch (Exception $e) {
            $errors[] = $e->getMessage();
            $errorMessages['contactEmail'] = "Invalid email format";
        }



        // If no errors occur, go ahead and insert the form into the database
        if (empty($errors)) {
            $update = new User;
            $update->user_id = $userArray['user_id'];
            $update->username = $newUsername;
            $update->contact_email = $newEmail;   // add a try/catch and a method in BaseModel that checks to see if email already exists

            // If a new password was entered, add it to the update query
            if(isset($newPassword)) {
                $update->password = password_hash($newPassword, PASSWORD_DEFAULT);
            }
            $update->update(NULL, NULL, 'user_id');

            header("Location: users.show.php");
            exit();
        }
    }


?>

<!doctype html>
<html lang="en-US" class="no-js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adlister | Edit Profile</title>

<?php require_once '../views/partials/header.php'; ?>
</head>
<body>

<?php require_once '../views/partials/navbar.php'; ?>

<section class="form">
    <div class="row">
        <div class="small-12 columns">
            <h2>Edit Profile</h2>
            <form method="POST" action=''>
                    <label for="Username">Username</label>
            		<input type='text' name='username' value="<?= $userArray['username']; ?>" placeholder='Username' required />
                    <?php if(!empty($errorMessages['username'])){
                            echo "<span class='error'>" . $errorMessages['username'] . "</span>";
                         }
                    ?>
                    <label for="password">Current Password</label>
            		<input type='password' name='password' placeholder='Current Password' required />
                    <?php if(!empty($errorMessages['password'])){
                            echo "<span class='error'>" . $errorMessages['password'] . "</span>";
                         }
                    ?>
                    <label for="newPassword">New Password  (optional)</label>
            		<input type='password' name='newPassword' value="<?= $savedInput['newPassword']; ?>" placeholder='New Password (optional)' />
                    <?php if(!empty($errorMessages['newPassword'])){
                            echo "<span class='error'>" . $errorMessages['newPassword'] . "</span>";
                         }
                    ?>
                    <label for="confirmPass">Confirm New Password</label>
            		<input type='password' name='confirmPass' value="<?= $savedInput['confirmPass']; ?>" placeholder='Confirm New Password' />
                    <?php if(!empty($errorMessages['confirmPass'])){
                            echo "<span class='error'>" . $errorMessages['confirmPass'] . "</span>";
                         }
                    ?>
                    <label for="contactEmail">Email</label>
            		<input type='text' name='contactEmail' value="<?= $userArray['contact_email']; ?>" placeholder='Email' required />
                    <?php if(!empty($errorMessages['contactEmail'])){
                            echo "<span class='error'>" . $errorMessages['contactEmail'] . "</span>";
                         }
                    ?>
            		<input type='submit' class='button' name='edit' value='Submit Changes' />

            <!-- Need to add an image-upload feature that alters profile photo here -->

            </form>
        </div>
    </div>
</section>

<?php require_once '../views/partials/footer.php'; ?>

</body>
</html>


