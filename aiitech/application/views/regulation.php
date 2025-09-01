<?php include 'header.php'; ?>
<div class="container">
<div class="row">
<div class="banner">
<img src="img/banner.jpg" alt="ImageMissing"/>
</div>
</div>
</div>

<div class="container">
<div class="main-page">
<div class="row">

<div class="col-lg-3 col-xs-12 area">
<?php include 'major_links.php'; ?>
</div>
<?php include "social.php";?>
<div class="col-lg-8 col-xs-12 profile">
<h3>SYLLABUS</h3>
<div class="col-lg-12 col-xs-12 page-link">
<p> <a href="<?php echo $PDF_SEMESTER_PROGRAMES;?>" > Click here for Semester Programmes </a></p>
<p><a href="<?php echo $PDF_NON_SEMESTER_PROGRAMES;?>" title="Non-Semester Programme">Click here for Non-Semester Programmes</p>
</div>
</div>

</div>
</div>
</div>

<?php include "footer.php"; ?>
