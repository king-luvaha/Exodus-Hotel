<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - ROOMS</title>
</head>
<body>
    
    <?php
        require('inc/header.php');
    ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold text-center p-font">OUR ROOMS</h2>
        <div class="h-line bg-dark"></div>
        
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 px-4" id="rooms-data"></div>
        </div>
    </div>

    <script>

        let rooms_data = document.getElementById('rooms-data');

        function fetch_rooms()
        {
            let xhr = new XMLHttpRequest();
            xhr.open("GET","ajax/rooms.php?fetch_rooms",true);

            xhr.onload = function() {
                rooms_data.innerHTML = this.responseText;
            }

            xhr.send();
        }


        window.onload = function(){
            fetch_rooms();
        }

    </script>

    <!-- Footer -->

    <?php require('inc/footer.php'); ?>

</body>
</html>