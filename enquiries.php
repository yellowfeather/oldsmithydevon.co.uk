<?php
//If the form is submitted
if(isset($_POST['submit'])) {

  //Check to make sure that the name field is not empty
  if(trim($_POST['name']) == '') {
    $hasError = true;
  } else {
    $name = trim($_POST['name']);
  }

  //Check to make sure sure that a valid email address is submitted
  include('EmailAddressValidator.php');
  $validator = new EmailAddressValidator;
  if ($validator->check_email_address($_POST['email'])) { 
    $email = trim($_POST['email']);
  } else {
    $hasError = true;
  } 

  //Check to make sure comments were entered
  if(trim($_POST['message']) == '') {
    $hasError = true;
  } else {
    if(function_exists('stripslashes')) {
      $message = stripslashes(trim($_POST['message']));
    } else {
      $message = trim($_POST['message']);
    }
  }

  //If there is no error, send the email
  if(!isset($hasError)) {
    $emailTo = 'enquiries@oldsmithydevon.co.uk';
    $subject = 'Old Smithy Enquiry';
    $body = "Name: $name \n\nEmail: $email \n\nMessage:\n $message";
    $headers = 'From: enquiries@oldsmithydevon.co.uk' . "\r\n" . 'Reply-To: ' . $email;

    mail($emailTo, $subject, $body, $headers);
    header('Location: enquiries-thankyou.html');
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="Enquiry form for The Old Smithy, Devon." />
  <meta name="keywords" content="the old smithy, old smithy, old smithy devon, holiday cottages, holiday cottage, holiday cottages devon, holiday cottage devon, cottages in devon, cottage in devon, devon cottages, devon cottage, devon cottage rent, devon cottage rental, devon accomodation, devon accomodation rental" />
  <title>Enquiries - The Old Smithy, Devon Holiday Cottage For Rent</title>
  <!-- [if gte IE 7]><!-->
  <link rel="stylesheet" type="text/css" media="screen, projection" href="css/screen.css" />
  <!-- <![endif]-->
  <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
  <script type="text/javascript" src="js/jquery.validate.pack.js"></script>
  
  <script type="text/javascript">
    $(document).ready(function(){
      $("#enquiry-form").validate();
    });
  </script>
  
  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-85823-5']);
    _gaq.push(['_trackPageview']);
  
    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script>  
</head>

<body>
  <div id="page">
    <div id="header" class="group">
      <div id="nav">
        <div id="logo">
          <img src="img/logo.png" alt="logo" />
        </div>
    
        <ul class="group">
          <li><a href="index.html">Home</a></li>
          <li><a href="accommodation.html">Accommodation</a></li>
          <li><a href="area.html">Area</a></li>
          <li><a href="directions.html">Directions</a></li>
          <li><a href="pricing.html">Pricing</a></li>
          <li class="selected last"><a href="enquiries.php">Enquiries</a></li>
        </ul>
      </div>
    </div> <!-- /header -->
        
    <div class="main group">
      <?php if(isset($hasError)) { ?>
        <p class="error">Please correct the errors below.</p>
      <?php } ?>
        
      <form id="enquiry-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
          <ul>
            <li>
              <p>Complete the form below or phone Katie on +44 (0) 7779990239</p>
              <!-- <p>Please phone Katie on +44 (0) 7779 990239</p> -->
            </li>
            <li>
              <label for="name">Your name</label>
              <input id="name" name="name" type="text" size="50" class="required" />
            </li>
            <li>
              <label for="email">Your email address</label>
              <input id="email" name="email" type="text" size="50" class="required email" />
            </li>
            <li>
              <label for="message">Message</label>
              <textarea id="message" name="message" rows="10" cols="50" class="required"></textarea>
            </li>
            <li>
              <label>&nbsp;</label>
              <input type="submit" name="submit" value="Send" />
            </li>
          </ul>
        </fieldset>
      </form>
    </div> <!-- /main -->
    
    <div id="footer" class="group">
      <p>The Old Smithy, Jacobstowe, Devon EX20 3RF</p>
      <p>© 2015 The Old Smithy. All rights reserved.</p>
      <p>Website by <a href="http://www.yellowfeather.co.uk">Yellow Feather Ltd</a></p>
    </div> <!-- /footer -->
  </div>
</body>
</html>
