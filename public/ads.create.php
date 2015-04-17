<!-- Displays a form for creating a new add in the database -->

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

