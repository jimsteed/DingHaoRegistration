<html>
<head>
<link href="/wordpress/wp-content/themes/oxygen/style.min.css?ver=0.5.4" rel="stylesheet" type="text/css">
<link href="registration.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php $values = parse_ini_file('setup'); ?>
<?php include('header.html'); ?>
<?php

function safefileappend($filename, $dataToSave)
{
    $fp = fopen($filename,"a") or die(print_r(error_get_last(),true));
    if ($fp)
    {
        do
        {            $canWrite = flock($fp, LOCK_EX);
           // If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
           if(!$canWrite) usleep(20);
        } while (!$canWrite);

        //file was locked so now we can store information
        if ($canWrite)
        {            fwrite($fp, $dataToSave);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }
}


$info = array('status', 'photoPermission', 'numberParents', 'parent1_first',
              'parent1_last', 'parent2_first', 'parent2_last', 'phone', 
              'email', 'address1', 'address2', 'city', 'state', 'zip',
              'cell1', 'cell2', 'emergency', 'emergencyPhone',
              'numberStudents', 'donation', 'donationCustomAmount',
              'cost','earlyBird','payByCheck');
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
  $m .= "<LI> Pay now using the Paypal button above. Paypal accepts credit cards and electronic checks.\n";
  $m .= "<LI> Pay later using Paypal. An email has been sent to " . $_POST['email'] . " with the same button.\n";
  $m .= "<LI> Send a check for $" . $_POST['cost'] . " to Ding Hao Chinese School.\n";
  $m .= "</OL>\n";
  if (strcmp($_POST['earlyBird'],"yes")==0) {
    $x = DateTime::createFromFormat('m/d/Y',$values['deadline']); 
    $m .= "<P>Note the early bird discount of $" . $values['discount_early'] . " expires on " . $x->format('F jS, Y') . ". ";
    $m .= "To pay after this date, use this <a href=\"https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=dinghaoschool@gmail.com&item_name=Tuition_" . urlencode($_POST['parent1_first']) . "_" . urlencode($_POST['parent1_last']) . "&amount=" . ($_POST['cost'] + $values['discount_early']) . "&currency_code=USD\">link</a>.";
    $m .= "</P>\n";
  }

  echo $m;
?>

<?php
  $email_from = "registrar@dinghaochineseschool.org";
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

  $m = $_POST['parent1_first'] . " " . $_POST['parent1_last'] . " has registered " . $_POST['numberStudents'] . " student" . ($_POST['numberStudents'] == 1 ? "" : "s") . ".\n\n";
  for ($i=1; $i<= $_POST['numberStudents']; $i++) {
    $name_full  = "student" . $i . "_first";
    $new_full   = "student" . $i . "_new";
    $month_full = "student" . $i . "_birthdate_month";
    $day_full   = "student" . $i . "_birthdate_day";
    $year_full  = "student" . $i . "_birthdate_year";
    if (strcmp($_POST[$new_full],"yes")==0) {
      $isnew = "new";
    } else {
      $isnew = "returning";
    }
    $m .= $_POST[$name_full] . " is a " . $isnew . " student born on " . $_POST[$month_full] . " " . $_POST[$day_full] . ", " . $_POST[$year_full] . ".\n\n";
  }

  if (strcmp($_POST['earlyBird'],"yes")==0) {
    $m .= "The family was invoiced for \$".$_POST['cost'].", which includes the early bird discount.\n\n";
  } else {
    $m .= "The family was invoiced for \$".$_POST['cost'].".\n\n";
  }
  if (strcmp($_POST['payByCheck'],"on")==0) {
     $m .= "They will pay by check.\n\n";
  }

  $filename_students = "admin/Students" . $values['semester'] . $values['year'] . ".csv";
  $filename_parents = "admin/Parents" . $values['semester'] . $values['year'] . ".csv";
  $m .= "The current CSV files (Excel-compatible) for this semester are available at\n";
  $m .= "http://www.dinghaochineseschool.org/testreg/" . $filename_students . "\n";
  $m .= "http://www.dinghaochineseschool.org/testreg/" . $filename_parents . "\n";
  $m .= "\n";
  $m .= "The raw data below can be copied into an Excel spreadsheet by using Text-To-Table to convert commas to columns.\n\n";
  $m .= "Students:\n\n";
  $students_headings = join(',',$student_info) . "\n";
  if (file_exists($filename_students)) {
    $students = "";
  } else {
    $students = $students_headings;
  }
  $m .= $students_headings;

  for ($i=1; $i<= $_POST['numberStudents']; $i++) {
    $last = end($student_info);
    $s = "";
    foreach ($student_info as $field) {
      $field_full = "student" . $i . "_" . $field;
      $s .= $_POST[$field_full];
      if ($field != $last) $s .= ",";
    }
    $students .= $s ."\n";
  }
  safefileappend($filename_students,$students);
  $m .= $students . "\n";

  $m .= "Parents:\n\n";
  $parents_heading = join(',',$info) . "\n";
  if (file_exists($filename_parents)) {
    $parents = "";
  } else {
    $parents = $parents_heading;
  }
  $m .= $parents_heading;
  function getPost($v) { return $_POST[$v]; }
  $p = join(',',array_map("getPost",$info)) . "\n";
  $m .= $p;
  $parents .= $p;
  safefileappend($filename_parents,$parents);

  @mail($email_to, $email_subject, $m, $headers);  
?>

<?php
}
?>

<?php include('footer.html'); ?>
</body>
</html> 
