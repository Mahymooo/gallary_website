
<div class="row tm-mb-90">
            <div class="col-12 d-flex justify-content-between align-items-center tm-paging-col">
                <a href="index.php?page=<?php echo ($page-1); ?>" class="btn btn-primary tm-btn-prev mb-2 <?php if($page==1){echo "disabled";}?>">Previous</a>
                <div class="tm-paging d-flex">
                    <?php
                    for($counter=1; $counter<=$pagenumber ; $counter ++){

                    ?>
                    <a href="index.php?page=<?php echo $counter; ?>" class=" tm-paging-link <?php if($counter==$page){echo "active"; }else{echo "";}?>"><?php echo $counter;?></a>
                    <?php
                    }
                    ?>

                </div>
                <a href="index.php?page=<?php echo ($page+1);?>" class="btn btn-primary tm-btn-next <?php if($page==4){echo "disabled";}?>">Next Page</a>
            </div>            
        </div>
    </div> <!-- container-fluid, tm-container-content -->