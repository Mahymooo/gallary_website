<?php
	include_once('includes/loginchecker.php');
	include_once('includes/conn.php');
	if(isset($_GET['id'])){
		$id=$_GET['id'];
	}
	// -------------------start updating-------------->
	if($_SERVER['REQUEST_METHOD']==='POST'){
	try{
		$sql_up="UPDATE `photos` SET`image`=?,`title`=?,`created_date`=?,`dimension`=?,`formate`=?,`lisence`=?,`tag_id`=?,`active`=? WHERE id=?";
		$title_up=$_POST['title'];
		$created_date_up=$_POST['created_date'];
		$dimension_up=$_POST['dimension'];
		$formate_up=$_POST['formate'];
		$lisence_up=$_POST['lisence'];
		$tag_id_up=$_POST['tag_id'];
		$active_up=isset($_POST['active']);
		if($_FILES['image']['error'] === UPLOAD_ERR_OK){
			include_once('includes/upload.php');
			$image_up=$image_name;
		}else{
			$image_up=$_POST['oldImage'];
		}
		$stmt=$conn->prepare($sql_up);
		$stmt->execute([$image_up, $title_up, $created_date_up, $dimension_up, $formate_up, $lisence_up, $tag_id_up, $active_up,$id]);
		header('location:photos.php');
	}catch(PDOEXCEPTION $e){
		echo "error".$e->getMessage();
	}
	}
	// --------------get current car data---------->
	try{
		$sql="SELECT `image`, `title`, `created_date`, `dimension`, `formate`, `lisence`, `tag_id`, `active` FROM `photos` WHERE id=?";
		$stmt=$conn->prepare($sql);
		$stmt->execute([$id]);
		$result=$stmt->fetch();
		// $image=$result['image'];
		$titlep=$result['title'];
		$created_date=$result['created_date'];
		$dimension=$result['dimension'];
		$formate=$result['formate'];
		$lisence=$result['lisence'];
		$tag_id=$result['tag_id'];
		$active=$result['active']? "checked":"";
		// header('location:photos.php');
	}catch(PDOEXCEPTION $e){
		echo "error".$e->getMessage();
	}
	try{
		// show tages in the select tag
		$sqltag="SELECT * FROM `tags`";
		$stmttag=$conn->prepare($sqltag);
		$stmttag->execute();
		$resulttag=$stmttag->fetchAll();
	  }catch(PDOEXCEPTION $e){
		echo $e->getMessage();
	  }
	
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
	 $title="edit photo";
	 include_once('includes/head.php');
	?>
</head>

<body class="nav-md">
<?php
	include_once('includes/profilequickinfo.php');
	?>

	<br />
	<?php
	include_once('includes/sidebar.php');
	include_once('includes/footerbutton.php');
	include_once('includes/topnavigation.php');
	?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Manage Photos</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Add Photo</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<!-- ----------------------------start the form---------------------- -->
									<form  action="" method="post" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="photo-date">Photo Date <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="date" id="photo-date" required="required" class="form-control " name="created_date" value="<?php echo $created_date; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="title" required="required" class="form-control " name="title" value="<?php echo $titlep; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="license">License <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<textarea id="lisence" name="lisence" required="required" class="form-control"><?php echo $lisence; ?></textarea>
											</div>
										</div>
										<div class="item form-group">
											<label for="dimension" class="col-form-label col-md-3 col-sm-3 label-align">Dimension <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="dimension" class="form-control" type="text" name="dimension" required="required" value="<?php echo $dimension; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="format" class="col-form-label col-md-3 col-sm-3 label-align">Format <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="format" class="form-control" type="text" name="formate" required="required" value="<?php echo $formate; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
											<div class="checkbox">
												<label>
									
													<input type="checkbox" class="flat" name="active" <?php echo $active ; ?>>
												</label>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Image <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="file" id="image" name="image" required="required" class="form-control">
												<br>
												<img src="./images/<?php echo $result['image']; ?>" alt="<?php echo $titlep; ?>" style="width:300px">
												<input type="hidden" name="oldImage" value="<?php echo $result['image']; ?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Tag <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="tag_id" id="">
													<option value=" ">Select Tag</option>
													<?php
													foreach($resulttag as $tag){
														?>
													<option value="<?php echo $tag['id']; ?>" <?php echo $tag_id==$tag['id']? "selected" : "" ?> ><?php echo $tag['tag'];?></option>
													<?php
													}
													?>
													
												</select>
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
												<button type="submit" class="btn btn-success">Add</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- /page content -->

			<!-- footer content -->
			<footer>
				<div class="pull-right">
					Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
				</div>
				<div class="clearfix"></div>
			</footer>
			<!-- /footer content -->
		</div>
	</div>

	<!-- jQuery -->
	<script src="vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!-- FastClick -->
	<script src="vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="vendors/nprogress/nprogress.js"></script>
	<!-- bootstrap-progressbar -->
	<script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<!-- iCheck -->
	<script src="vendors/iCheck/icheck.min.js"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="vendors/moment/min/moment.min.js"></script>
	<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap-wysiwyg -->
	<script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
	<script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
	<script src="vendors/google-code-prettify/src/prettify.js"></script>
	<!-- jQuery Tags Input -->
	<script src="vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
	<!-- Switchery -->
	<script src="vendors/switchery/dist/switchery.min.js"></script>
	<!-- Select2 -->
	<script src="vendors/select2/dist/js/select2.full.min.js"></script>
	<!-- Parsley -->
	<script src="vendors/parsleyjs/dist/parsley.min.js"></script>
	<!-- Autosize -->
	<script src="vendors/autosize/dist/autosize.min.js"></script>
	<!-- jQuery autocomplete -->
	<script src="vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
	<!-- starrr -->
	<script src="vendors/starrr/dist/starrr.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="build/js/custom.min.js"></script>

</body></html>
