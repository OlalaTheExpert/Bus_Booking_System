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

<link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
<script src="semantic/jquery.min.js"> </script>
<script src="semantic/semantic.min.js"></script>
<link href="semantic/datepicker.css" rel="stylesheet" type="text/css">
<script src="semantic/datepicker.js"></script>
<script src="nav.js"></script>
<script>
var travelclassObject = {
  "High Class Travel": {
   
    "2100": ["Ability to work", "Over-the-top amenities", "You have your own washroom"]
   

  },
  "Middle Class Travel": {
    "1800": ["You have extra luggage space", "Travel without Stress", "Get free drink"]
    
  },
   "Common Class Travel": {
    "1500": ["Comfortable Seats", "Normal luggage space"]
    
  
    
  }
}
window.onload = function() {
  var travelclassSel = document.getElementById("travelclass");
  var amountSel = document.getElementById("amount");
  var chapterSel = document.getElementById("chapter");
  for (var x in travelclassObject) {
    travelclassSel.options[travelclassSel.options.length] = new Option(x, x);
  }
  travelclassSel.onchange = function() {
    //empty Chapters- and amounts- dropdowns
    chapterSel.length = 1;
    amountSel.length = 1;
    //display correct values
    for (var y in travelclassObject[this.value]) {
      amountSel.options[amountSel.options.length] = new Option(y, y);
    }
  }
  amountSel.onchange = function() {
    //empty Chapters dropdown
    chapterSel.length = 1;
    //display correct values
    var z = travelclassObject[travelclassSel.value][this.value];
    for (var i = 0; i < z.length; i++) {
      chapterSel.options[chapterSel.options.length] = new Option(z[i], z[i]);
    }
  }
}
</script>
<style>

