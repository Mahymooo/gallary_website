<?php 
if(isset($_GET['page']) and $_GET['page']>0){
    $page=$_GET['page'];
}
if(isset($_GET['number'])){
    $number=$_GET['number'];
}
?>
<div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-6 tm-text-primary">
                Latest Photos
            </h2>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <form action="index.php?page=<?php echo $number ; ?>" method="GET" class="tm-text-primary">
                    Page <input type="text" name="number" value="<?php if(isset($_GET['page'])){echo $page;}else{echo "1";}?>" size="1" class="tm-input-paging tm-text-primary"> of 4
                </form>
            </div>
        </div>