<html>
<head>
<link href="/wordpress/wp-content/themes/oxygen/style.min.css?ver=0.5.4" rel="stylesheet" type="text/css">
<link href="registration.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="JavaScript">
<!--
function display(id) {
  switch (id) {
    case '6':
      document.getElementById('student2tr').style.display = '';
      document.getElementById('student3tr').style.display = '';
      document.getElementById('student4tr').style.display = '';
      document.getElementById('student5tr').style.display = '';
      document.getElementById('student6tr').style.display = '';
      break;
    case '5':
      document.getElementById('student2tr').style.display = '';
      document.getElementById('student3tr').style.display = '';
      document.getElementById('student4tr').style.display = '';
      document.getElementById('student5tr').style.display = '';
      document.getElementById('student6tr').style.display = 'none';
      break;
    case '4':
      document.getElementById('student2tr').style.display = '';
      document.getElementById('student3tr').style.display = '';
      document.getElementById('student4tr').style.display = '';
      document.getElementById('student5tr').style.display = 'none';
      document.getElementById('student6tr').style.display = 'none';
      break;
    case '3':
      document.getElementById('student2tr').style.display = '';
      document.getElementById('student3tr').style.display = '';
      document.getElementById('student4tr').style.display = 'none';
      document.getElementById('student5tr').style.display = 'none';
      document.getElementById('student6tr').style.display = 'none';
      break;
    case '2':
      document.getElementById('student2tr').style.display = '';
      document.getElementById('student3tr').style.display = 'none';
      document.getElementById('student4tr').style.display = 'none';
      document.getElementById('student5tr').style.display = 'none';
      document.getElementById('student6tr').style.display = 'none';
      break;
    case '1':
      document.getElementById('student2tr').style.display = 'none';
      document.getElementById('student3tr').style.display = 'none';
      document.getElementById('student4tr').style.display = 'none';
      document.getElementById('student5tr').style.display = 'none';
      document.getElementById('student6tr').style.display = 'none';
      break;
  }
}
function check(form) {
  var i;
  for (i=1; i<= form.numberStudents.value; i++) {
    if (document.getElementById('student' + i + '_first').value.length==0) {
      alert ('Please enter students\' information.');
      return false;
    }
  } 
  return true;
}
-->
</script>
</head>
<body>
<?php $values = parse_ini_file('setup'); ?>
<?php include('header.html'); ?>
<h1>Student Information (Step 3 of 5)</h1>

<form action="donation.php" method="post" onsubmit="return check(this);">
<P>
<?php 

  $info = array('status', 'photoPermission', 'numberParents', 'parent1_first',
                'parent1_last', 'parent2_first', 'parent2_last', 'phone', 
                'email', 'address1', 'address2', 'city', 'state', 'zip',
                'cell1', 'cell2', 'emergency', 'emergencyPhone');
  foreach ($info as $field) {
    echo "<input type=\"hidden\" name=\"" . $field . "\" value=\"" . $_POST[$field] ."\">\n";
  }
?>
<P>
Number of students: <select name="numberStudents" onchange="display(this.value);">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
</select></P>
<table border="0">
<tr>
<th>First</th><th>Last</th><th>Class</th><th>Birthdate</th><th>New<br>Student</th><th>Registered<BR>Last Sem?</th>
</tr>
<?php

  for ($i=1; $i <= 6; $i++) {

     if ($i > 1) {
        echo "<tr id=\"student" . $i . "tr\" style=\"display: none;\">\n";
     } else {
        echo "<tr id=\"student" . $i . "tr\">\n";
     }
     echo "<td><input class=\"name\" name=\"student" . $i . "_first\" id=\"student" . $i . "_first\"></td>\n";
     echo "<td><input class=\"name\" name=\"student" . $i . "_last\" id=\"student" . $i . "_lasst\" value=\"" . $_POST['parent1_last'] . "\"></td>\n";
     echo "<td><select name=\"student" . $i . "_class\" id=\"student" . $i . "_class\">\n";
     print <<<END_CLASS
                <option value="Preschool">Preschool (Class 1)</option>
                <option selected="selected" value="School">School (Class 2-10)</option>
                <option value="Adult">Adult</option>
                </select>
                </td>
END_CLASS;
     echo "<td><select name=\"student" . $i . "_birthdate_month\">\n";
     print <<<END_MONTH
                <option selected="selected" value="Jan">Jan</option>
		<option value="Feb">Feb</option>
		<option value="Mar">Mar</option>
		<option value="Apr">Apr</option>
		<option value="May">May</option>
		<option value="Jun">Jun</option>
		<option value="Jul">Jul</option>
		<option value="Aug">Aug</option>
		<option value="Sep">Sep</option>
		<option value="Oct">Oct</option>
		<option value="Nov">Nov</option>
		<option value="Dec">Dec</option>
                </select>
END_MONTH;
     echo "<select name=\"student" . $i . "_birthdate_day\">\n";
     print <<<ENDDAY
		<option selected="selected" value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
                </select>
ENDDAY;
     echo "<select name=\"student" . $i . "_birthdate_year\">\n";
     echo "               <option value=\"Adult\">Adult</option>\n";
     $year = date("Y");
     for ($j = $year-20; $j <= $year-1; $j++) {
        if ($j == $year-5) {
          echo "               <option value=\"" . $j . "\" selected=\"selected\">" . $j . "</option>\n";
        } else {
          echo "               <option value=\"" . $j . "\">" . $j . "</option>\n";
        }
     }
     echo "               </select></td>\n";
     echo "<td><select name=\"student" .$i . "_new\"><option value=\"yes\">yes</option><option value=\"no\" selected=\"selected\">no</option></select></td>\n";
     echo "<td><select name=\"student" .$i . "_registeredLast\"><option value=\"yes\" selected=\"selected\">yes</option><option value=\"no\">no</option></select></td>\n";
     echo "</tr>\n";
  }
?>

</table>

<P class="button">
<input id="continue" type="submit" value="Continue Registration">
</P>
</form>
<?php include('footer.html'); ?>
</body>
</html> 
