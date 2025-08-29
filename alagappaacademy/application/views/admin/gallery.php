<!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- ./wrapper -->
  <!-- Left side column. contains the logo and sidebar -->
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
    <!-- Main content -->
    <section class="content">
      <div class="row">
	  
	  <?php
		
		/*if( $this->session->get_flashdata('message') ){
			$flashMsg = $this->session->get_flashdata('message');
				echo '<span class="flashmsg">'.$flashMsg.'</span>';
		}*/
		
		$urlParam = ((isset($id) && !empty($id)) ? 'edit/'.$id : 'add');
	  ?>
	  <form method="post" action="<?php echo base_url().'admin/home/gallery/'.$urlParam?>" enctype="multipart/form-data">
	  
        <!--<div class="col-md-12">
          <div class="box box-info">
           
            <div class="box-body pad">
             
                    <textarea id="editor1" name="content" rows="10" cols="80">
                           <?php //echo ((isset($selected->content) && !empty($selected->content)) ? $selected->content : set_value('content')); ?>                
                    </textarea>
              <?php //echo form_error('content'); ?>
            </div>
          </div>
          
        </div>-->
		<div class="col-md-6">
			<!--<div class="form-group">
			  <label>Select Type</label>
			  <select name="type" class="form-control">
				<option value="">-Select Type-</option>
				<option value="1" <?php echo ((isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] ==1) ? 'selected' : ( (isset($selected->type) && !empty($selected->type) && $selected->type ==1) ? 'selected' : '')) ?>>Home Banner</option>
				<option value="2" <?php echo ((isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] ==2) ? 'selected' : ( (isset($selected->type) && !empty($selected->type) && $selected->type ==2) ? 'selected' : '')) ?>>Inner Page Panner</option>
			  </select>
			  <?php echo form_error('type'); ?>
			</div>
					
			<div class="form-group">
			  <label>Name</label>
			  <input type="text" name="name" value="<?php echo ((isset($_POST['name']) && !empty($_POST['name'])) ? $_POST['name'] : ( (isset($selected->name) && !empty($selected->name)) ? $selected->name : '')) ?>" class="form-control" placeholder="Enter ...">
			  <?php echo form_error('name'); ?>
			</div>-->
			
			<div class="form-group">
			  <label>title</label>
			  <input type="text" name="title" value="<?php echo ((isset($_POST['title']) && !empty($_POST['title'])) ? $_POST['title'] : ( (isset($selected->title) && !empty($selected->title)) ? $selected->title : '')) ?>" class="form-control" placeholder="Enter ...">
			  <?php echo form_error('title'); ?>
			</div>
			
			<div class="form-group">
			  <label for="exampleInputFile">File input</label>
			  <input name="photo" type="file" id="exampleInputFile">
			  <input type="hidden" class="default" name="gallery_photo" value="<?php echo ((isset($upload_data['file_name']) && !empty($upload_data['file_name'])) ? $upload_data['file_name'] : ( (isset($selected->small_img) && !empty($selected->small_img)) ? $selected->small_img : ''))?>" id="old_photo">
			<?php echo ((isset($photo_error) && !empty($photo_error)) ? '<div class="alert-danger">'.$photo_error.'</div>' : '') ?>
			</div>
		
		<!--<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
				  <label>Title</label>
				  <input type="text" name="title" value="<?php echo ((isset($selected->title) && !empty($selected->title)) ? $selected->title : set_value('title')); ?>" class="form-control" placeholder="Please enter title">
				</div>
				<?php echo form_error('title'); ?>
			</div>
			<div class="col-md-6">
				<div class="form-group">
				  <label>Alias</label>
				  <input type="text" name="alias" value="<?php echo ((isset($selected->alias) && !empty($selected->alias)) ? $selected->alias : set_value('alias')); ?>" class="form-control" placeholder="Please enter Alias">
				</div>
				<?php echo form_error('alias'); ?>
			</div>
		</div>-->
		<div class="col-md-12 align-center">
			<div class="col-md-2 col-md-offset-3 pull-right text-center">
			<input type="submit" class="btn btn-block btn-primary" name="submit" value="<?php echo ((isset($selected->id) && !empty($selected->id)) ? 'Update' : 'Submit') ?>"/>
			</div>
		</div>
	</div>
	</form>
		
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
	
	
	
	
	<!-- Main content -->
    <section class="content">
	<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Gallery Lists</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  
				  <th>Title</th>
				  <th>Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php 
				
				if(isset($result) && !empty($result)):
					foreach($result as $res):?>
                <tr>
                  
				  <td><?php echo $res->title?></td>
				  <td><img src="<?php echo  base_url('/').'upload/gallery/thumb/'.$res->small_img ?>"> </td>
                  <td>
				  <?php $id = $res->id;?>
				  <a href="<?php echo base_url()?>admin/home/gallery/edit/<?php echo $id?>">Edit</a> |
				  <a onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url()?>admin/home/gallery/delete/<?php echo $id?>">Delete</a>
				  </td>
                </tr>
                <?php endforeach; endif; ?>
                </tbody>
                <tfoot>
                <tr>
                 
				  <th>Title</th>
				  <th>Image</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
	 </section>
	
	
	
	
  </div>
  
  
  

<!-- jQuery 3 -->
<script src="<?php echo base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>




<!-- FastClick -->
<script src="<?php echo base_url()?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>assets/dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="<?php echo base_url()?>assets/bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/dist/js/adminlte.min.js"></script>


<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>

<script>
  $(function () {

    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
