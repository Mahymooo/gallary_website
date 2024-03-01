
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title="photos";
include_once('includes/head.php');
?>
</head>
<body>
    <?php
    // ----------------------------pagination-----------------------------------
    include_once('admin/includes/conn.php');
    $page=isset($_GET['page'])? $_GET['page'] : 1;
      try{
        $sqlp="SELECT COUNT(`id`) AS totalcount FROM `photos`";
        $stmtp=$conn->prepare($sqlp);
        $stmtp->execute();
        $resultp=$stmtp->fetch();
        $totalcount=$resultp['totalcount'];
        $pagelimit=8;
        $pagenumber=ceil($totalcount/$pagelimit);
        $offset=(($page-1)*$pagelimit);
        include_once('includes/functions.php');
      }catch(PDOEXCEPTION $e){
        echo "error".$e->getMessage();
      }
    include_once('includes/pageloader.php');
    include_once('includes/navigation.php');
    include_once('includes/search.php');
    include_once('includes/pagenumbering.php');
    include_once('includes/photo.php');
    include_once('includes/nextpage.php');
    include_once('includes/footer.php');
    include_once('includes/script.php');
    ?>
</body>
</html>