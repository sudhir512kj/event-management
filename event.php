<html>
    <head>
      <?php
          $json = file_get_contents('web-data/classroom.json');
          $data = json_decode($json,true);
          $examss=$data['exams'];
      ?>

      <?php
        require 'core/init.php';
        $event_id =0;

        if(isset($_POST['submit'])){
          $name=$_POST['name'];
          $agenda=$_POST['agenda'];
          $presenter=$_POST['presenter'];
          $date=$_POST['date'];
          $time=$_POST['time'];
          $location=$_POST['location'];
          $type=$_POST['type'];
          $description=$_POST['description'];
          $linkedin=$_POST['linkedin'];
          $contact=$_POST['contact'];

          $query = "INSERT INTO `events` (name,agenda, presenter, date,time,location,type,description,linkedin,contact ) VALUES ('$name','$agenda', '$presenter', '$date','$time','$location','$type','$description','$linkedin','$contact')";
          $result = mysqli_query($db,$query);
          if($result){
            $msg = "<p text-color='black'>Event created successfully.</p>";
            print($msg);
          }
        }

      ?>

        <!-- mobile meta -->
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <title>classroom | DailyPrep |for classrooms</title>
        <!--lib css-->
        <link href='bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
        <!--custom css-->
        <link href='css/event.css' rel='stylesheet' type='text/css'>
        <link href='css/home.css' rel='stylesheet' type='text/css'>

        <!-- Daily Prep Icon -->
        <link rel="icon" type="image/x-icon" href="imgs/logo.png">

<style media="screen">

body{
  font-family: 'Roboto', sans-serif;
  overflow-x: hidden;
}
.btn-default:hover {
  color: grey;
}
.btn[disabled]{
  background: grey;
}

.btn[disabled]:hover{
  background: grey;
  color: white;
}
a {
    color: #999;
    text-decoration: none;
}
img{
  box-shadow: none;
}
.invite_students_btn:hover {
    background-color: #0dc9c9;
    color: white;
}
</style>



    </head>
    <body>
      <nav class="navbar navbar-default" style="padding:0px 88px 0px;width:1550px;top: -14px;left: 16px;">
        <div class="container-fluid containerfluid">
            <ul class="nav navbar-nav">
              <li><a href="index.php"><img src="imgs/logo.png" class="navbar-brand-image img-responsive" style="box-shadow:none"></a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li>"><a href="#" class=" hidden-xs" style="color:white;margin-top: -30px;" data-toggle="tooltip" title="Log out!" data-placement="bottom"><img src="imgs/boy.svg" class="img-circle"  width="40px" height="40px"alt="">&nbsp;<span style="color:rgb(238, 131, 58)"><?=$_SESSION['username'];?>&nbsp;</span> <span id="logout"></span></a></li>
              <li><a type="button" onhover="color:white;" href="logout.php">Logout</a></li>
            </ul>
        </div>
      </nav>

      <div class="jumbotron">
     <button type="button" class="btn btn-default invite_students_btn hidden-xs col-md-offset-8" data-toggle="modal" data-target="#Modal1" name="button">Create New Event</button>
  </div>

      <!--content start-->

        <div class="col-md-12 content clonecontainer" style="margin-left:-36px;">
          <!-- card start-->
          <?php
            $sql="select * from events";
            $events=$db->query($sql);
          ?>
          <?php while($event=mysqli_fetch_assoc($events)): ?>
          <div class="card_parent">
          <a href="Presenter.php">
          <div class="card">
              <span class="class_name"></span>
              <div class="card_body" >
              <p class="text-center"><?=$event['name'];?></p>
              <div class="img_section">
                <img src="imgs/boy.svg" class="img-circle" style="box-shadow:none;" width="120px" height="120px" alt=""><p style="margin-right:80px;"><?=$event['presenter'];?></p>
              </div>

              <a href="Presenter.php">  <button type="button"   class="card_footer btn btn-default" style="background-color:#fdfdfd;border:none;font-size:16px;margin-top:3px;" name="button"><span class="no_of_students"><?=pretty_date($event['date']);?></span>&nbsp;&nbsp;<?=$event['time'];?></button></a>
                <br>
              <a href="Presenter.php">  <button type="button" class="card_footer btn btn-default" style="background-color:#fdfdfd;border:none;font-size:12px;margin-top:-6px;" name="button"><span class="no_of_students"><?=$event['location'];?></button></a>


              </div>
              <!-- </a> -->
          </div>
          </a>
          </div>
          <?php endwhile;  ?>

            <!-- card end -->


          <div class="card_body s add_classroom" data-toggle="modal" data-target="#Modal1" style="text-align:center;">
        <p style="font-weight:400;color:grey;letter-spacing: 0.4;">Create New Event  <br> </p>
        <p type="button" class="btn btn-default btn-circle btn-lg"><i class="glyphicon glyphicon-plus" style="top: 4px;left: 0px;"></i></p>

          </div>
        </div>


        <!--Content end-->

