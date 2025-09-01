<?php
    include_once('header.php');
?>

<?php

$SCREEN_NAME = isset($SCREEN_NAME) ? $SCREEN_NAME : '';
$arr = isset($arr) ? $arr : array();
$arrTitle = isset($arrTitle) ? $arrTitle : array();
foreach ($arr as $key => $value) {
    $$value = isset($$value) ? $$value : '';
}
$message = isset($message) ? $message : '';
$DIR = base_url('/') . 'doc/';


?>

<div id="page-wrapper">
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">

            <div class="page-title">
                <div class="title_left">
                    <h3>
                        <?php 
                            if ($SCREEN_NAME == 'pdfupload') {
                                echo 'PDF file Upload';
                            } else {
                                echo 'Settings';
                            }
                        ?>
                    </h3>

                    <b class="error-msg" style="color: red">
                    <?php 
                        if ($message != '') {
                            echo $message;
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
                            enctype = "multipart/form-data"
                            method="post" action="<?php echo site_url('/');?>admin/settings/save" 
                            onsubmit='return checkSubmit();'>

                            <input type="hidden" id="SCREEN_NAME" name="SCREEN_NAME" value="<?php echo $SCREEN_NAME; ?>" /> 

                                <?php if ($SCREEN_NAME == 'pdfupload') { 
                                    $i = 0;
                                    foreach ($arr as $key => $value) {
                                        $title = $arrTitle[$i];
                                        if ($this->common_model->left($title,5) == 'TITLE') {
                                            $title = str_replace('TITLE-', '', $title);
                                            echo '<h2 style="text-align:center;">' . $title . '</h2>';
                                            $i++;
                                            continue;
                                        }

                                ?>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $arrTitle[$i]; ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="file" id=<?php echo $value; ?> name="<?php echo $value; ?>" <?php echo $$value=='' ? ' required1="required" ' : '' ?> 
                                            class="form-control col-md-7 col-xs-12" >
                                            <small class="error-msg"></small>
                                        </div>
                                    </div>

                                    <?php if ($$value != '') { 
                                        $file = $DIR . $$value;
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Selected file
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <a _target="blank" href="<?php echo $file; ?>"> <?php echo $$value; ?></a>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>


                                <?php
                                        $i++;
                                        }
                                    }
                                ?>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>

<script>

$(document).ready(function(){
});

function checkSubmit(){
    return true;
}

</script>


<?php
    include_once('footer.php');
?>