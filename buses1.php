<?php 
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Bus Booking System</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
</head>
<body>


<!-- /Switcher -->

<!--Header-->
<?php 
include('includes/header.php');?>
<!--Page Header-->
<!-- /Header -->

<!--Page Header-->

<!-- /Page Header-->



<section class="user_profile inner_pages">
  
    <div class="row">
      <div class="col-md-2 col-sm-2">
       <?php include('includes/sidebar.php');?>

      <div class="col-md-6 col-sm-5">
        <!-- <div class="profile_wrap">
          <h5 class="uppercase underline">Available Buses for my route </h5>
          <div class="my_vehicles_list">
            <ul class="vehicle_listing"> -->

		<?php
						include ('db1.php');

            if(isset($_POST["submit"])){
              $departure = $_REQUEST['route'];
              $destination = $_REQUEST['route_two'];
              $date = $_REQUEST['date'];
            }
						 $sql = "SELECT * FROM routes WHERE departure = '$departure' AND destination = '$destination' AND  date = '$date'" ;
						$re = mysqli_query($con,$sql);

            $num_of_rows = mysqli_num_rows($re);

						$c =0;
            $rem =0; 
            if ($num_of_rows <= 0){
              echo '<h3 class="text-center pt-5">No Available Bus on that Date <br>
              <small><a href="routes.php" style="text-align:center">Reschedule your journey</a><small></h3>';
            	  $sql = "SELECT * FROM routes" ;
						$re = mysqli_query($con,$sql);
            $num_of_rows = mysqli_num_rows($re);

						$c =0;
            $rem =0;         
              while($row=mysqli_fetch_array($re) )
						   
            {
							// $c = $c + 1;

              $train_id = $row['train_id'];
              
              $departure = $row['departure'];
              $destination = $row['destination'];
              $fare = $row['price'];
              $date = $row['date'];
              $time = $row['time'];
              
             $query = mysqli_query($con, "SELECT * FROM trains WHERE id = '$train_id'");

            while($row_two = mysqli_fetch_array($query)){
              $name = $row_two['name'];
              $total_seats = $row_two['seats'];
              $booked_seats = $row_two['booked_seats'];

              $ava=0;
              $ava= $total_seats - $booked_seats

            
            ?>
<section class="inner-page">
      <div class="container">
     
					<table class="table">
            <thead>
              <tr>
               
                 <!-- <th scope="col">Bus</th> -->
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>               
               
                <th scope="col">Book Online</th>
              </tr>
            </thead>
            <tbody>
          
            <?php
            if($id % 2 ==1 )
											{
												echo"<tr class='gradeC'>
                        <td>".$row['departure']."</td>
                        <td>".$row['destination']."</td>
                        <td>".$row['date']."</td>
                        <td>".$row['time']."</td>
                        
                        <td><a href='booking1.php?eid=". $train_id . " <button class='get-started-btn scrollto' style='margin-left: 0rem;'> <i class='fa fa-edit' ></i> Book Now</button></td>
            </tr>";
                }
											else
											{
                        echo"<tr class='gradeU'>
                         <td>".$row['departure']."</td>
                          
                        <td>".$row['destination']."</td>
                        <td>".$row['date']."</td>
                        <td>".$row['time']."</td>
                       
                        <td><a href='booking1.php?eid=". $train_id . " <button class='get-started-btn scrollto' style='margin-left: 0rem;'> <i class='fa fa-edit' ></i> Book Now</button></td>
            </tr>
                        ";
                      
                      ?>
 
             <?php
             }
             ?>
            </tbody>
          </table>

</div>        </section>

<?php }
            }
            
?>
            <?php
            
            }else{             
            
						while($row=mysqli_fetch_array($re) )
						              
            {
							// $c = $c + 1;

              $train_id = $row['train_id'];
              
              $departure = $row['departure'];
              $destination = $row['destination'];
              $fare = $row['price'];
              $date = $row['date'];
              $time = $row['time'];
              
            $query = mysqli_query($con, "SELECT * FROM trains WHERE id = '$train_id'");

            while($row_two = mysqli_fetch_array($query)){
              $name = $row_two['name'];
              $total_seats = $row_two['seats'];
              $booked_seats = $row_two['booked_seats'];

              $ava=0;
              $ava= $total_seats - $booked_seats; 
            if($ava == 0){
              echo '<h3 class="text-center pt-5">Sorry, The Bus is full please choose another Bus </h3>';
                }
                else{
           
				?>
         <?php 

      
   ?>
   

    <section class="inner-page">
      <div class="container">
     <div class="pd-10 card-box mb-30">
					<div class="clearfix mb-20">
						<div class="pull-left">
							<h4 class="text-blue h4">Available bus</h4>
							</div>

					</div>
					<table class="table">
            <thead>
              <tr>
               
                 <!-- <th scope="col">Bus</th> -->
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
               
                <th scope="col">Total Seats</th>
                <th scope="col">Ava. Seats</th>
                <th scope="col">Book Online</th>
              </tr>
            </thead>
            <tbody>
            <tr>
            
            <td> <?php echo $departure; ?> </td>
            <td> <?php echo $destination; ?> </td>
            <td> <?php echo $date; ?> </td>
            <td> <?php echo $time; ?> </td>
           
            <td> <?php echo $total_seats; ?> </td>
            <td> <?php echo $tava; ?> </td>
            <td><a href="booking1.php?eid=<?php echo $train_id; ?>"> <button class='get-started-btn scrollto' style='margin-left: 0rem;'> <i class='fa fa-edit' ></i> Book Now</button></td>
            </tr>
            

             
            </tbody>
          </table>

</div>
</div>        </section>
        <?php
            }
         
          }
        }
      }
    

          ?>

</section>
<!--/my-vehicles-->
<?php include('includes/footer.php');?>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/interface.js"></script>
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS-->
<script src="assets/js/bootstrap-slider.min.js"></script>
<!--Slider-JS-->
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
