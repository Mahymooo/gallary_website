<?php
include_once('admin/includes/conn.php');
if(!isset($_GET['search'])){
  // -----------------------------pagination------------------

  // -----------------show the database photo--------------
  
try{

    $sql="SELECT `id`,`title`,`image`,`created_date`,`views` FROM `photos` ORDER BY `created_date` DESC LIMIT $offset, $pagelimit ";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $result=$stmt->fetchAll();
  }catch(PDOEXCEPTION $e){
    echo "error".$e->getMessage();
  }
 ?>
     <div class="row tm-mb-90 tm-gallery">
    <?php
    foreach($result as $photo){
        $id=$photo['id'];
        $image=$photo['image'];
        $title=$photo['title'];
        $created_date=$photo['created_date'];
        $views=$photo['views'];
    ?>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
          <figure class="effect-ming tm-video-item">
                 <img src="admin/images/<?php echo $image; ?>" alt="Image" class="img-fluid">
                 <figcaption class="d-flex align-items-center justify-content-center">
                       <h2><?php echo $title; ?></h2>
                     <a href="photo-detail.php?id=<?PHP echo $id; ?>">View more</a>
                 </figcaption>                    
            </figure>
             <div class="d-flex justify-content-between tm-text-gray">
                 <span class="tm-text-gray-light"><?php echo $created_date; ?></span>
             <span><?php echo $views; ?></span>
             </div>
     </div>
        <?php
         }
        ?>
        <!-- --------------------------show the result of the search bar--------------------------- -->
        <?php
  }else{
    $search_result=$_GET['search'];
  try{
    $sql="SELECT `id`,`image`, `title`, `created_date`, `views` FROM `photos` WHERE `title` LIKE '%$search_result%'";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    // if($stmt->rowcount($search_result)>0){
    $resultr=$stmt->fetchAll();
  }catch(PDOEXCEPTION $e){
    echo "error".$e->getMessage();
  }
  ?>
      <div class="row tm-mb-90 tm-gallery">
      <?php
      foreach($resultr as $photo){
          $id=$photo['id'];
          $imager=$photo['image'];
          $titler=$photo['title'];
          $created_dater=$photo['created_date'];
          $viewsr=$photo['views'];
      ?>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
                 <img src="admin/images/<?php echo $imager; ?>" alt="Image" class="img-fluid">
                 <figcaption class="d-flex align-items-center justify-content-center">
                       <h2><?php echo $titler; ?></h2>
                     <a href="photo-detail.php?id=<?PHP echo $id; ?>">View more</a>
                 </figcaption>                    
            </figure>
             <div class="d-flex justify-content-between tm-text-gray">
                 <span class="tm-text-gray-light"><?php echo $created_dater; ?></span>
             <span><?php echo $viewsr; ?></span>
             </div>
     </div>
        <?php
         }}
        ?>
     </div>     
       
     </div> <!-- row -->