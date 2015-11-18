<?php

$info = array('status', 'photoPermission', 'numberParents', 'parent1_first',
              'parent1_last', 'parent2_first', 'parent2_last', 'phone', 
              'email', 'address1', 'address2', 'city', 'state', 'zip',
              'cell1', 'cell2', 'emergency', 'emergencyPhone',
              'numberStudents', 'donation', 'donationCustomAmount');
$student_info = array('first', 'last', 'class', 'birthdate_month', 
              'birthdate_day', 'birthdate_year', 'new', 'registeredLast');

$missing_fields = array();
foreach ($info as $field) {
  if (array_key_exists($field,$_POST)) {
    echo "<input type=\"hidden\" name=\"" . $field . "\" value=\"" . $_POST[$field] ."\">\n";
  } else {
    array_push($missing_fields,$field);
  }
}
for ($i=1; $i<= $_POST['numberStudents']; $i++) {
  foreach ($student_info as $field) {
    $field_full = "student" . $i . "_" . $field;
    if (array_key_exists($field_full,$_POST)) {
      echo "<input type=\"hidden\" name=\"" . $field_full . "\" value=\"" . $_POST[$field_full] ."\">\n";
    } else {
      array_push($missing_fields,$field);
    }
  }
}

if (!empty($missing_fields)) {
  echo "<P>Oops. Looks like you started the registration somewhere in the middle. Maybe you should <a href=\"index.php\">start over</a>.</P>\n";
  echo "<P style=\"color: white\">Missing fields: " . join(', ',$missing_fields);
} else {
  if(isset($_POST['email'])) {
    $email_to = "jim@gedae.com";
    $email_subject = "Registration";
 
    function died($error) {
        echo "Error" . $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('incomplete form');       
    }
 
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email_from)) {
      $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
      died($error_message);
    }
 
    $email_message = "Form details below.\n\n";
 
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
     
    //create email headers
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);  
 
    echo "<P>Registration complete.</P>\n";
 
 
  } 
}
 
?>
