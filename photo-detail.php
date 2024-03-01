<?php
include_once('admin/includes/conn.php');
if(!isset($_GET['search'])){
if(isset($_GET['id'])){
    $id=$_GET['id'];

// -------------------------select the photo data--------------------
try{
    $sqls="SELECT `image`, `title`, `created_date`, `views`, `dimension`, `formate`, `lisence`, `tag_id` FROM `photos` WHERE `id`=?";
    $stmts=$conn->prepare($sqls);
    $stmts->execute([$id]);
    $results=$stmts->fetch();
    $images=$results['image'];
    $titles=$results['title'];
    $created_at=$results['created_date'];
    $views=$results['views'];
    $dimension=$results['dimension'];
    $formate=$results['formate'];
    $lisence=$results['lisence'];
    $tag_id=$results['tag_id'];
    $viewcount=$results['views']+1;
  }catch(PDOEXCEPTION $e){
    echo "error".$e->getMessage();
  }
//   -------------------------count image views-------------------------------
  try{
    $sqlv="UPDATE `photos` SET `views`='$viewcount'  WHERE id=?";
    $stmtv=$conn->prepare($sqlv);
    $stmtv->execute([$id]);
    // header('location:photos.php');
}catch(PDOEXCEPTION $e){
    echo "error".$e->getMessage();
}
//   ---------------------------select tag data--------------------
try{
	$sql="SELECT `tag` FROM `tags`";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$result=$stmt->fetchAll();
	// header('location:photos.php');
}catch(PDOEXCEPTION $e){
	echo "error".$e->getMessage();
}}
// --------------------show related image------------------
try{
    $sqlr="SELECT `id`,`title`,`image`,`created_date`,`views` FROM `photos` WHERE `tag_id`=?";
    $tag_idr=$results['tag_id'];
    $stmtr=$conn->prepare($sqlr);
    $stmtr->execute([$tag_idr]);
    $resultr=$stmtr->fetchAll();
  }catch(PDOEXCEPTION $e){
    echo "error".$e->getMessage();
  }
//   ----------------------------------show search result----------------------
}else{
  $search_result=$_GET['search'];
  try{
    $sql="SELECT `id`,`image`, `title`, `created_date`, `views` FROM `photos` WHERE `title` LIKE '%$search_result%'";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $resultr=$stmt->fetchAll();
  }catch(PDOEXCEPTION $e){
    echo "error".$e->getMessage();
  }}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php
$title="photo_details";
include_once('includes/head.php');
?>
</head>
<body>
<?php
    include_once('includes/pageloader.php');
    include_once('includes/navigation.php');
    include_once('includes/search.php');
    ?>
    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary"><?php echo $titles; ?></h2>
        </div>
        <div class="row tm-mb-90">            
            <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
                <img src="admin/images/<?php echo $images; ?>" alt="Image" class="img-fluid">
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="tm-bg-gray tm-video-details">
                    <p class="mb-4">
                        Please support us by making <a href="https://paypal.me/templatemo" target="_parent" rel="sponsored">a PayPal donation</a>. Nam ex nibh, efficitur eget libero ut, placerat aliquet justo. Cras nec varius leo.
                    </p>
                    <div class="text-center mb-5">
                        <a href="#" class="btn btn-primary tm-btn-big">Download</a>
                    </div>                    
                    <div class="mb-4 d-flex flex-wrap">
                        <div class="mr-4 mb-2">
                            <span class="tm-text-gray-dark">Dimension: </span><span class="tm-text-primary"><?php echo $dimension; ?></span>
                        </div>
                        <div class="mr-4 mb-2">
                            <span class="tm-text-gray-dark">Format: </span><span class="tm-text-primary"><?php echo $formate; ?></span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h3 class="tm-text-gray-dark mb-3">License</h3>
                        <p><?php echo $lisence; ?>.</p>
                    </div>
                    <div>
                        <h3 class="tm-text-gray-dark mb-3">Tags</h3>
                        <?php
                        foreach($result as $tag){
                            $tag=$tag['tag'];
                        ?>
                        <a href="index.php" class="tm-text-primary mr-4 mb-2 d-inline-block"><?php echo $tag; ?></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary">
                Related Photos
            </h2>
        </div>
        <div class="row mb-3 tm-gallery">
            <!-- ----------------show the related photo--------------- -->
        <?php
            foreach($resultr as $photo){
                $id=$photo['id'];
                $title=$photo['title'];
                $image=$photo['image'];
                $views=$photo['views'];
                $date=$photo['created_date'];
         ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="admin/images/<?php echo $image; ?>" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2><?php echo $title; ?></h2>
                        <a href="photo-detail.php?id=<?php echo $id; ?>">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light"><?php echo $date?></span>
                    <span><?php echo $views; ?></span>
                </div>
            </div>
            <?php
             }
            ?>
            <!-- <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-02.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Perfumes</h2>
                        <a href="#">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">12 Oct 2020</span>
                    <span>11,402 views</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-03.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Clocks</h2>
                        <a href="#">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">8 Oct 2020</span>
                    <span>9,906 views</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-04.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Plants</h2>
                        <a href="#">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">6 Oct 2020</span>
                    <span>16,100 views</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-05.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Morning</h2>
                        <a href="#">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">26 Sep 2020</span>
                    <span>16,008 views</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-06.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Pinky</h2>
                        <a href="#">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">22 Sep 2020</span>
                    <span>12,860 views</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-07.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Bus</h2>
                        <a href="#">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">12 Sep 2020</span>
                    <span>10,900 views</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-08.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>New York</h2>
                        <a href="#">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">4 Sep 2020</span>
                    <span>11,300 views</span>
                </div>
            </div>         -->
        </div> <!-- row -->
    </div> <!-- container-fluid, tm-container-content -->
    <?php
    include_once('includes/footer.php');
    include_once('includes/script.php');
    ?>
    
  
</body>
</html>