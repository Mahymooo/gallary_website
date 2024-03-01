	<?php
	include_once('includes/loginchecker.php');
	include_once('includes/conn.php');
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		echo "get";
	
		// ----------start updating-------------->
	if($_SERVER['REQUEST_METHOD']==='POST'){
	
	try{
		$sql="UPDATE `users` SET `full_name`=?,`user_name`=?,`password`=?,`email`=?,`active`=? WHERE `id`=?";
		$full_name=$_POST['full_name'];
		$user_name=$_POST['user_name'];
		$email=$_POST['email'];
		$active=isset($_POST['active']);
		if(empty($_POST['password'])){
			$password=$_POST['oldpassword'];
		}else{
			$password=password_hash($_POST['password'],PASSWORD_DEFAULT);
		}
		echo $email;
		$stmt=$conn->prepare($sql);
		$stmt->execute([$full_name, $user_name, $password, $email, $active, $id]);
		echo "ok";
		header('location:users.php');
	}catch(PDOEXCEPTION $e){
		echo "error".$e->getMessage();
	}
	}
		// ---------select the previous data----------
	try{
		$sql="SELECT `full_name`, `user_name`, `email`, `active`, `password` FROM `users` WHERE id=?";
		$stmt=$conn->prepare($sql);
		$stmt->execute([$id]);
		$result=$stmt->fetch();
		$full_name=$result['full_name'];
		$user_name=$result['user_name'];
		$email=$result['email'];
		$password=$result['password'];
		$active=$result['active'] ? "checked" : "";
	}catch(PDOEXCEPTION $e){
		echo "error".$e->getMessage();
	}
	}
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php
	 $title=" edit user";
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
							<h3>manage Users</h3>
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
									<h2>edit User</h2>
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
									<!-- <--------------------form start--------------------------------->
									<form action="" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Full Name <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" required="required" class="form-control " name="full_name" value="<?php echo $full_name; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="user-name">Username <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="user-name"  required="required" class="form-control" name="user_name" value="<?php echo $user_name; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Email <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="email" class="form-control" type="email" required="required" name="email" value="<?php echo $email; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
											<div class="checkbox">
												<label>
													<input type="checkbox" class="flat" name="active" <?php echo $active; ?>>
												</label>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
											<input type="hidden"  name="oldpassword"  value="<?php echo $password?>" >
											<input type="password" id="password" required="required" class="form-control" name="password" >
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
												<button type="submit" class="btn btn-success">edit</button>
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
			<?php
      include_once('includes/footer.php');
      ?>

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
