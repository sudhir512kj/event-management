<?php
    $db=mysqli_connect("localhost","root","","events");
    if(mysqli_connect_errno()) {
        echo "Database connection failed with following errors : ". mysqli_connect_error();
        die();
    }

    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/Event-Management-sudhir/config.php';
    require_once BASEURL.'helpers/helpers.php';

// 	$cart_id='';
// if(isset($_COOKIE[CART_COOKIE])){
//     $cart_id=sanitize($_COOKIE[CART_COOKIE]);
// }

    if(isset($_SESSION['SBUser'])){
    $user_id=$_SESSION['SBUser'];
    $query=$db->query("select * from organisers where id = '$user_id'");
    $user_data=mysqli_fetch_assoc($query);
    $fn=$user_data['username'];
    $useremail=$user_data['email'];
    }



//     if(isset($_SESSION['success_flash'])){
//         echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
//         unset($_SESSION['success_flash']);
//     }

//     if(isset($_SESSION['error_flash'])){
//         echo '<div class="bg-danger"><p class="text-danger text-center">'.$_SESSION['error_flash'].'</p></div>';
//         unset($_SESSION['error_flash']);
//     }
?>