a{
cursor:pointer;	
}
</style>
</head>
<?php
function generate_order(){
	
//These are just Random Letters forming a transaction ID
$order_ref="";
$char=array('O','T','R','S','A','C','B','E');
$num=rand(11,99);
$num2=rand(12,89);
$num3=rand(13,92);
shuffle($char);
//now the final
$order_ref=$char[0].$char[3].$num.$char[1].$num2.$char[2].$num3.$char[4];
//assignming to user
$_SESSION['ORDERREF']=$order_ref;

	
}
generate_order();
?>
<?php
include('db1.php');
$id = $_REQUEST['eid'];
$query = mysqli_query($con, "SELECT * FROM routes WHERE train_id = '$id' ");
while ($row = mysqli_fetch_array($query)) {
  $departure = $row['departure'];
  $destination = $row['destination'];
  $date = $row['date'];
  $ttime = $row['time'];
  $bus = $row['train_name'];

?>
 <?php
                  $result = mysqli_query($con, "SELECT * FROM trains WHERE id='$id'");
                  while ($row = mysqli_fetch_array($result)) {
                    $total_seats = $row['seats'];
                    $booked_seats = $row['booked_seats'];
                    $viti = $row['viti'];
                    $bus =$row['name'];
                    
                    $seats_arr = preg_split("/\,/", $viti);

                    $range = range(1,$total_seats);

                    $newunselected = array_diff($range,$seats_arr); //Your new array you can foreach this

                  
                  ?>
<body>
   <?php include('includes/header.php');?>
<section class="user_profile inner_pages" style="margin-top:-8rem;">
<div class="ui fluid container center aligned" style="cursor:pointer;margin-top:40px">
<div class="ui unstackable tiny steps">
  <div class="step" onclick="booking()">
    <i class="bus icon"></i>
    <div class="content">
      <div class="title">BOOKING DETAILS</div>
      <div class="description">TRAVELLING AND BOOKING INFORMATION</div>
    </div>
  </div>
  <div class="step disabled" onclick="contact()" id="contactbtn">
    <i class="truck icon"></i>
    <div class="content">
      <div class="title">DETAILS</div>
      <div class="description">CONTACT INFORMATION</div>
    </div>
  </div>
  <div class="disabled step" id="billingbtn" onclick="billing()">
    <i class="money icon"></i>
    <div class="content">
      <div class="title">BILLING</div>
      <div class="description">PAYMENT AND VERIFICATION</div>
    </div>
  </div>
   <div class="disabled step" onclick="confirmdetails()" id="confimationbtn">
    <i class="info icon"></i>
    <div class="content">
      <div class="title">CONFIRM DETAILS</div>
      <div class="description">VERIFY ORDER DETAILS</div>
    </div>
  </div> 
   <div class="disabled step" id="finishbtn">
    <i class="info icon"></i>
    <div class="content">
      <div class="title">FINISH AND PRINT</div>
      <div class="description">PRINTING TICKET</div>
    </div>
  </div>
</div>
</div>
<br>
<div id="dynamic">

<div class="ui container text" id="booking-page">
<div class="ui attached message">
  <div class="header">Booking Info</div>
    <div class="header">Order Ref: <span style="color:red;font-size:15px"><?php echo $_SESSION['ORDERREF']?> <a href='index.php'>Cancel Order</a></span> </div> 
  <p>Enter traveling booking info</p>
</div>

<form class="ui form attached fluid loading segment" method="POST" action="#" onsubmit="return contact(this)" >
 <div class="field">
    <label>Destination</label>
    <input type="text" id="destination" value="<?php echo $departure; ?> to <?php echo $destination; ?>" readonly>
  </div>  
  <div class="field">  
    <label>Traveling Class</label><span><a href="faqs.php">Learn more</a><i> about traveling classes</i></span>
 <div class="field">
    <select name="gender" required id="travelclass">
     
    <option value="" selected="selected" disabled>--Travel Class--</option>
  </select>
  </div>   
</div>

<div class="two fields"> 
<div class="field"> 
    <label>Number of Seats</label>
<input placeholder="Number of Seats" type="number" name="booked_seats" id="seats" min="1" max="72"  value="1" required>
  </div> 
<div class="field"> 
    <label>Date of Travel</label>
<input type="text" id="traveldate" class="form-control" value="<?php echo $date; ?> <?php echo $ttime; ?>" readonly/>
  </div>  
  </div>
  <div style="text-align:center">
 <div><label>Ensure all details have been filled correctly</label></div>
  <button class="ui green submit button" >Submit Details</button>
</div> 
 </form>
</div>
<?php

  include('db1.php');


  if (isset($_POST['submit'])) {

    
    // Check connection
    if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql2 = mysqli_query($con, "UPDATE trains SET booked_seats = (booked_seats + 1) WHERE id = $train_id");
    if (mysqli_query($con, $sql2)) {
      //echo "<script type='text/javascript'> alert('You've added Train successfully')</script>"; 
    }
  }
  mysqli_close($con);
  ?>


<div class="ui container text" id="contact-page" style="display:none">
<div class="ui attached message">
  <div class="header">Enter your Customer Details! </div>
   <div class="header">Order Ref: <span style="color:red;font-size:15px"><?php echo $_SESSION['ORDERREF']?> <a href='index.php'> Cancel Order</a></span> </div>
  <p>Fill the required Fields</p>
</div>
<form class="ui form attached fluid loading segment" onsubmit="return billing(this)">
    <div class="field">
      <label>Full Name (Paid By)</label>
      <input placeholder="Full name" type="text" id="fullname" required>
    </div>

  <div class="field">
    <label>Email address</label>
    <input placeholder="Email address" type="text" id="contact" required>
  </div>

 <div class="field">
    <label>Gender</label>
 <div class="field">
    <select name="gender" required id="gender">
      <option value="" selected disabled>--Choose Gender--</option>
      <option value="MALE">Male</option>
      <option value="FEMALE">Female</option>
    </select>
  </div>   
  </div>
 
 <div style="text-align:center">
 <div><label>Ensure all details have been filled correctly</label></div>
  <button class="ui green submit button">Submit Details</button>
</div>
  
  </form>
</div>

<div class="ui container text" id="billing-page" style="display:none">
<div class="ui attached message">
  <div class="header">Validate Payment Information</div>
    <div class="header">Order Ref: <span style="color:red;font-size:15px"><?php echo $_SESSION['ORDERREF']?> <a href='index.php'>Cancel Order</a></span> </div> 
  <p>Enter Payment Details to Proceed</p>
</div>
 

<form class="ui form attached fluid loading segment" onsubmit="return confirmdetails(this)">
<div class="field"> 
<label>Confirm Amount(ksh)</label>

 <select name="amount" id="amount">
    <option value="" selected="selected" disabled>---See the Cost---</option>
  </select>
  </div>
 <div class="field"> 
<label style="color:green; heaight:6rem; font-size:25px; font-weight:bold;">MPESA <span style="color:green; font-weight:bold; font-size: 20px;"><span>via</span>Till NO. 5970127</span></label>  
</div>

<div class="field"> 
<label>Transaction ID</label> 
<div class="ui icon input">
  <input placeholder="Transaction Code" type="text" required id="codebox">
  <i class="payment icon"></i>
</div>
</div>
<div class="field">
    <label>Type of Bus</label>
   
    <input value="<?php echo $bus; ?>" type="text" required id="paymentmethod" readonly>

   </div> 
  
   <select name="chapter" id="chapter" disabled>
    <option value="" selected="selected" disabled>You are almost done</option> 
  </select>
 <div style="text-align:center">
  <button class="ui green submit button">Proceed</button>
</div>
 </form>
<div class="ui bottom attached warning message"><i class="icon help"></i><b id="payment-info"></b></div> 
</div>


<div class="ui text container" id ="confirmdetails-page" style="display:none">
<div class="ui positive message">
<b>Before proceeding, re-check the following details you provied</b><br>
<i>Ticket might not be re-printed, hence details you provided should be valid</i>
<br>
<div class="ui horizontal divider">The Details Provided</div>
<div id="details"></div>
<div class="ui horizontal divider">Confirm Details</div>
<div class="ui fluid container center aligned">
<a class="ui button green" onclick="senddata()" >YES|Confirm</a>

           
</div>
</div>
</div>

</div>
         </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/my-vehicles-->
<?php include('includes/footer.php');?>
</body>
</html>
<?php
}
}
?>
