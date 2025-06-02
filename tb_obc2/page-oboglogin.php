<?php
/**
 * Template Name: OBOGログイン
 * Description: This is the obog login template
 */
?>
<?php 
session_start();
if(!isset($_SESSION['obog_loggedIn'])){    
    get_header('oboglogin'); 
    /* dummy */
    get_footer('oboglogin');
} else {
     wp_redirect( home_url('/') );
     exit(); 
}
?>