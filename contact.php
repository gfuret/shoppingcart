<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$name = trim($_POST["name"]);
		$email = trim($_POST["email"]);
		$message = trim($_POST["message"]);

		// check for empty required fields
		if (empty($name) OR empty($email) OR empty($message)) {
			echo "Please specify your name, message and email";
			exit;
		}
		// check for injections
		foreach ($_POST as $value) {
			if (stripos($value, 'Content-type:') !== FALSE){
				echo "There was a problem with the information you entered.";
				exit;
			}
		}
		// check for robots
		if (!empty($_POST["address"])){
				echo "Your form submission has an error.";
				exit;
		}
		//Object from class PHPMailer version 5.2.4 taken from google code
		require_once("inc/phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();
		if (!$mail->ValidateAddress($email)) {
			echo "You must enter a valid email address";
			exit;
		}

		$email_body = "";
		$email_body = $email_body . "Name: " . $name . "<br>";
		$email_body = $email_body . "Email: " . $email . "<br>";
		$email_body = $email_body . "Message: " . $message . "<br>";

		// TODO: Send Email

		$mail->SetFrom($email, $name);

		$address = "info@gfuret.com";
		$mail->AddAddress($address, "Gabriel Furet");

		$mail->Subject    = "Shirts for Mike from Gfuret contact form submission | " . $name;

		$mail->MsgHTML($email_body);

		if(!$mail->Send()) {
		  echo "There was a problem sending your information, Error: " . $mail->ErrorInfo;
		  exit;
		}
		// End of the use of PHPMailer 

		header("Location: contact.php?status=thanks");
		exit;
	}	
	$section = 'contact';
	$pageTitle = "Contact Mike";
	include_once('inc/header.php');
?>
<div class="section page">
	<div class="wrapper">
		<h1>Contact</h1>
		<!-- CONTACT PAGE AFTER MESSAGE BEGIN -->
		<?php if(isset($_GET["status"]) AND $_GET["status"] == "thanks"){	?>
				<p>Thanks for the email! I&rsquo;ll be in touch shortly </p>
		<?php }else{	?>
		<!-- CONTACT PAGE AFTER MESSAGE END -->
		<!-- CONTACT PAGE BEFORE MESSAGE BEGIN -->
			<p>Love to hear from you! Complete the form to send me an email.</p>
			<form method="post" action="contact.php">
				<table>
					<tr>
						<th>
							<label for="name">Name</label>
						</th>
						<td>
							<input type="text" name="name" id="name">
						</td>
					</tr>
					<tr>
						<th>
							<label for="email">Email</label>
						</th>
						<td>
							<input type="text" name="email" id="email">
						</td>
					</tr>
					<tr>
						<th>
							<label for="message">Message</label>
						</th>
						<td>
							<textarea type="text" name="message" id="message"></textarea>
						</td>
					</tr>
					<tr style="display: none">
						<th>
							<label for="address">Address</label>
						</th>
						<td>
							<input type="text" name="address" id="address">
							<p>Humans and frogs leaves this field blank</p>
						</td>
					</tr>						
				</table>
				<input type="submit" value="Send">
			</form>
		<?php }	?>
		<!-- CONTACT PAGE BEFORE MESSAGE END -->
	</div>
</div>
<?php 
include_once('inc/footer.php');
?>


