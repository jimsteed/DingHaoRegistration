<html>
<head>
<link href="/wordpress/wp-content/themes/oxygen/style.min.css?ver=0.5.4" rel="stylesheet" type="text/css">
<link href="registration.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php $values = parse_ini_file('setup'); ?>
<?php include('header.html'); ?>
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
  if (!array_key_exists($field,$_POST)) {
    array_push($missing_fields,$field);
  }
}
for ($i=1; $i<= $_POST['numberStudents']; $i++) {
  foreach ($student_info as $field) {
    $field_full = "student" . $i . "_" . $field;
    if (!array_key_exists($field_full,$_POST)) {
      array_push($missing_fields,$field);
    }
  }
}

if (!empty($missing_fields)) {
  echo "<P>Oops. Looks like you started the registration somewhere in the middle. Maybe you should <a href=\"index.php\">start over</a>.</P>\n";
  echo "<P style=\"color: white\">Missing fields: " . join(', ',$missing_fields);
} else {

  echo "<h1>Confirmation</h1>\n";
  $m = "<P>This confirms submission of your registration for the Ding Hao " . $values['semester'] . " " . $values['year'] . " semester. Please note your registration is not complete until your payment is received.</P>\n";

  $m .= "<P><a href=\"https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=dinghaoschool@gmail.com&item_name=Tuition_" . urlencode($_POST['parent1_first']) . "_" . urlencode($_POST['parent1_last']) . "&amount=" . $_POST['cost'] . "&currency_code=USD\">\n";
  $m .= "<img src=\"https://www.paypal.com/en_US/i/btn/btn_paynow_LG.gif\">\n";
  $m .= "</a></P>\n";

  $m .= "<P>You have three payment options:</P>\n";
  $m .= "<OL>\n";
  $m .= "<LI> Pay now using the Paypal link above. Paypal accepts credit cards and electronic checks.\n";
  $m .= "<LI> Pay later using Paypal. An email has been sent to " . $_POST['email'] . " with the same button.\n";
  $m .= "<LI> Send a check for $" . $_POST['cost'] . " to Ding Hao Chinese School.\n";
  $m .= "</OL>\n";
  if (strcmp($_POST['earlyBird'],"yes")==0) {
    $x = DateTime::createFromFormat('m/d/Y',$values['deadline']); 
    $m .= "Note the early bird discount of $" . $values['discount_early'] . " expires on " . $x->format('F jS, Y') . ".\n";
  }

  echo $m;
?>

<?php
  $email_from = "dinghaochineseschool@gmail.com";
  $email_to = $_POST['email'];
  $email_subject = "Ding Hao Registration and Paypal Link";

  $headers = 'From: '.$email_from."\r\n".
             'Reply-To: '.$email_from."\r\n" .
             "MIME-Version: 1.0\r\n" .
             "Content-Type: text/html; charset=ISO-8859-1\r\n" .
             'X-Mailer: PHP/' . phpversion();

  @mail($email_to, $email_subject, $m, $headers);  
?>

<?php

  $email_to = "jim@gedae.com";
  $email_from = $_POST['email'];
  $email_subject = "Ding Hao Registration: " . $_POST['parent1_last'];

  $headers = 'From: '.$email_from."\r\n".
             'Reply-To: '.$email_from."\r\n" .
             'X-Mailer: PHP/' . phpversion();

  $info = array('status', 'photoPermission', 'numberParents', 'parent1_first',
                'parent1_last', 'parent2_first', 'parent2_last', 'phone', 
                'email', 'address1', 'address2', 'city', 'state', 'zip',
                'cell1', 'cell2', 'emergency', 'emergencyPhone',
                'numberStudents', 'donation', 'donationCustomAmount');
  $student_info = array('first', 'last', 'class', 'birthdate_month', 
                'birthdate_day', 'birthdate_year', 'new', 'registeredLast');

  $m = "Students:\n\n";
  $m .= join(',',$student_info) . "\n";

  for ($i=1; $i<= $_POST['numberStudents']; $i++) {
    $last = end($student_info);
    foreach ($student_info as $field) {
      $field_full = "student" . $i . "_" . $field;
      $m .= $_POST[$field_full];
      if ($field != $last) $m .= ",";
    }
    $m .= "\n";
  }
  $m .= "\n";

  $m .= "Parents:\n\n";
  $m .= join(',',$info) . "\n";
  function getPost($v) { return $_POST[$v]; }
  $m .= join(',',array_map("getPost",$info));
  $m .= "\n\n";

  $m .= "Price:\n\n";
  $m .= "cost=".$_POST["cost"]."\n";
  $m .= "earlyBird=".$_POST["earlyBird"]."\n";
  $m .= "\n";

  @mail($email_to, $email_subject, $m, $headers);  
?>

<?php
}
?>

<?php include('footer.html'); ?>
</body>
</html> 
