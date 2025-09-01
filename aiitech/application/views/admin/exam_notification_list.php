<?php
include_once('header.php');
?>

<?php
    $list = isset($list) ? $list  : array();
    $error = isset($error) ? $error : '';
?>

<div id="page-wrapper">

<!-- page content -->
<div class="right_col" role="main">

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="dashboard_graph">

            <div class="row x_title">
                <div class="col-md-6">
                    <h3>Exam notification List</small></h3>
                </div>
                <div class="col-md-6">
                    <b class="error-msg" style="color:red">
                    <?php
                        if ($error != '') {
                            echo $error;
                        }
                    ?>
                    </b>
                </div>
            </div>
        </div>


     <div class="xs tabls">
        <div class="bs-example4" data-example-id="contextual-table">
            <div class="x_content">
                <form method="post" name="form1" id="form1"  action="<?php echo site_url('/') . 'admin/examnotification/view'; ?>">
                        <input type="hidden" id="action" name="action" value="" />
                    <?php 
                    if ($login_rolename != 'student' ) { 
                    ?>
                        <button type="button" class="btn-primary" id="btnAdd" name="btnAdd">Add New </button>
                    <?php } ?>

                    <?php 
                    if ($login_rolename != 'student') { 
                    ?>
                        <button type="button" class="btn-primary " id="btnDeleteAll" name="btnDeleteAll">Delete selected only </button>
                    <?php } ?>

                   <div class="clearfix">
                       <br/>
                   </div>

                <table class="table">
                    <thead>
                        <tr class="headings">
                            <?php 
                            if ($login_rolename != 'student') { 
                            ?>
                                <th class="column-title"> 
                                        <input type="checkbox" class="chkDeleteAll" name="chkDeleteAll" id="chkDeleteAll"   />
                                </th>
                            <?php } ?>

                            <th class="column-title">Sno</th>
                            <th class="column-title">Graduate</th>
                            <th class="column-title">Apply Date</th>
                            <th class="column-title">Last Date</th>
                            <th class="column-title">Fees</th>
                            <th class="column-title">Penalty</th>
                            <?php 
                            if ($login_rolename != 'student') { 
                            ?>
                                <th class="column-title no-link last text-center">
                                    Edit
                                </th>
                                <th class="column-title no-link last text-center">
                                    Delete
                                </th>
                            <?php } ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $sno = 0; 
                            if ($list) {
                                foreach ($list  as $row) {
                                    $id = $row['id'];
                                    $eid = $this->common_model->myEncode($id);
                                    $sno++;
                        ?>
                                <tr class="even pointer">
                                    <?php 
                                    if ($login_rolename != 'student') { 
                                    ?>
                                        <td class=" ">
                                            <input type="checkbox" class="chkDelete" name="chkDelete[]" id="chkDelete[]"  value="<?php echo $id; ?>" />
                                        </td>
                                    <?php } ?>
                                    <td class=" "><?php echo $sno; ?></td>
                                    <td class=" "><?php echo $row['graduate']; ?></td>
                                    <td class=" "><?php echo date('d/M/Y', strtotime($row['apply_date'])); ?></td>
                                    <td class=" "><?php echo date('d/M/Y', strtotime($row['last_date'])); ?></td>
                                    <td class=" "><?php echo $row['fees']; ?></td>
                                    <td class=" "><?php echo $row['penalty']; ?></td>
                                    <?php 
                                    if ($login_rolename != 'student' ) { 
                                    ?>
                                            <td class=" last text-center">
                                                <a href="<?php echo site_url('/') . 'admin/examnotification/edit/' . $eid; ?>">Edit</a> 
                                            </td>
                                            <td class="last text-center" style="cursor: pointer;">
                                                <a class="deleteRecord" href1="<?php echo site_url('/') . 'admin/examnotification/delete/' . $eid; ?>">Delete</a> 
                                            </td>
                                    <?php } ?>
                                </tr>
                        <?php
                                }
                            }
                        ?>

                </tbody>
            </table>
            </form>
        </div>


    </div>
    </div>
    </div>

</div>
<br />

<!-- Delete -->
<button type="button" class="btn btn-primary delete-dlg" data-toggle="modal" data-target=".bs-example-modal-sm" style="display:none;">Delete modal</button>
<div class="modal fade bs-example-modal-sm delete-popup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Delete confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete this record?. </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-delete">Delete now</button>
            </div>

        </div>
    </div>
</div>
<!-- /delete -->

<!-- Delete -->
<button type="button" class="btn btn-primary delete-dlg-all" data-toggle="modal" data-target=".bs-example-modal-sm-all" style="display:none;">Delete All</button>
<div class="modal fade bs-example-modal-sm-all delete-popup-all" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Delete confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete all the selected record(s)?. </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-delete-all">Delete now</button>
            </div>

        </div>
    </div>
</div>
<!-- /delete -->
</div>

<script>
var delUrl = '';

$(document).ready(function(){
    $("#btnAdd").click(function(){
        var site_url = "<?php echo site_url('/'); ?>"; 
        document.location.href = site_url + 'admin/examnotification/add';
    });

    $(".deleteRecord").click(function(){
        delUrl = $(this).attr('href1');
        $('.delete-dlg').trigger('click');
    });

    $(".btn-delete").click(function(){
        $('.delete-popup').modal('hide');
        document.location.href = (delUrl);
    });

    $('.chkDeleteAll').change(function() {
        if ($(this).is(':checked')){
            $('.chkDelete').prop("checked", true);
        } else {
            $('.chkDelete').prop("checked", false);
        }
    });    

    $("#btnDeleteAll").click(function(){
        //delUrl = $(this).attr('href1');
        $('.delete-dlg-all').trigger('click');
    });

    $(".btn-delete-all").click(function(){
        $('.delete-popup-all').modal('hide');
        $('#action').val('deleteall');
        $('#form1').submit();
    });


});

</script>


<?php
    include_once('footer.php');
?>

