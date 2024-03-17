<!-- Topbar -->

<section>
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <ul class="header__top__widget">
                        <li><span class="bi bi-geo-alt"></span> <?php echo $contact_r['email'] ?></li>
                        <li><span class="bi bi-phone"></span> +<?php echo $contact_r['pn1'] ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Topbar End -->

<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-dark px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 p-font text-white" href="index.php">WESTERN STAR</a>

        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">    
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link me-2 text-white" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link me-2 text-white" href="rooms.php">Rooms</a>
                </li>
                <li class="nav-item">
                <a class="nav-link me-2 text-white" href="contact.php">Contact Us</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" href="about.php">About</a>
                </li>
            </ul>

            <div class="d-flex">
                <a href="rooms.php" class="btn btn-md custom-bg text-white btn-outline-dark rounded-0 shadow-none">CHECK RATES</a>
            </div>
        </div>
    </div>
</nav>