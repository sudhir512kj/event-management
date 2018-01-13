<html>
    <head>
      <?php
          $json = file_get_contents('web-data/home.json');
          $data = json_decode($json,true);
          $title=$data['title'];
          $heading=$data['heading'];
          $button_heading=$data['button_heading'];

      ?>

      <?php
        require 'core/init.php';
        $error="";
        $w=$y=0;
        if(isset($_POST['submit'])){
          $name = $_POST['name'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $hashed = password_hash($password, PASSWORD_DEFAULT);
          $mobile = $_POST['mobile'];

          $query2 = "SELECT * FROM `organisers` WHERE email='$email'";
          $result2 = mysqli_query($db,$query2) or die(mysqli_error());
          $count2 = mysqli_num_rows($result2);

          if ($count2 >= 1){
              $w=1;
          }

          if($w==1)
          {
              $error="User with the same email is already registered.";
          }

          $query1 = "SELECT * FROM `organisers` WHERE mobile='$mobile'";
          $result1 = mysqli_query($db,$query1) or die(mysqli_error());
          $count1 = mysqli_num_rows($result1);

          if ($count1 >= 1){
              $y=1;
          }

          if($y==1)
          {
              $error="User with the same mobile number is already registered.";
          }

          $result="";

          if($w==0 && $y==0){
            $query = "INSERT INTO `organisers` (username, password, email,mobile) VALUES ('$name', '$hashed', '$email','$mobile')";
            $result = mysqli_query($db,$query);
          }
          if($result){
            $msg = "<p text-color='black'>User Created Successfully.</p>";
            print($msg);
          }
          else {
            print($error);
          }
        }
      ?>

      <?php
        if(isset($_POST['login'])){
          $email=((isset($_POST['email']))?sanitize($_POST['email']):'');
          $email=filter_var($email,FILTER_SANITIZE_EMAIL);
          $email=trim($email);
          $password=((isset($_POST['password']))?sanitize($_POST['password']):'');
          $hashed=password_hash($password,PASSWORD_DEFAULT);
          $errors=array();

          $query=$db->query("select * from organisers where email = '$email'");
                    $user=mysqli_fetch_assoc($query);
                    $username = $user['username'];
                    $userCount=mysqli_num_rows($query);
                    if($userCount<1){
                        $errors[]='That email doesn\'t exits in our databse';
                    }

                    if(!password_verify($password,$user['password'])){
                        $errors[]='The password does not match our records.Please try again.';
                    }

                    //check for errors
                    if(!empty($errors)){
                        echo display_errors($errors);
                    }else{
                        //log user in
                        $user_id=$user['id'];
                        login($username, $user_id);
                    }
        }
      ?>

      <?php

      if (is_logged_in()){
        
      }

      ?>

        <!-- mobile meta -->
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <title><?=$title?> | EventPlanner |for joyful Events!</title>
        <!--lib css-->
        <link href='bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">

        <!--custom css-->
        <link href='css/home.css' rel='stylesheet' type='text/css'>

        <!-- Icon -->
        <link rel="icon" type="image/x-icon" href="imgs/logo.png">
    </head>




<style media="screen">

*:focus {
    outline: 0;
}

a{
    color: inherit;
}

a:focus, a:hover {
    text-decoration:none;
}

body{
    font-family: 'Roboto', sans-serif;
}

  .form-control{
    height: 59px;
    border-radius: 0px;
  }
  .btn-success {
    color: #fff;
    font-size: 20px;
    background-color: #2c8585;
    border-color: #2c8585;
  }
  .btn-success:hover{
    color: #fff;
    font-size: 20px;
    background-color: #2c8585;
    border-color: #2c8585;
  }
  .nav-tabs>li>a{
    font-size: 20px;
  }

  .nav-tabs {
    margin-left: 105px;
    border-bottom: none;
}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    border: 0px solid #ddd;
    border-bottom: 3px solid rgb(44, 133, 133);

}
.nav-tabs>li>a:hover {
    background: transparent;
}

