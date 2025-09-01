<?php include 'header.php'; ?>
<div class="container">
<div class="row">
<div class="banner">
<img src="<?php echo base_url('/');?>img/banner.jpg" alt="ImageMissing"/>
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
    
    <ul id="portfolio" class="clearfix">
    <!--
    <li><a href="img/slider1.jpg"><img src="img/slider1.jpg"></a>
	<span class="figcap">Descriptoion about the image</span></li>
	
	<li><a href="img/slider2.jpg"><img src="img/slider2.jpg"></a>
	<span class="figcap">Descriptoion about the image</span></li>

	<li><a href="img/slider1.jpg"><img src="img/slider1.jpg"></a>
	<span class="figcap">Descriptoion about the image</span></li>

	<li><a href="img/slider2.jpg"><img src="img/slider2.jpg"></a>
	<span class="figcap">Descriptoion about the image</span></li>

	<li><a href="img/slider1.jpg"><img src="img/slider1.jpg"></a>
	<span class="figcap">Descriptoion about the image</span></li>

	<li><a href="img/slider2.jpg"><img src="img/slider2.jpg"></a>
	<span class="figcap">Descriptoion about the image</span></li>
 -->
<?php
  $sql = "select g.*  ";
  $sql .= " from gallery g " ;
  $sql .= " order by g.id ";
  $query = $this->db->query($sql);
  $rows = $query->result_array();
  foreach($rows as $row){
?>

  <li><a href="<?php echo $IMAGE_DIR . $row['image_url'];?>">
    <img src="<?php echo $IMAGE_DIR . $row['image_url'];?>"></a>
  <span class="figcap"><?php echo $row['description'];?></span></li>

<?php
}
?>


    </ul>

</div>
</div>
</div>
</div>

<script type="text/javascript">
$(function(){
  $('#portfolio').magnificPopup({
    delegate: 'a',
    type: 'image',
    image: {
      cursor: null,
      titleSrc: 'title'
    },
    gallery: {
      enabled: true,
      preload: [0,1], // Will preload 0 - before current, and 1 after the current image
      navigateByImgClick: true
		}
  });
});
</script>

<?php include "footer.php"; ?>
