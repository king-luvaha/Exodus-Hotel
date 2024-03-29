<?php

    require('../admin/inc/db_config.php');
    require('../admin/inc/essentials.php');
    date_default_timezone_set("Africa/Nairobi");

    session_start();

    if(isset($_GET['fetch_rooms']))
    {
        

        // count no. of rooms and output variable to store room cards
        $count_rooms = 0;
        $output = "";

        // fetching settins table to check website is shutdown or not
        $settings_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
        $settings_r = mysqli_fetch_assoc(mysqli_query($con,$settings_q));

        //query for room cards with guests filter
        $room_res = select("SELECT * FROM `rooms` WHERE `adult`>=? AND `children`>=?", [1, 0], 'ii');

        while($room_data = mysqli_fetch_assoc($room_res))
        {
            // get facilities of room with filters
            $fac_count=0;

            $fac_q = mysqli_query($con,"SELECT f.name, f.id FROM `facilities` f
             INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
              WHERE rfac.room_id = '$room_data[id]'");

            $facilities_data = "";
            while($fac_row = mysqli_fetch_assoc($fac_q))
            {
                if(in_array($fac_row['id'])){
                    $fac_count++;
                }
                $facilities_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                    $fac_row[name]
                </span>";
            }


            // get features of room

            $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f INNER JOIN `room_features` rfea ON f.id = rfea.features_id WHERE rfea.room_id = '$room_data[id]'");

            $features_data = "";
            while($fea_row = mysqli_fetch_assoc($fea_q)){
                $features_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                    $fea_row[name]
                </span>";

            }


            // get thumbnail of image

            $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
            $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

            if(mysqli_num_rows($thumb_q)>0){
                $thumb_res = mysqli_fetch_assoc($thumb_q);
                $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
            }

            

            // print room card

            $output.="
                <div class='card mb-4 border-0 shadow'>
                    <div class='row g-0 p-3 align-items-center'>
                        <div class='col-md-5 mb-lg-0 mb-md-0 mb-3'>
                            <img src='$room_thumb' class='img-fluid rounded' alt='room-image'>
                        </div>
    
                        <div class='col-md-5 px-lg-3 px-md-3 px-0'>
                            <h5 class='mb-3'>$room_data[name]</h5>
    
                            <div class='features mb-3'>
                                <h6 class='mb-1'>Features</h6>
                                $features_data
                            </div>
    
                            <div class='facilities mb-3'>
                                <h6 class='mb-1'>Facilities</h6>
                                $facilities_data
                            </div>
    
                            <div class='guests'>
                                <h6 class='mb-1'>Guests</h6>
                                <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                    $room_data[adult] Adults
                                </span>
                                <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                    $room_data[children] children
                                </span>
                    
                            </div>
                        </div>
    
                        <div class='col-md-2 mt-lg-0 mt-md-0 mt-4 text-center'>
                            <h6 class='mb-4'>Ksh $room_data[price] per night</h6>
                            <a href='room_details.php?id=$room_data[id]' class='btn btn-sm w-100 btn-outline-dark shadow-none'>More Details</a>
                        </div>
                    </div>
                </div>
            ";

            $count_rooms++;
        }
        
        if($count_rooms>0){
            echo $output;
        }
        else{
            echo"<h3 class='text-center text-danger'>No rooms to show!</h3>";
        }
    }

?>