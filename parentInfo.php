<html>
<head>
<link href="/wordpress/wp-content/themes/oxygen/style.min.css?ver=0.5.4" rel="stylesheet" type="text/css">
<link href="registration.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="JavaScript">
<!--
function display(id) {
  switch (id) {
    case '1':
      document.getElementById('parent2tr').style.display = 'none';
      document.getElementById('cell2tr').style.display = 'none';
      break;
    case '2':
      document.getElementById('parent2tr').style.display = '';
      document.getElementById('cell2tr').style.display = '';
      break;
  }
}
function check(form) {
  if ((document.getElementById('parent1_last').value.length == 0 || document.getElementById('parent1_first').value.length == 0) ||
      (form.numberParents.value == '2' && document.getElementById('parent2_first').value.length == 0) 
     ) {
    alert ('Please enter parent name(s).');
    return false;
  } else if (document.getElementById('phone').value.length == 0 &&
        document.getElementById('cell1').value.length == 0 &&
        document.getElementById('cell2').value.length == 0
       ) {
    alert ('Please enter at least one parent phone number.');
    return false;
  } else if (document.getElementById('email').value.length == 0
       ) {
    alert ('Please enter email.');
    return false;
  } else if (document.getElementById('emergency').value.length == 0 ||
        document.getElementById('emergencyPhone').value.length == 0
       ) {
    alert ('Please enter emergency contact info.');
    return false;
  } else if (document.getElementById('address1').value.length == 0 ||
        document.getElementById('state').value.length == 0 ||
        document.getElementById('zip').value.length == 0
       ) {
    alert ('Please enter the family\'s address.');
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
<h1>Parent/Adult Information (Step 2 of 5)</h1>

<form action="studentInfo.php" method="post" onsubmit="return check(this);">
<P>
<input type="hidden" name="status" value="<?php echo $_POST["status"] ?>">
<input type="hidden" name="photoPermission" value="<?php echo $_POST["photoPermission"] ?>">
<table border="0">
<tr>
<th>Number of Parents/Guardians</th>
<td>
<input type="radio" name="numberParents" value="2" id="2" onclick="display(this.id);" checked="checked">Two Parents/Guardians *<br>
<input type="radio" name="numberParents" value="1" id="1" onclick="display(this.id);">Single Parent/Guardian
</td>
</tr>
<tr>
<td colspan="2">
* Families with TWO parents/guardians MUST select the corresponding option per CCAGP requirements.
</td>
</tr>
<tr>
<th>Parent/Guardian 1</th>
<td>First <input type="text" name="parent1_first" id="parent1_first"> Last <input type="text" name="parent1_last" id="parent1_last"></td>
</tr>
<tr id="parent2tr">
<th>Parent/Guardian 2</th>
<td>First <input type="text" name="parent2_first" id="parent2_first"> Last <input type="text" name="parent2_last" id="parent2_last"></td>
</tr>
<tr>
<th>Home Phone</th>
<td><input type="text" name="phone" id="phone"></td>
</tr>
<tr>
<th>Email</th>
<td><input type="text" name="email" id="email">**</td>
</tr>
<tr>
<td colspan="2">
** Email is our most efficient and effective means of communication. If you do not have access to email, please make arrangements to receive your information from a classmate.
</td>
</tr>
<tr>
<th>Street Address</th>
<td><input type="text" name="address1" id="address1"></td>
</tr>
<tr>
<th></th>
<td><input type="text" name="address2"></td>
</tr>
<tr>
<th>City</th>
<td><input type="text" name="city" id="city"></td>
</tr>
<tr>
<th>State</th>
<td>
<select name="state">
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA" selected>Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>				
</td>
</tr>
<tr>
<th>Zip Code</th>
<td><input type="text" name="zip" id="zip"></td>
</tr>
<tr>
<th>Cell Phone of Parent/Guardian 1</th>
<td><input type="text" name="cell1" id="cell1"></td>
</tr>
<tr id="cell2tr">
<th>Cell Phone of Parent/Guardian 2</th>
<td><input type="text" name="cell2" id="cell2"></td>
</tr>
<tr>
<th>Emergency Contact (Not Parent/Guardian)</th>
<td><input type="text" name="emergency" id="emergency"></td>
</tr>
<tr>
<th>Emergency Contact Phone</th>
<td><input type="text" name="emergencyPhone" id="emergencyPhone"></td>
</tr>
</table>


<P class="button">
<input id="continue" type="submit" value="Continue Registration">
</P>
</form>
<?php include('footer.html'); ?>
</body>
</html> 
