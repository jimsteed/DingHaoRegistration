<html>
<head>
<link href="/wordpress/wp-content/themes/oxygen/style.min.css?ver=0.5.4" rel="stylesheet" type="text/css">
<link href="registration.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php $values = parse_ini_file('setup'); ?>
<?php include('header.html'); ?>
<h1>Registration Form<br>
Classes for Children Ages 4-16, Preschool, and Adults</h1>
 
<P>Dear Parents:</P>
 
<P>It is time to register your child(ren) for the <?php echo $values['semester'] . ' ' . $values['year'] ?> semester. Please note there is a $<?php echo $values['discount_early'] ?> discount if we receive your tuition payment and registration on or before <?php $x = DateTime::createFromFormat('m/d/Y',$values['deadline']); echo $x->format('F jS, Y'); ?>.</P>
 
<h3>Registration Procedure</h3>

<OL type='a'>
<LI> Fill out the online registration form. Even if you are paying by cash or check, please register online as early as possible to assist with class planning.
<LI> Once registration is complete, you will be given a Paypal link both in the web browser and emailed to you. Paypal will allow you to pay by credit card or electronic check. Please pay as soon as it's convenient.
<LI> Alternative to Paypal you can mail a check to Ding Hao or bring it in to the first week of class and pay at the registration desk.
</OL>
<P><em>Note: Registration is not offical until payment is received</em></P>


<P>Tuition is $<?php echo $values['tuition'] ?> (including the non-refundable $15 registration fee).  Families with more than two children attending class will receive an additional discount according to the table below.  Scholarships are available via the <a href="http://dinghao.ccagp.org/Fall2015SherKungMemorialScholarshipApplication.docx">Sher Shon Kung Memorial Scholarship</a>.  Please note, Ding Hao will make every effort to make up any time lost when schedule changes occur because of unforeseen events or inclement weather; however, the school will not offer refunds in the event of scheduling changes.</P>

<center>
<table style="width: 50%;">
<tr><th>Number of Children</th><th>Tuition</th></tr>
<tr><td>1 child</td><td>$<?php echo $values['tuition']; ?></td></tr>
<tr><td>2 children</td><td>$<?php echo 2*$values['tuition']; ?></td></tr>
<tr><td>3 children</td><td>$<?php echo (3-$values['discount_3rdkid'])*$values['tuition']; ?></td></tr>
<tr><td>4 children</td><td>$<?php echo (4-2*$values['discount_3rdkid'])*$values['tuition']; ?></td></tr>
<tr><td>5 children</td><td>$<?php echo (5-3*$values['discount_3rdkid'])*$values['tuition']; ?></td></tr>
<tr><td>Preschool</td><td>$<?php echo $values['tuition_year1']; ?> (each)</td></tr>
<tr><td>Adult</td><td>$<?php echo $values['tuition_adult']; ?> (each)</td></tr>
</table>
</center>

 
<P><em>There are two additional charges, a $<?php echo $values['pto']; ?> PTO fee and the CCAGP fee.</em>  The CCAGP (Chinese Cultural Association of Greater Philadelphia) is the umbrella organization under which Ding Hao functions.  CCAGP charges an annual fee on a per-parent basis.  In other words, a family with one parent/guardian will be charged $<?php echo $values['ccagp_oneparent']; ?>/year.  A family with two parents/guardians will be charged $<?php echo $values['ccagp_twoparent']; ?>/year.  The number of children is not a factor, because the fee correlates to the number of "voting members" of CCAGP.</P>
 
<P>Tuition will be refunded on a prorated cost-per-class basis to those who withdraw after attending the first, second or third class.  Fifty percent will be refunded to those who remain through the fourth class.  After the fourth class, no fees will be refunded.</P>
 
<P>Finally, please note that for safety reasons, we require that all parents wear identification badges while at school.  Badges can be obtained at the Security Desk on the second floor.  It is mandatory that all parents perform Badge Security Duty once a year.  Also, parents of children age 9 or younger must remain on the premises while the child is in the building.  Please review the <a href="http://dinghaochineseschool.org/registration/Document/GuideFaq.pdf">Parents' and Students' Guide</a> for more information on security procedures.  Many, many thanks in advance for your support and cooperation.</P>
 
<P>Sincerely,<br>
Betty Foo<br>
Principal of Ding Hao School</P>
 
<P>Both email and our website <a href="http://www.dinghaochineseschool.org">http://www.dinghaochineseschool.org/</a> are Ding Hao's sole means of communication. Please check your email and/or the website weekly. In addition, if your email address changes during the school year, please notify the school by contacting  the registrar <a href="mailto:registrar@dinghaochineseschool.org">registrar@dinghaochineseschool.org</a><!--Francine Bright fb19342@aol.com--> and the PTO President <a href="mailto:pto@dinghaochineseschool.org">pto@dinghaochineseschool.org</a><!-- Audra Lill lillaa@comcast.net-->. Families without email access are responsible for finding a partner family to stay informed.</P>

<form action="agreement.php" method="post">
<P class="button">
<input id="continue" type="submit" value="Start Registration">
</P>
</form>
<?php include('footer.html'); ?>
</body>
</html>