.nav-tabs>li>a{
  border: 0px;
}

.alert-danger{
  text-align: center;
}

.nav-tabs{
  margin-left: 130px;
}




@media (min-width: 768px){
.modal-dialog {
    width: 430px;
    margin: 30px auto;
  }
}

</style>



  <body>
    <div class="background-color">
      <img src="imgs/back.jpg"  class="jumbotron-image hidden-xs img-responsive" alt="" height="600px"></img>

      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a href="index.php"><img src="imgs/logo.png" class="navbar-brand-image img-responsive" style="box-shadow:none"></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <a href="#tab-wrong-vehicle"  data-toggle="modal" onMouseOver="this.style.color='white'" onMouseOut="this.style.color='white'"data-target="#buyers-report-modal" >Log in</a>
            <a href="#tab-mileage" class="signup1" style="background-color:#f2853b;" onMouseOver="this.style.color='white'" onMouseOut="this.style.color='white'"data-toggle="modal" data-target="#buyers-report-modal" style="padding-left: 250px;">Sign up</a>
          </ul>
      </div>
    </nav>

    <p class="jumbotron-heading col-xs-12 text-center">We  Understand  Our  Customers  and  Their Events !!</p>
    <center><p class="jumbotron-subheading text-center"><a href="#tab-mileage"  style="background-color:#f2853b; color:white; " class="signup1" data-toggle="modal" data-target="#buyers-report-modal">Create your Event!</a></p></center>
  </div>

  <button type="button" class="btn btn-primary active button" style="
    position: absolute;
    top: 1019px;
    left: 685px;
    color: black;
    margin: 0px auto;
    font-size: 25px;
    font-weight: 300;
    padding: 14px 20px;
    border: none;
    background: #f2853b;
    border-radius: 23px;
">Our Features</button>

  <div class="container-fluid" style="margin-right: 35px; margin-left: 35px; margin-bottom: 65px;margin-top:100px;">
    <div class="row"><!--1st row start-->
      <div class="col-sm-4 col-md-6"><img src="imgs/pre.jpg" alt="" width="100%" class="img-responsive" ></div>

      <div class="col-sm-4 col-md-6 content1">
        <p class="heading">Event Management</p>
        <p class="subheading"> A complete toolkit for events of any size, our online event management solutions take care of your whole event from planning and registration to post-event analysis and reporting.</p>
      </div>
    </div><!-- first row end-->

    <div class="row"><!--2nd row start-->
      <div class="col-sm-4 col-md-6  content1">
        <p class="heading">  Eventsforce Abstracts</p>
        <p class="subheading">  ntegrate with Eventsforce Event Management for a complete solution that brings together abstracts, registrations and sessions in one convenient, accessible place:.</p>
      </div>

      <div class="col-sm-4 col-md-6">
        <img src="imgs/pre2.jpg" alt="" width="100%" class="img-responsive" >
      </div>
    </div><!-- 2nd row end-->

    <div class="row"><!--1st row start-->
      <div class="col-sm-4 col-md-6"><img src="imgs/pre.jpg" alt="" width="100%" class="img-responsive" ></div>

      <div class="col-sm-4 col-md-6 content1">
        <p class="heading">Eventsforce Awards </p>
        <p class="subheading"> A complete toolkit for events of any size, our online event management solutions take care of your whole event from planning and registration to post-event analysis and reporting.</p>
      </div>
    </div><!-- first row end-->

    <button type="button" class="btn btn-primary active button" style="
    position: absolute;
    top: 2736px;
    left: 685px;
    color: black;
    margin: 0px auto;
    font-size: 25px;
    font-weight: 300;
    padding: 14px 20px;
    border: none;
    background: #f2853b;
    border-radius: 23px;
">Events</button>

