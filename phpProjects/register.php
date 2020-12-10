<?php
include 'functions/phpFunctions.php';
$_GET["mode"] = "register";
pageHeader("register");
?>
   <?php
    signup();
    pageFooter();
    ?>