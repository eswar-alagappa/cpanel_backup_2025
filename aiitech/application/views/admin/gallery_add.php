<?php include "header.php"; ?>
   
<?php
$id = isset($id) ? $id : 0;
$error = isset($error) ? $error : '';

$image_url = isset($image_url) ? $image_url : '';
$title = isset($title) ? $title : '';
$description = isset($description) ? $description : '';

if (isset($details)) {
    $row = $details[0];
    $title = $row['title'];
    $description = $row['description'];
    $image_url = $row['image_url'];
}   
?>


<div id="page-wrapper">

<div class="page-title">
    <div class="title_left">
        <h3>
            <?php 
            if ($id==0) {
                echo 'Gallery / Portfolio Add';
            } else {
                echo 'Gallery / Portfolio Edit';
            }
            ?>
        </h3>

        <b style="color: red">
        <?php 
            if ($error != '') {
                echo $error;
            }
        ?>
        </b>

    </div>
</div>


<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <br />
                <form id="frmCategory" name="frmCategory" data-parsley-validate class="form-horizontal form-label-left"
                method="post" 
                enctype = "multipart/form-data"
                action="<?php echo site_url('/')?>admin/gallery/save" onsubmit='return checkSubmit();'>

                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" /> 
                    <input type="hidden" id="image_url" name="image_url" value="<?php echo $image_url; ?>" /> 

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" id="image" name="image" <?php echo $image_url=='' ? ' required="required" ' : '' ?> 
                            class="form-control col-md-7 col-xs-12" >
                            <small class="error-msg image"></small>
                        </div>
                    </div>

                    <?php if ($image_url != '') { 
                        $image_name = base_url() . '/uploads/' . $image_url;
                    ?>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Selected Image
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <img src="<?php echo $image_name; ?>" width="50px" height="50px"> </img>';
                        </div>
                    </div>

                    <?php } ?>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="title" name="title" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $title; ?>"/>
                            <small class="error-msg title"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="description" name="description" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $description; ?>"/>
                            <small class="error-msg description"></small>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <a href="<?php echo site_url('/');?>admin/gallery" class="btn btn-primary">Back</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!--body wrapper start-->
</div>

 <!--body wrapper end-->
</div>

       
<script>
$(document).ready(function(){
});

function checkSubmit(){
    $('.error-msg').text('').hide();
    var id = Number($('#id').val());
    var title = $('#title').val();
    if (title.length < 1) {
        $('.title').text('Title is required').show();
        return false;
    }
    var description = $('#description').val();
    if (description.length < 1) {
        $('.description').text('Description is required').show();
        return false;
    }

    var image = $('#image').val();
    var banner = $('#banner').val();
     if (id == 0) {
        if (image.length < 3) {
            $('.image').text('Image is required').show();
            return false;
        }
        if (image.indexOf('.png') > 0 || image.indexOf('.jpg') > 0){
        } else {
            $('.image').text('png/jpg image is required').show();
            return false;
        }
    } else {
        if (image.length > 0){
            if (image.indexOf('.png') > 0 || image.indexOf('.jpg') > 0){
            } else {
                $('.image').text('png/jpg image is required').show();
                return false;
            }
        }
    }

   return true;
}

</script>

<?php include "footer.php"; ?>
