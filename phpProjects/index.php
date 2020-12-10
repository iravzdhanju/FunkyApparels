    <?php
         define("products", "img/");
         define("product1", products."product1.jpg");
         define("product2", products."product2.jpg");
         define("product3", products."product3.jpg");
         define("product4", products."product4.jpg");
         define("product5", products."product5.jpg");
        
         include 'functions/phpFunctions.php';
        pageHeader("HomePage");
       
        ?>
   <?php
        $Anarray = array (product1,product2,product3,product4,product5);
        displayProduct($Anarray);
        ?>
        <?php
        bodytext();
         pageFooter();
         ?>