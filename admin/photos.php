<?php
include_once('includes/loginchecker.php');
include_once('includes/conn.php');
try{
  $sql="SELECT `id`, `image`, `title`, `created_date`, `views`, `dimension`, `formate`, `lisence`, `tag_id`, `active` FROM `photos` ";
  $stmt=$conn->prepare($sql);
  $stmt->execute();
  $result=$stmt->fetchAll();
}catch(PDOEXCEPTION $e){
  echo "error".$e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  $title="photos";
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
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
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
                    <h2>List of Photos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>

                          <th>image</th>
                          <th>Photo Date</th>
                          <th>Title</th>
                          <th>Active</th>
                          <th>views</th>
                          <th>lisence</th>
                          <th>formate</th>
                          <th>dimension</th>
                          <th>tag</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <!-- -------------the row--------- -->
                      <tbody>
                        <?php
                        foreach($result as $row){
                          $id=$row['id'];
                          if($row['image']==""){
                            $image="user.png";
                        }else{
                            $image=$row['image'];
                
                        }
                          $created_date=date("d M Y",strtotime($row['created_date']) );
                          $title=$row['title'];
                          $active=$row['active']; 
                          if($active==true){
                            $active="yes";
                          }else{
                            $active="no";
                          } 
                          $views=$row['views'];
                          $dimension=$row['dimension'];
                          $formate=$row['formate'];
                          $tag=$row['tag_id'];
                          $lisence=$row['lisence'];
                        
                        ?>
                        <tr>
                        <td><img src="images/<?php echo $image ?>"alt="<?php echo $title; ?>" style="width:100px"></td>
                          <td><?php echo $created_date ?></td>
                          <td><?php echo $title ?></td>
                          <td><?php echo $active ?></td>
                          <td><?php echo $views ?></td>
                          <td><?php echo $lisence ?></td>
                          <td><?php echo $formate ?></td>
                          <td><?php echo $dimension ?></td>
                          <td><?php echo $tag ?></td>
                          <td><a href="editphoto.php?id=<?php echo $id; ?>"><img src="./images/edit.png" alt="Edit"></a></td>
                          <td><a href="deletephoto.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this user?')"><img src="images/delete.png" alt="delete"></a></td>
                        </tr>
                          <?php
                          }?>
                      </tbody>
                    </table>
                  </div>
                  </div>
              </div>
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
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

  </body>
</html>