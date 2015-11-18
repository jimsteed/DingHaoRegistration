<html>
<head>
<link href="/wordpress/wp-content/themes/oxygen/style.min.css?ver=0.5.4" rel="stylesheet" type="text/css">
<link href="registration.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="JavaScript">
<!--
function check(form) {
  if (form.insuranceWaiver.checked == false ||
        form.readRulebook.checked == false) {
    alert ('Please complete the form by agreeing to the required conditions.');
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
<h1>Agreement (Step 1 of 5)</h1>

<form action="parentInfo.php" onsubmit="return check(this);" method="post">
<P>
<input type="radio" name="status" value="new">New Family<br>
<input type="radio" name="status" value="returning" checked="checked">Returning Family
</P>
<h1>C.C.A.G.P./Main Line Chinese School Ding Hao Chinese School Insurance Waiver</h1>
<P>
        <textarea rows="7" cols="72" readonly="readonly" >
In consideration of accepting membership in the Chinese Cultural Association of Greater Philadelphia (CCAGP).  I, my family, our heirs, executors, and assigns, do hereby waive and release any and all past, present, and future claims and rights for claims against CCAGP, the Main Line Chinese School (Ding Hao and Ming De Chinese Schools), its agents, officers, board members or members for any and all injuries or property loss suffered by us during school hours, school sponsored activities, and all CCAGP functions.

*Please note that you also indicate you have read the Parents' and Students' Guidelines.  You and all family members who register in Chinese school agree to obey it.
        </textarea>
</P>
<P>
<input type="checkbox" name="insuranceWaiver">I hereby certify that our family and guests will provide our own personal accident and health insurance when attending CCAGP related functions.<br>
<input type="checkbox" name="readRulebook">I hereby certify that I have read <a href='/registration/Document/GuideFaq.pdf'>the Ding Hao Parents' and A Students' Guide and Ding Hao FAQ's</a>.
</P>
<h1>Photo Authorization Permissions</h1>
<P>
<input type="radio" name="photoPermission" value="yes" checked="checked">I hereby GIVE  permission to Ding Hao Chinese School to take photographs and/or video of my child(ren) during the 2015-2016 year and to use the images so taken in whatever way Ding Hao Chinese School shall choose. I understand that my child(ren)'s personal information will not be revealed.  By this authorization, I agree that neither I nor my child(ren) shall receive any fee and that all rights, title, and interest to the images and use of them belong to Ding Hao Chinese School.  I further release and indemnify Ding Hao Chinese School, including the Chinese Cultural Association of Greater Philadelphia (CCAGP), from and against any and all liability and responsibility for any claim or cause of action on account of any damages, expenses, or other loss caused, suffered, or occurred during, arising out of or in any way associated, directly or indirectly with my child(ren)'s appearance in the photographs, the making of such images, and/or their use.
<BR>
<input type="radio" name="photoPermission" value="no" />I <em>DO NOT</em> give permission to Ding Hao Chinese School to take photographs and/or video of my child(ren) during the 2015-2016 year and to use the images so taken in whatever way Ding Hao Chinese School shall choose.
</P>
<P class="button">
<input id="continue" type="submit" value="Continue Registration">
</P>
</form>
<?php include('footer.html'); ?>
</body>
</html> 
