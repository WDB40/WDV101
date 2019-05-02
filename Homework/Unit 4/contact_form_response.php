<?php

	$formEmailAddress = $_POST['email'];	//pull email address from the form data
	$formTopic = $_POST['topic'];			//pull topic from the form data
	
	echo "<h1>Email $formEmailAddress </h1>";
	echo "<h1>Topic $formTopic </h1>";



?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>contact form response</title>
<style type="text/css">
#container  {
			width: 800px;
			border: 1px solid black;
			padding: 10px;
			margin: 10px auto;
			}
.colorRed {
	color: #F00;
}
</style>
</head>

<body>
<div id="container">
<h1>WDV101 Intro HTML and CSS</h1>
<h2>Contact Form Response</h2>

<p>This process will process the 'name = value' pairs for all the elements of your contact form. It will format and create an email responding to the person who sent you a message from your form. Forms from websites must send information to the email account set up in your host server. This is usually an address such as "contact@mywebsite.com" You can also  forward this information to another email address if you like.
</p>

<p>Instructions:</p>
<ol>
  <li>To call this page use <strong>contact_form_response.php</strong> in the action attribute of your form.</li>
  <li>Make sure you choose method=&quot;post&quot;.</li>
  <li>You may need to setup an email address on your server account. Most servers have some type of protection to stop hackers from  using your email address to send bogus emails. Check with your web server vendor on  the way they do email from a form.<br />
  </li>
  <li>Do the following if you  are using  <strong>www.heartland-webhosting.com</strong>
<ol type="a">
      <li>Sign on to your web hosting account. </li>
      <li>On your control panel select Email Accounts. </li>
      <li>Create an email  address on your web hosting account for this domain name. </li>
      <ul>
        <li><em>For example:</em> webrequestedinfo@larryhall.info or info@mikesgarage.com.  You are welcome to use any email name. info, information and contact are all common choices for this.</li>
      </ul>
      <li>Your newly created email address will be used as the  web address in the <strong>from</strong> section of the email in your PHP code. Sometimes it is also best to use it in  the <strong>to</strong> section in the PHP file. Then use email forwarding on the server to let the  server send the email to multiple parties.</li>
      <li>Turn off the 'retain a  copy' of the email on the server. If you leave this on the server will make a copy of each email and it will remain on the server until you go in and delete them.</li>
      <li>Check the email works by  sending an email from your DMACC account to your newly created web server email  address. For example : <a href="mailto:contact@carinmurphy.info">webrequestedinfo@larryhall.info</a>.  You will need to log into your hosting account's email system to find the email. This can be done through your account control panel. You can setup your hosting account's email to forward emails to your other emails.</li>
    </ol>
  </li>
  <li><strong>Change the value of the $toEmail</strong> variable to<strong> the address you wish to send the email</strong>. <em>Example: $to=&quot;contact@mywebsite.com&quot;.</em> This could be the same as your $from address.</li>
  <li><strong>Change the value of the $fromEmail</strong> variable to your email address or the one you just created. <em>Example: $from=&quot;contact@mikesgarage.com&quot;.</em></li>
  <li>Upload the formEmailer.php file to your server. Note: It will need to be in the same folder as your form page or you will need to provide the appropriate path name.</li>
</ol>
<p>Remember, you can change any or all of the HTML above this heading.  It is just HTML and CSS. You can add your own HTML and CSS styles to this page.  You can also change the HTML inside the PHP code if you wish to format or style the output. </p>
<p>The following will display the content that was entered in the form.</p>
<p><strong>name</strong> - The value of the name attribute from the HTML form element.</p>
<p><strong>value</strong> - The value entered in the field. This will vary depending upon the HTML form element.</p>

</div><!--close div container-->

<p>RESULT WILL DISPLAY BELOW THIS LINE</p>
<hr>
<p>&nbsp;</p>

<?php

echo "<p class='colorRed'>This page was created by PHP on the server and sent back to your browser. </p>";

//It will create a table and display one set of name value pairs per row
	echo "<table border='1'>";
	echo "<tr><th>Field Name</th><th>Value of field</th></tr>";
	foreach($_POST as $key => $value)
	{
		echo '<tr class=colorRow>';
		echo '<td>',$key,'</td>';
		echo '<td>',$value,'</td>';
		echo "</tr>";
	} 
	echo "</table>";
	echo "<p>&nbsp;</p>";

//This code pulls the field name and value attributes from the Post file
//The Post file was created by the form page when it gathered all the name value pairs from the form.
//It is building a string of data that will become the body of the email

//          CHANGE THE FOLLOWING INFORMATION TO SEND EMAIL FOR YOU //  

	$toEmail = "$formEmailAddress";		//will send the email to the email address entered on the form 
		
	
	$subject = "Thank you for your message. I will contact you soon.";	//This is the message that will be sent back to the person who sent you a message from your contact form. 

	//$fromEmail = "contact@carinmurphy.com";		//C hange the email address within the quotes to be YOUR host server email address.
	$fromEmail = "wes@wdb40.com";		//Change the email address within the quotes to be YOUR host server email address.


//   DO NOT CHANGE THE FOLLOWING LINES  //

	$emailBody = "Form Data\n\n ";			//stores the content of the email
	foreach($_POST as $key => $value)		//Reads through all the name-value pairs. 	$key: field name   $value: value from the form									
	{
		$emailBody.= $key."=".$value."\n";	//Adds the name value pairs to the body of the email, each one on their own line
	} 
	
	echo "<h2>$emailBody</h2>";
	
	$headers = "From: $fromEmail" . "\r\n";				//Creates the From header with the appropriate address

 	if (mail($toEmail,$subject,$emailBody,$headers)) 	//puts pieces together and sends the email to your hosting account's smtp (email) server
	{
   		echo("<p>Message successfully sent!</p>");
  	} 
	else 
	{
   		echo("<p>Message delivery failed...</p>");
  	}

?>

</body>
</html>
