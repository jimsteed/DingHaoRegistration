<html>
<head>
<link href="/wordpress/wp-content/themes/oxygen/style.min.css?ver=0.5.4" rel="stylesheet" type="text/css">
<link href="registration.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="JavaScript">
<!--
function check(form) {
  if ((document.getElementById('parent1').value.length == 0) ||
      (form.numberParents.value == '2' && document.getElementById('parent2').value.length == 0) 
     ) {
    alert ('Please enter parent name(s).');
    return false;
  } else {
    return true;
  }
}
-->
</script>
</head>
<body>
<?php $values = parse_ini_file('setup'); ?>
<?php include('header.html'); ?>
<h1>Donation (Step 4 of 5)</h1>

<P>Thank you for investing in your child(ren)'s future through their participation in Ding Hao's language and cultural education program. Ding Hao is a labor of love for every single one of the staff and volunteers who help run the school - their dedication as well as the commitment of parents to Ding Hao reflect the value all of us believe the school brings to the community. Although tuition and fees cover a majority of the operating expenses of Ding Hao, each year the school is left with an outstanding balance that must be made up through separate fundraising activities. Your pledge of support is vital to the school's ability to continue to offer the best children's education in Chinese language and culture within the local community. </P>

<P>Please support Ding Hao by considering a donation as part of your child(ren)'s registration:</P>

<form action="review.php" method="post" onsubmit="return check(this);">
<P>
<?php 

  $info = array('status', 'photoPermission', 'numberParents', 'parent1_first',
                'parent1_last', 'parent2_first', 'parent2_last', 'phone', 
                'email', 'address1', 'address2', 'city', 'state', 'zip',
                'cell1', 'cell2', 'emergency', 'emergencyPhone',
                'numberStudents');
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
?>

<input type="radio" name="donation" value="25" checked="checked">$25<br>
<input type="radio" name="donation" value="50">$50<br>
<input type="radio" name="donation" value="100">$100<br>
<input type="radio" name="donation" value="other">Other amount: $<input type="text" name="donationCustomAmount" size="5"><br>
<input type="radio" name="donation" value="0">No, thank you but I will consider donating as part of my workplace's charitable giving program.

<P class="button">
<input id="continue" type="submit" value="Continue Registration">
</P>
</form>
<?php include('footer.html'); ?>
</body>
</html> 