<!-- Modal 1 -->
      <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>

		</div>
		<div class="modal-body modalbody" style="padding: 0px 122px;">
      <h3 style="text-align:center;">Create a new Event</h3>
      <br>
      <br>
            <!-- content goes here -->
            <form action="" method="post">
              <div class="form-group">
                <label for="class_name"><b>Name</b></label>
                <input type="text" class="form-control required" autocomplete="off" placeholder="Example: Robotics Workshop " id="field" name="name">
              </div>
              <div class="form-group">
                <label for="class_name"><b>Agenda</b></label>
                <input type="text" class="form-control required" autocomplete="off" placeholder="Example: Workshop for robots development " id="field" name="agenda">
              </div>

              <div class="form-group">
                <label for="class_name"><b>Description</b></label>
                <input type="text" class="form-control required" autocomplete="off" placeholder="Example: Workshop of robots development" id="field" name="description">
              </div>

              <div class="form-group">
                <label for="class_name"><b>Presenter</b></label>
                <input type="text" class="form-control required" autocomplete="off" placeholder="Example: Shubham " id="field" name="presenter">
              </div>

              <div class="form-group">
                <label for="class_name"><b>Presenter Linkedin</b></label>
                <input type="text" class="form-control required" autocomplete="off" placeholder="Example: Shubham " id="field" name="linkedin">
              </div>

              <div class="form-group">
                <label for="class_name"><b>Presenter Contact</b></label>
                <input type="number" class="form-control required" autocomplete="off" maxlength="10" placeholder="Example: 9117777878 " id="field" name="contact">
              </div>



              <div class="form-group">
                <label for="class_name"><b>Date</b></label>
                <input type="date" class="form-control required" autocomplete="off" placeholder="Example: 1/12/18 " id="field" name="date">
              </div>

              <div class="form-group">
                <label for="class_name"><b>Time</b></label>
                <input type="time" class="form-control required" autocomplete="off" placeholder="Example: 11:00 AM " id="field" name="time">
              </div>

              <div class="form-group">
                <label for="class_name"><b>Location</b></label>
                <input type="text" class="form-control required" autocomplete="off" placeholder="Example: Thanesar " id="field" name="location">
              </div>

              <div class="form-group">
                <label for="programs"><b>Type</b></label>
                <select id="selected" class="form-control required " placeholder="Select one from the list" name="type">
                  <option value="Social" >Social</option>
                  <option value="Education" >Education</option>
                  <option value="Corporate" >Corporate</option>
                </select>
              </div>

		</div>

    <div class="modal-footer">

   <p><button type="button submit_buttons submit" class="btn btn-default submit_buttons" style="text-align:center" data-disiss="modal" class="close" name="submit">Create Event</button>
   <button type="button" class="close" data-dismiss="modal" style="
    position:  absolute;
    margin: 0px 15px;
    background-color: #dc11119c;
    padding: 10.5px 16px;
    color: #ffffff;
    opacity: 1;
    border-radius: 2px;
    letter-spacing: 1.0;
">Exit</button></p>
   <div class="alert alert-danger" id="error" style="display:none;margin-top: 15px;"></div>
   <div class="alert alert-success" id="welcome" style="display:none;margin-top: 15px;margin-bottom: -32px;"></div>


    </div>

	</div>
  </form>
  </div>
</div>

<div style="height:357px;"></div>
<h3 style="
    text-align:center;
    margin-bottom:35px;
    padding: 20px 20px;
    margin: 40px 490px;
    color: black;
    box-shadow: 10px 4px 91px 5px #00000087;
    ">Sortable Upcoming Events</h3>

<div class="col-12 col-sm-12 col-lg-12">
 <div class="table-responsive">

<table class="table table-striped table-hover " id="myTable">
  <thead>
    <tr >
      <th id="menu-toggle1" onclick="sortTable(0)" style="padding-bottom: 19px;">Event Names </span> </th>
      <th id="menu-toggle2" onclick="sortTable(1)" style="padding-bottom: 19px;">Event Types </span></th>
      <th id="menu-toggle3" onclick="sortTable(2)" style="padding-left:18px;padding-bottom: 19px;">How Far Date is </th>
    </tr>
  </thead>
  <tbody>
  <?php
            $sql="select * from events";
            $events=$db->query($sql);
          ?>
    <?php while($event=mysqli_fetch_assoc($events)): ?>
    <tr>
      <td><?=$event['name'];?></td>
      <td><?=$event['type'];?></td>
      <td><button type="button" name="button" class="btn btn-success "><?=pretty_date($event['date']);?></button></td>
    </tr>
    <?php endwhile;  ?>
  </tbody>
</table>
</div>
</div>

<!--Table end-->

</body>

    <script type="text/javascript" src="bootstrap/js/jquery-2.0.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/event.js"></script>
    <script type="text/javascript" src="js/event1.js"></script>


</html>