<?php
            $sql="select * from events";
            $events=$db->query($sql);
          ?>
          

    <div class="container">
  <table class="table" border="1" style="margin-top:170px;">
    <thead>
      <tr>
        <th>Event Name</th>
        <th>Event Location</th>
        <th>Event Date &amp; Time</th>
      </tr>
    </thead>
    <tbody>
    <?php while($event=mysqli_fetch_assoc($events)): ?>
      <tr class="success">
        <td><?=$event['name'];?></td>
        <td><?=$event['location'];?></td>
        <td><?=pretty_date($event['date']);?>&nbsp;<?=$event['time'];?></td>
      </tr>   
      <?php endwhile;  ?>   
    </tbody>
  </table>
</div>

    


  </div><!--container end-->

<!-- login signup modal start -->
<div class="modal fade" id="buyers-report-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-offset-top">
        <div class="modal-content" style="border-radius: 0px;border-top: 8px solid #f2853b;border-bottom: 8px solid #f2853b;">
            <div class="modal-body" style="margin-top: -72px;">
                <div class="sd-tabs sd-tab-interaction">
                    <div class="row">
                       <img src="images/dailypreplogo1.svg" alt="" style="box-shadow:none;position: relative;left: 127px;">
                       <button type="button" class="close" data-dismiss="modal" style="position:relative; left:-18px;" onclick="reset();">&times;</button>
                        <hr>
                        <ul class="nav nav-tabs custom-bullet">
                            <li class="active"><a data-toggle="tab" href="#tab-wrong-vehicle" style="border-bottom-color:#f2853b;"> Log in</a></li>
                            <li><a data-toggle="tab" href="#tab-mileage" style="border-bottom-color: #f2853b;"> Sign up</a></li>
                        </ul>

                        <div class="tab-content col-md-12">
                            <div id="tab-wrong-vehicle" class="tab-pane  active">
                                <!-- log in start -->
                                <form action="" method="post">
                                <div class="form-group">
                                  <input type="email" class="form-control reset" id="email" placeholder="Email" name="email">
                                  </div>
                                  <div class="form-group">
                                    <input type="password" class="form-control" id="pswd" placeholder="Password" name="password">
                                  </div>
                                  <div id="loading" style="padding:10px;"></div>
                                  <button type="submit" class="btn btn-success form-control" id="login_btn"
                                   style="
                                   background-color: #f2853b;
                                   border: 1px;" name="login" onclick="">Log in</button>
                                  <p style="text-align:center;color:#2c8585;margin-top:11px;" id="welcomeuser" >Forgot your Password?</p>
                                  <div class="alert alert-danger" id="error_msg" style="display:none;"><?= $error; ?></div>
                                  <div class="alert alert-success" id="welcomeuser" style="display:none;"></div>
                                </form>
                            </div>
                            <!-- Log in end -->

                            <!-- Sign Up-->

                            <div id="tab-mileage" class="tab-pane">
                            <form action="" method="post">
                              <div class="form-group">
                                <input type="name" class="form-control" id="name" placeholder="Name" name="name">
                              </div>
                              <div class="form-group">
                                  <input type="email" class="form-control" id="email1" placeholder="Email" name="email">
                              </div>
                              <div class="form-group">
                                  <input type="password" class="form-control" id="pswd1" placeholder="Password" name="password">
                              </div>
                              <div class="form-group">
                                  <input type="text" class="form-control" id="mobile" placeholder="Mobile No." name="mobile">
                              </div>

                              <div id="loading1" style="padding:10px;"></div>
                                  <button type="btn submit" id="signup_btn" class="btn btn-success form-control" name="submit" style="background-color: #f2853b;border: 1px;">Sign up</button>
                              <br>
                              <div class="alert alert-danger" id="error_msg1" style="display:none;margin-top: 15px;"></div>
                              <div class="alert alert-success" id="welcomeuser1" style="padding: 0px 0px;margin: 14px 2px;border:none;display:none;margin-top: 15px;"></div>
                            </form>
                            </div>
                            <!-- sign Up end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  </body>
    <script type="text/javascript" src="bootstrap/js/jquery-2.0.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/home.js"></script>
  </html>
