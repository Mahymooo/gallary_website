<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-film mr-2"></i>
                my website
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-link-1 <?php if($title=="photos"){echo "active"; }else{echo "";}?>" aria-current="page" href="index.php">Photos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-2 <?php if($title=="video"){echo "active"; }else{echo "";}?>" href="videos.html">Videos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-3 <?php if($title=="about"){echo "active"; }else{echo "";}?>" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-4 <?php if($title=="contact"){echo "active"; }?>" href="contact.php">Contact</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>