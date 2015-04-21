<?php require_once '../bootstrap.php'; ?>

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
			<form method="POST" action=''>
				<div class="row">
					<div class="large-8 columns">
						<fieldset>
							<legend>Ad information</legend>
							<label for="title">Title</label>
							<input id="title" type="text" name="title" placeholder="User title here..." value="" />
							<label for="description">Description</label>
							<textarea id="description" name="description" rows="10" maxlength="4000" placeholder="500 words or less"></textarea>
							<label for="price">Price</label>
							<input id="price" type="text" name="price" placeholder="User price here..." value="" />
						</fieldset>
					</div>
				</div>
				<div class="row">
					<div class="large-8 columns">
						<fieldset>
							<legend>Your contact information</legend>		
							<label for="contactName">Name</label>
							<input id="contactName" type="text" name="contactName" placeholder="User name here..." value="" />
							<label for="contactEmail">Email</label>
							<input id="contactEmail" type="text" name="contactEmail" placeholder="User email here..." value="" />
							<label for="contactPhone">Phone number</label>
							<input id="contactPhone" type="text" name="contactPhone" placeholder="User phone number here..." value="" />
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
						<input type='submit' name='submit' value='Submit edits' class="button small radius">
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

<?php require_once '../views/partials/footer.php'; ?>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>