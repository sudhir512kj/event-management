<?php
    function display_errors($errors) {
        $display='<ul class="big-danger">';
        foreach($errors as $error) {
            $display.='<center>
    
            <li class="text-danger">'.$error.'</li></center>';
        }
        $display.='</ul>';
        return $display;
    }

    function sanitize($dirty){
        return htmlentities($dirty,ENT_QUOTES,"UTF-8");
    }

    function login($username, $user_id){
        $_SESSION['SBUser']=$user_id;
        global $db;
        $message="<center>You are now logged in!</center>";
        $_SESSION['success_flash']=$message;
        $_SESSION['username'] = $username;
        $_SESSION['uid'] = $user_id;
        header('Location: event.php');
    }

    function is_logged_in(){
        if(isset($_SESSION['SBUser']) && $_SESSION['SBUser']>0){
            return true;
        }
        return false;
      }

      function pretty_date($date){
        return date("M d, Y",strtotime($date));
    }
?>