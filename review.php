<html>
<head>
<link href="/wordpress/wp-content/themes/oxygen/style.min.css?ver=0.5.4" rel="stylesheet" type="text/css">
<link href="registration.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php $values = parse_ini_file('setup'); ?>
<?php include('header.html'); ?>
<form action="confirmation.php" method="post">
<?php
  $info = array('status', 'photoPermission', 'numberParents', 'parent1_first',
                'parent1_last', 'parent2_first', 'parent2_last', 'phone', 
                'email', 'address1', 'address2', 'city', 'state', 'zip',
                'cell1', 'cell2', 'emergency', 'emergencyPhone',
                'numberStudents', 'donation', 'donationCustomAmount');
  $student_info = array('first', 'last', 'class', 'birthdate_month', 
                'birthdate_day', 'birthdate_year', 'new', 'registeredLast');

  foreach ($info as $field) {
    echo "<input type=\"hidden\" name=\"" . $field . "\" value=\"" . $_POST[$field] ."\">\n";
  }
  for ($i=1; $i<= $_POST['numberStudents']; $i++) {
    foreach ($student_info as $field) {
      $field_full = "student" . $i . "_" . $field;
      echo "<input type=\"hidden\" name=\"" . $field_full . "\" value=\"" . $_POST[$field_full] ."\">\n";
    }
  }

  $preschool = array();
  $school = array();
  $adult = array();
  for ($i=1; $i<=$_POST['numberStudents']; $i++) {
    switch ($_POST['student'.$i.'_class']) {
      case 'Preschool':
        array_push($school,$i);
        break;
      case 'School':
        array_push($school,$i);
        break;
      case 'Adult';
        array_push($adult,$i);
        break;
    }
  }

  if (count($school) + count($adult) + count($preschool) > 0) {
    echo <<<REVIEW
<h1>Review (Step 5 of 5)</h1>

<P><em>Tuition refund policy:</em> The tuition includes a $15.00 nonrefundable registration fee per student. Tuition will be refunded on a prorated, cost-per-class basis to those who withdraw after attending the first, second or third class. Fifty percent of tuition will be refunded to those who remain through the fourth class. Thereafter, no fees will be refunded.</P>

<P>
REVIEW;
    echo "Contact: " . $_POST['parent1_first'] . " " . $_POST['parent1_last'] . " (" . $_POST['email'] . ")<BR>\n";
    if (!empty($preschool)) {
      echo "Number of Preschool students: " . count($preschool);
      echo " (";
      $last = end($preschool);
      foreach ($preschool as $i) {
        echo $_POST['student'.$i.'_first'];
        if ($i != $last) echo ", ";
      }
      echo ")<BR>\n";
    }
    if (!empty($school)) {
      echo "Number of School students: " . count($school);
      echo " (";
      $last = end($school);
      foreach ($school as $i) {
        echo $_POST['student'.$i.'_first'];
        if ($i != $last) echo ", ";
      }
      echo ")<BR>\n";
    }
    if (!empty($adult)) {
      echo "Number of Adult students: " . count($adult);
      echo " (";
      $last = end($adult);
      foreach ($adult as $i) {
        echo $_POST['student'.$i.'_first'];
        if ($i != $last) echo ", ";
      }
      echo ")<BR>\n";
    }
    echo "</P>\n";

    $tuition = count($adult)*$values['tuition_adult'] +
               count($preschool)*$values['tuition_year1'];
    if (count($school) > 2) {
      $tuition += (2+(count($school)-2)*(1-$values['discount_3rdkid']))*$values['tuition'];
    } else {
      $tuition += count($school)*$values['tuition'];
    }
    echo "<table>\n";
    echo "<tr><th>Tuition</th><td>$". $tuition . "</td></tr>\n";
    $cost = $tuition;
    if (strcmp($values['semester'],"Fall")==0) {
      if ($_POST['numberParents'] == 1) {
        echo "<tr><th>CCAGP Fee</th><td>$" . $values['ccagp_oneparent'] . "</td></tr>\n";
        $cost += $values['ccagp_oneparent'];
      } else {
        echo "<tr><th>CCAGP Fee</th><td>$" . $values['ccagp_twoparent'] . "</td></tr>\n";
        $cost += $values['ccagp_twoparent'];
      }
      echo "<tr><th>PTO Dues</th><td>$" . $values['pto'] . "</td></tr>\n";
      $cost += $values['pto'];
    }
    if (strcmp($_POST['donation'],"other") == 0) $donation = $_POST['donationCustomAmount']; 
    else                                         $donation = $_POST['donation'];
    echo "<tr><th>Donation</th><td>$" . $donation . "</td></tr>\n";
    $cost += $donation;
    $deadline = DateTime::createFromFormat('m/d/Y',$values['deadline']);
    $today = new DateTime();
    $use_early_bird = $today <= $deadline;
    if ($use_early_bird) {
      $timeleft = $today->diff($deadline);
      echo "<tr><th>Early Bird Discount</th><td>$" . $values['discount_early'] . " (" . $timeleft->days . " days left)</td></tr>\n";
      $cost -= $values['discount_early'];
    } 
    echo "<tr><th>Total</th><td>$" . $cost . "</td></tr>\n";
    echo "</table>\n";
    echo "<P>\n";
    echo "<input type=\"hidden\" name=\"cost\" value=\"" . $cost ."\">\n";
    if ($use_early_bird) {
      echo "<input type=\"hidden\" name=\"earlyBird\" value=\"yes\">\n";
    } else {
      echo "<input type=\"hidden\" name=\"earlyBird\" value=\"no\">\n";
    }
    echo <<<BUTTON
<P>
<input type="hidden" name="payByCheck" value="off">
<input type="checkbox" name="payByCheck" value="on"> I intend to pay by check. (Note: A Paypal checkout button will still be generated for you in case you change your mind.) 
</P>
<P class="button">
<input id="continue" type="submit" value="Submit Completed Registration">
</P>
</form>
BUTTON;
  } else {
    echo "<P>Oops. Looks like you started the registration somewhere in the middle. Maybe you should <a href=\"index.php\">start over</a>.</P>\n";
  }
?>
<?php include('footer.html'); ?>
</body>
</html> 
