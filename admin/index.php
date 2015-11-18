<html>
<head>
<link href="/wordpress/wp-content/themes/oxygen/style.min.css?ver=0.5.4" rel="stylesheet" type="text/css">
<link href="../registration.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php $values = parse_ini_file('../setup'); ?>
<h1>Admin</h1>

<OL>
<?php
  foreach (glob("*.csv") as $filename) {
    echo "<LI> <a href=\"" . $filename . "\">" . $filename . "</a>\n";
  }
?>
</OL>

<form action="save.php" method="post">

<table>
<?php 
  foreach ($values as $key => $value) {
    echo '<tr><td>' . $key . '</td><td><input type="text" name="' . $key . '" value="' . $value . '"></td></tr>';
  }
?>
</table>
<P class="button">
<input type="submit" value="Save">
</P>
</form>

</body>
</html>
