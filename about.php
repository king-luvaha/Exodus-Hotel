<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - ABOUT</title>
    
    <style>
        .box {
            border-top-color: var(--teal) !important;
        }
    </style>
    
</head>
<body>
    
    <?php require('inc/header.php'); ?>

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option set-bg" style="background-image: url('images/breadcrumb-bg.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h1>About Us</h1>
                        <div class="breadcrumb__links">
                            <span>Home</span>
                            <span style="font-weight: bold;">&gt;</span>
                            <span>About Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="about__content">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="section-title">
                            <h5>Our Specialization</h5>
                            <h2>Western Star</h2>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="about__text">
                            <p>Our commitment is to provide an unforgettable experience, offering a haven of comfort and sophistication in the heart of Kakamega.</p>
                            <p><?php echo $settings_r['site_about'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $res = mysqli_query($con,"SELECT * FROM `facilities` ORDER BY `id` LIMIT 6");
                    $path = FACILITIES_IMG_PATH;

                    while($row = mysqli_fetch_assoc($res)){
                        echo<<<data
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="services__item">
                                    <img src="$path$row[icon]" width="36px" alt="svg-icon">
                                    <h4>$row[name]</h4>
                                    <p>$row[description]</p>
                                </div>
                            </div>
                        data;
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Chooseus Section Begin -->
    <div class="chooseus spad set-bg" style="background-image: url('images/breadcrumb-bg.jpg')">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="chooseus__text">
                        <div class="section-title">
                            <h5>WHY CHOOSE US</h5>
                            <h2>Contact us now to get the latest deals and for the next booking</h2>
                        </div>
                        <a href="rooms.php" class="btn btn-md text-white custom-bg shadow-none">Booking Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Chooseus Section End -->

    <h3 class="my-5 fw-bold p-font text-center">
        MANAGEMENT TEAM
    </h3>

    <div class="container px-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper mb-5">
                <?php
                    $about_r = selectAll('team_details');
                    $path = ABOUT_IMG_PATH;

                    while($row = mysqli_fetch_assoc($about_r)){
                        echo<<<data
                        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                            <img src="$path$row[picture]" class="w-100" alt="team-image">
                            <h5 class="mt-2">$row[name]</h5>
                        </div>
                        data;
                    }
                ?>
                
                
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
  
    <?php require('inc/footer.php'); ?>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 40,
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints :{
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });
    </script>

</body>
</html>