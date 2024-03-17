<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - HOME</title>
    
    <style>
        .availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }

        .logo-margin {
            margin-right: 8px;
        }

        @media screen and (max-width: 575px) {
            .availability-form {
                margin-top: 0px;
                padding: 0 35px;
            }
        }

    </style>

</head>
<body>
    
        <?php require('inc/header.php'); ?>

        

    <!-- Carousel -->

    <section class="">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <?php
                    $res = selectAll('carousel');

                    while($row = mysqli_fetch_assoc($res))
                    {
                        $path = CAROUSEL_IMG_PATH;
                        echo <<<data
                            <div class="swiper-slide">
                                <img src="$path$row[image]" class="d-block w-100" alt="img-slide" style="height: 600px;">
                            </div>
                        data;
                    }
                ?>
            </div>
        </div>
    </section>

    <!-- Home About Section Begin -->
    <section class="home-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="home__about__text">
                        <div class="section-title">
                            <h5>WELCOME TO WESTERN STAR HOTEL</h5>
                            <h2>A New Vision of Luxury</h2>
                        </div>
                        <p class="first-para">Our commitment is to provide an unforgettable experience, offering a haven of comfort and sophistication in the heart of Kakamega.</p>
                        <p class="last-para">where modern luxury meets warm hospitality. Nestled in the heart of Kakamega, our hotel offers well-appointed rooms, exceptional dining experiences, and state-of-the-art meeting facilities.</p>
                        <img src="images/art-signature.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="home__about__pic">
                        <img src="images/star.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home About Section End -->

    <!-- Services Section Begin -->
    <section class="services spad bg-light">
        <div class="container">

            <div class="services-title">
                <h6>WHY CHOOSE WESTERN STAR HOTEL</h6>
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
    <!-- Services Section End -->

    <!-- Our Rooms Begin-->
    <div class="site-section">

        <div class="my-5 px-4">
            <h2 class="mt-5 pt-4 mb-4 text-center fw-bold p-font">Explore Our Rooms</h2>
            <div class="h-line bg-dark"></div>
        </div>

        <div class="container">
            <div class="row">
   
                    <?php
                        $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3",[1,0],'ii');
    
                        while($room_data = mysqli_fetch_assoc($room_res))
                        {
                            // get features of room
    
                            $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f INNER JOIN `room_features` rfea ON f.id = rfea.features_id WHERE rfea.room_id = '$room_data[id]'");
    
                            $features_data = "";
                            while($fea_row = mysqli_fetch_assoc($fea_q)){
                                $features_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                    $fea_row[name]
                                </span>";
    
                            }
    
                            // get facilities of room
    
                            $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");
    
                            $facilities_data = "";
                            while($fac_row = mysqli_fetch_assoc($fac_q)){
                                $facilities_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                    $fac_row[name]
                                </span>";
                            }
    
                            // get thumbnail of image
    
                            $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
                            $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");
    
                            if(mysqli_num_rows($thumb_q)>0){
                                $thumb_res = mysqli_fetch_assoc($thumb_q);
                                $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
                            }
    
    
                            $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review`
                                WHERE `room_id`='$room_data[id]' ORDER BY `sr_no` DESC LIMIT 20";
    
                            $rating_res= mysqli_query($con, $rating_q);
                            $rating_fetch = mysqli_fetch_assoc($rating_res);
    
                            $rating_data = "";
                                                
                            if($rating_fetch ['avg_rating']!=NULL)
                            {
                                $rating_data = "<div class='rating mb-4'>
                                <h6 class='mb-1'>Rating</h6>
                                <span class='badge rounded-pill bg-light'>
                                ";
                                for ($i=0; $i<$rating_fetch['avg_rating']; $i++){
                                $rating_data .="<i class='bi bi-star-fill text-warning'></i> ";
                                }
                                $rating_data .= "</span>
                                </div>
                                ";
                            }
    
                            // print room card
    
                            echo<<<data
                                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                                    <div class="card card-explore">
                                        <div class="card-explore__img">
                                            <img class="card-img" src="$room_thumb" alt="room">
                                        </div>
                                        
                                        <div class="card-body">
                                        <h4 class="card-explore__title p-font">$room_data[name]</h4>
                                            <h3 class="card-explore__price p-font">Ksh $room_data[price] <sub>/ Per Night</sub></h3>
                                            <p class="card-explore__body r-font mt-4">$room_data[description]</p>
                                            <div class="mt-3 text-center">
                                                <a href="room_details.php?id=$room_data[id]" class="btn btn-md btn-outline-dark rounded-0 fw-bold shadow-none">DETAILS</a>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            data;
                        }                 
                    ?>
                
                <div class="col-lg-12 text-center mt-5">
                    <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Rooms End-->

 
    <!-- Testimonials -->
    
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold p-font">TESTIMONIALS</h2>

    <div class="container mt-5">
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper mb-5">

                <?php

                    $review_q = "SELECT rr.*, uc.name AS uname, r.name AS rname FROM `rating_review` rr
                        INNER JOIN `user_cred` uc ON rr.user_id = uc.id
                        INNER JOIN `rooms` r ON rr.room_id = r.id
                        ORDER BY `sr_no` DESC LIMIT 6";

                    $review_res = mysqli_query($con, $review_q);
                    
                    if(mysqli_num_rows($review_res)==0){
                        echo 'No reviews yet!';
                    }
                    else
                    {
                        while ($row = mysqli_fetch_assoc($review_res))
                        {
                            $stars= "<i class='bi bi-star-fill text-warning'></i> ";
                            for($i=1; $i<row['rating']; $i++){
                                $stars .= " <i class='bi bi-star-fill text-warning'><i>";
                            }

                            echo<<<slides
                                <div class="swiper-slide bg-white p-4">
                                    <div class="profile d-flex align-items-center mb-3">
                                        <i class="bi bi-person-circle"></i>
                                        <h6 class="m-0 ms-2">$row [uname]</h6>
                                    </div>
                                    <p>
                                        $row [review]
                                    </p>
                                    <div class="rating">
                                        $stars
                                    </div>
                                </div>
                            slides;
                        }
                    }

                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="col-lg-12 text-center mt-5 mb-5">
            <a href="about.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none"> Know More <i class="bi bi-arrow-right"></i></a>
        </div>        
    </div>

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
                        <a href="rooms.php" class="btn btn-md rounded-0 text-white custom-bg shadow-none">CHECK RATES</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Chooseus Section End -->

    <!-- Reach Us -->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold p-font">LOCATION</h2>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 p-4 mb-lg-0 mb-3 bg-white rounded">
                <iframe class="w-100" height="450px" src="<?php echo $contact_r['iframe'] ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            
        </div>
    </div>

    

    <!-- Footer -->

    <?php require('inc/footer.php'); ?>

    


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".swiper-container", {
            loop: true, // Enable continuous loop
            /* autoplay: {
                delay: 10000,
                disableOnInteraction: false,
            } */
        });

        var swiper = new Swiper(".swiper-testimonials", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
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