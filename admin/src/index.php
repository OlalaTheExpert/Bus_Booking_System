<?php  
 session_start();  
 if(isset($_SESSION["user"]))  
 {  
      header("location:dashboard.php");  
 }  
 
 ?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>WESTERN TRAINS ADMIN</title>
  <link href="styles/font-awesome.css" rel="stylesheet">
  
     
      <link rel="stylesheet" href="src/style.css">

  
</head>

<body>
<!-- Time for multiple clouds to dance around -->
  <!-- <div id="clouds">
	<div class="cloud x1"></div>
	
	<div class="cloud x2"></div>
	<div class="cloud x3"></div>
	<div class="cloud x4"></div>
	<div class="cloud x5"></div>
</div> -->

 <div class="container">


      <div id="login">

        <form method="post">

            <p><span class="fa fa-user"></span><input type="text"  name="user" value="Username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" required></p> 
            <p><span class="fontawesome-lock"></span><input type="password" name="pass"  value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
            <p><input type="submit" name="sub"  value="Login"></p>
                     

        </form>

       

      </div> <!-- end login -->

    </div>
   
  
  
</body>
</html>

<?php
   include('db.php');
  
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($con,$_POST['user']);
      $mypassword = mysqli_real_escape_string($con,$_POST['pass']); 
      
      $sql = "SELECT id FROM login WHERE username = '$myusername' and pass = '$mypassword'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         
         $_SESSION['user'] = $myusername;
         
         header("location: dashboard.php");
      }else {
         echo '<script>alert("Your Login Name or Password is invalid") </script>' ;
      }
   }
?>
