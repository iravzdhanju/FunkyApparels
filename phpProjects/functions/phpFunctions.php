<?php
// include_once"server.php";
header('Cache-Control: no cache'); //no cache
define("_CSS_FOLDER", "css/"); // css folder
define("_DEFAULT_STYLESHEET", _CSS_FOLDER . "style.css"); // css file
define("CSS_FILE", _CSS_FOLDER . "buy.css"); //buy page css file
define("CSS_REGISTER",_CSS_FOLDER ."register.css");//register page css file
define("CSS_PURCHASE", _CSS_FOLDER . "purchase.css"); //purchase page css file
define("image_folder", "img/"); //image folder
define("city_length", 8); //length of the city function
define("province_length", 25);//length of the province function
define("postal_code_length",7);//length of the postal code function
define("CSS_ACCOUNT", _CSS_FOLDER . "account.css"); //purchase page css file
define("name_length_MAX", 20); // length of the name function
define("username_length",12);//length of the username function
define("password_length",255);//length of the password function
define("comment_Length", 200); // length of the comment function
define("limit_price", 10000); //limit of the price
define("logo", image_folder . "R-1lo.png"); // logo folder
define("CSS_BUY", _CSS_FOLDER . "buypage.css");//css file buy page
define("Max_Quantity", 99); // length of the qunatity
define("CLASS_ERROR", "error"); // error string
define("MAX_QUANTITY", 99); // length of the quantity
define("min_price", 1); // min price function
define("keylength", 12); // length of the product key
define("File_eol", "\r\n"); //eol starter
define("key", "P"); // starting variable of the key
define("min_Quantity", 1); // quantity minimum
define("styleDownload", _CSS_FOLDER . "product.css"); //css for the text file
define("Data_Folder", "data/"); // data folder to store data
define("purchasefile", Data_Folder . "purchase.txt"); // purchased tezt file
define("Current_Tax",15);//tax rate
//+++++++++++++++++++++++++++++ MAIN PAGE +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$_GET["validate"] = 0;  //to make zero the variable
function pageHeader($title) // page header
{
?>
    <!DOCTYPE html>
    <?php header('Content-Type: text/html; Charset="UTF-8"');
    ?>
    <html>

    <head>
        <meta charset='UTF-8'>
        <script>
            // +++++++++++++++++++++++++++++++++++++++++++++++++ to refesh window on realoading the page+++++++++++++++++++++++++++  
            function reloadPage() {
                window.location.reload(true);
            }
            function redirectPage(){
                window.location.href = "../account.php";
            }
            function redirectPageSignUp(){
                window.location.href = "../register.php";
            }
            
        </script>


        <!-- title of the page / -->
        <title>$title</title>

        <!-- font  -->
        <link href="https://fonts.googleapis.com/css?family=Google+Sans:500,700" rel="stylesheet">

        <!----------------------------------- CSS ------------------------------- -->
        <link rel="stylesheet" type="text/css" href="<?php
                                                        $stylesheet = _DEFAULT_STYLESHEET;
                                                        //stylesheet according to the page selected
                                                        if (isset($_GET["mode"])) {
                                                            //stylesheet is applied according to the page selected
                                                            if ($_GET["mode"] == "account") {
                                                                $stylesheet = CSS_ACCOUNT;
                                                            }
                                                            if ($_GET["mode"] == "register") {
                                                                $stylesheet = CSS_REGISTER;
                                                            }
                                                            if ($_GET["mode"] == "buy") {
                                                                $stylesheet = CSS_BUY;
                                                            }
                                                            if ($_GET["mode"] == "form") {
                                                                $stylesheet = CSS_FILE;
                                                            } else {

                                                                if ($_GET["mode"] == "purchase") {
                                                                    $stylesheet = CSS_PURCHASE;
                                                                    if (isset($_GET["command"])) {
                                                                        //command changes the body background to white when applied the print command
                                                                        if ($_GET["command"] == "print") {
                                                                            $stylesheet = styleDownload;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        echo $stylesheet; ?>">
    </head>

    <body>

        <!-- ----------------------------------navigation bar ----------------------------------------      -->
        <nav>
            <ul>
                <li class="nav-bar"><a href="index.php">Home</a></li>
                <li class="nav-bar"><a href="Form.php">Forms</a></li>
                <li class="nav-bar"><a href="purchase.php">Purchase Products</a></li>
                <li class="nav-bar"><a href="buy.php">Buy Products</a></li>
                <li class="nav-bar"><a href="register.php">Register</a></li>
                <li class="nav-bar"><a href="account.php">Login</a></li>
                <li class="img2"><img class="logos" src="<?Php echo logo; ?>"></li>

            </ul>


        </nav>
        <!-- ---------------------------------- </ navigation bar ----------------------------------------      -->





        <!-- ----------------------------------Display the products in a array ---------------------------->
    <?php
}



function displayProduct($Anarray)

{     // use to shuffle the photos

    //first index to Be the biggest sized photo
    echo '<h1>Best Seller</h1>';
    echo '<a href="https://desibloc.com/">';
    echo '<li class="bigger"><img id="biggest"  src="' . $Anarray[0] . '" alt="Biggest images"></i></li><br>';
    echo '</a>';
    echo '<h1>Other Products</h1>';

    //loop that started from index 1 and doesnt stats from index 0 because its already had been picked

    for ($i = 1; $i < count($Anarray); $i++) {
        echo '<a href="https://desibloc.com/">';


        echo '
                            
                            <li class="pics">
                            <i><img id ="random" src="' . $Anarray[$i] . '" alt="smallerImages "></i>
                            </li>';
        echo '</a>';
    }
}
// ++++++++++++++++++++++++++++++++++++++++++++ DISPLAY FOOTER +++++++++++++++++++++++++++++++++++++++++++++ 
function pageFooter()
{
    //Getting Date of server
    $date = new DateTime("now");
    //to select the year

    echo "<div class='footer'>"; //footer
    echo "<p>";
    echo "Copyright  Ravinderpal Singh(1912283) " . $date->format("Y");
    echo "</p>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
}
function bodytext()
{
    echo "
   <div class='text'>
   
   </div>


       ";
}

//+++++++++++++++++++++++++++++ FORMS PAGE +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


##FORMS PAGE
//display error message when input is wrong
function displayError($errormessage)
{
    echo "<i class ='textError'>";
    echo "<label class=" . CLASS_ERROR . ">" . $errormessage . "</label>";
    echo "</i>";
}
 // ################################## VALIDATE CITY #######################################
// Validate name, city.  
function ValidateString($fieldname, $value, $maxlength)
{
    if (isset($_POST[$value])) {   //validate  the feild to be numeric
        if (is_numeric($_POST[$fieldname])) {
            displayError("Enter a string value");
        } else {   //validate if the input is empty
            if ($_POST[$fieldname] == "") {
                displayError("Enter a valid " . $fieldname."!!!!!");
            }
            //to make sure string is bigger then its maximum length   
            elseif (mb_strlen($_POST[$fieldname]) > $maxlength) {
                displayError("The " . $fieldname . " cannot be more than " . $maxlength);
            } else { // validate that all entries are valid
                $_GET["validate"]++;
            }
        }
    }
}
// ############################## PRODUCT KEY ############################### //
// Validate the Product Key
function validatekey($fieldname, $value, $maxlength, $startletter)
{
    if (isset($_POST[$value])) {
        // validate if the input is empty
        if ($_POST[$fieldname] == "") {
            displayError("Enter Valid Key!!!!!");
        } else {   // validate if the first leter is not empty
            if (substr(ucfirst($_POST[$fieldname]), 0, 1) != $startletter) {
                displayError("The Poduct key can only start with P!!!!!");
            }
            //validate if the product is numeric only    
            elseif (is_numeric($_POST[$fieldname])) {
                displayError("Please enter a valid string code!!!!!");
            }
            //validate if the product key is bigger the its max length   
            elseif (mb_strlen($_POST[$fieldname]) > $maxlength) {
                displayError("The Product key cannot br bigger then 10 letters!!!!!");
            } else {
                //validate that all entries are valid
                $_GET["validate"]++;
            }
        }
    }
}

 // ########################### VALIDATE COMMENT ############################# //
// validate the comment length
function validateComments($fieldname, $value)
{
    if (isset($_POST[$value])) {
        // display that error if the length is greater then 200 
        if (mb_strlen($_POST["Comments"]) > comment_Length) {
            displayError("Enter a valid comment with length of 200!!!!!");
        } else {
            echo '';
        }
    }
}

 // ############################## VALIDATE PROVINCE #################################### //
        
 
 
        //WAS TRYING TO VALIDATE THE PROVINCE BUT COULDNT because of lots of bugs


// //validate provice
// function validateProvince($fieldname, $value)
// {
//     if (isset($_POST[$value])) {
//         // display that error if the length is greater then feild name
//         if (mb_strlen($_POST["Province"]) > province_length) {
//             displayError("Enter a valid Province!!!!!");
//         } else {
//             echo '';
//         }
//     }
// }



//validate price    
 // ############################## VALIDATE PRICE ####################################
function validateprice($fieldname, $value, $maprice, $minprice)
{

    if (isset($_POST[$value])) {   //validate if price isn't numeric
        if (!is_numeric($_POST[$fieldname])) {
            displayError("Enter a valid numeric value!!!!!");
        } else
            //validate if the price is numeric
            if (is_numeric($_POST[$fieldname])) {
                //validate if the price is greater then max price
                if ($_POST[$fieldname] > $maprice) {
                    displayError("The Price cannot be less than " . min_price);
                }
                //validate if the  price is less then min price
                elseif ($_POST[$fieldname] < $minprice) {
                    displayError("The Price cannot be more than " . limit_price);
                } else {
                    //validate that all entries are valid
                    $_GET["validate"]++;
                }
            }
    }
}
 // ############################### VALIDATE QUANTITY ################################ //
// verify quantity
function ValidateQuantiy($fieldName, $value, $MaxLength, $minLength)
{
    if (isset($_POST[$value])) {
        //validate if enterd inout is in float or decimel
        if ((float) $_POST[$fieldName] != (int) $_POST[$fieldName]) {
            displayError("Enter a valid value (int integer value)");
        }
        //validate if the input is empty
        if ($_POST[$fieldName] == "") {
            displayError("Enter a valid numeric value !!!!!");
        } else {
            //validate if quantity is lesser than minquantity
            if ($_POST[$fieldName] < $minLength) {
                displayError("The Quantity cannot be less than " . $minLength);
            }
            //validate if quantity is bigger than maxquatity
            elseif ($_POST[$fieldName] > $MaxLength) {
                displayError("The Quantity cannot be more than " . $MaxLength);
            } else {
                // validate that all entries are valid
                $_GET["validate"]++;
            }
        }
    }
}

    //      ################ DATABASE #################################### //
 // DATABASE CONNECTION IS SUCCESSFUL 
            // USERNAME : root
            //PASSWORD: ravzdhanju
            //HOWEVER IT DOES NOT ALLOW ME TO LOGIN 
            // DID ECHO IT MANY TIMES BUT COULDNT FIND THE PROBLEM
            //MOREOVER I LOVED DEBUGGING THIS FUNCTION
// function login()
//      {
//          if(isset($_POST["login"]))
//          {
//             $connection = new server();
//                  $signIn=$connection->serverConnnection();
//                  $username=(string) $_POST["username"] ;
//                       $password=(string) $_POST["password"];
//             $sql= 'CALL show_Users()';//calling the stored routine

//                         $PDOstatement=$signIn->prepare($sql);//preparing the sql for prompting the sql
//                         $PDOstatement->execute(); //executing the data

//             
            // DATABASE CONNECTION IS SUCCESSFUL 
            // USERNAME : root
            //PASSWORD: ravzdhanju
            //HOWEVER IT DOES NOT ALLOW ME TO LOGIN 
            // DID ECHO IT MANY TIMES BUT COULDNT FIND THE PROBLEM
            //MOREOVER I LOVED DEBUGGING THIS FUNCTION

    //      }
    // }
 // ###################################### PURCHASE PAGE ##################################### //
function createsform()
{
    ?>
        <div class="contai">
            <form action="Form.php" method="POST">
                <?php $validate = 0; ?>
                <h1 class="formh1">Enter the Details..</h1>

                <label for="productke" class="lable">Product Key</label>
                <span><?php validatekey("ProductId", "Submit", keylength, key); ?></span>
                <input type="text" name="ProductId" placeholder="Enter The product key Starting with 'P' ..">
                <br>
                <label for="fname" class="lable">First Name</label>
                <span><?php ValidateString("firstname", "Submit", name_length_MAX); ?></span>
                <input type="text" name="firstname" placeholder="First Name...">
                <br>
                <label for="lname" class="lable">Last Name</label>
                <span><?php ValidateString("LastName", "Submit", name_length_MAX); ?></span>
                <input type="text" name="LastName" placeholder="Last Name...">
                <br>
                <label for="City" class="lable">City</label>
                <span><?php ValidateString("City", "Submit", city_length); ?></span>
                <input type="text" name="City" placeholder="City..">
                <br>
                <label for="comment" class="lable">Comments</label>
                <span><?php validateComments("Comments", "Submit") ?></span>
                <textarea id="subject" name="Comments" placeholder="Write something.." style="height:200px"></textarea>
                <br>
                <label for="price" class="lable">Price</label>
                <span><?php validateprice("Price", "Submit", limit_price, min_price) ?></span>
                <input type="text" name="Price">
                <br>
                <label for="Quantity" class="lable">Quantity</label>
                <span><?php ValidateQuantiy("Quantity", "Submit", MAX_QUANTITY, min_Quantity) ?></span>
                <input type="text" name="Quantity">

                <br>
                <input class="button" type="submit" name="Submit" value="Save">
                <input class="button" type="button" value="Clear" onclick="return reloadPage();">
                </form>
        </div>
        ';
        }



        <!-- // +++++++++++++++++++++++++++++++++++++++++ create the form +++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


        <?php

        //save data              
        if (isset($_POST['Submit'])) {



            //put all input contents in variables
            $productkeys = $_POST["ProductId"]; //product key variable
            $firstname = $_POST["firstname"]; //first name variable
            $lastname = $_POST["LastName"]; //last name variable
            $city = $_POST["City"]; //city variable
            $comment = $_POST["Comments"]; //comment variable
            $price = $_POST["Price"]; //pricevariable
            $quantity = $_POST["Quantity"]; //quatity variable

            //validate if any of the variable is empty
            if ($_GET["validate"] !== 6) {
                echo '';
            } else {


                //count the taxes subtotal and grandtotal
                $subtotal = round($price * $quantity, 2);

                $taxes = round($subtotal * (15 / 100), 2);

                $GrandTotal = round($subtotal + $taxes, 2);

                //put all data in one array

                $array = array($productkeys, $firstname, $lastname, $city, $comment, $price, $quantity, $subtotal, $taxes, $GrandTotal);

                //convert array into string 

                $variable = json_encode($array);

                //save the data in file

                $openFile = fopen(purchasefile, 'a');

                file_put_contents(purchasefile, $variable . File_eol, FILE_APPEND);

                fclose($openFile);
            }
        }
        ?>
        </p>
        </form>

    <?php

}


//+++++++++++++++++++++++++++++ PURCHASE PAGE +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

##purchase page
//display the sold products
function purchaselayout()
{
    ?><h1> You have Purchased these Products </h1><?php
                                                    $myfile = fopen(purchasefile, "r") or die("cannot open file!");

                                                    ?>
        <table align="center">
            <tr>
                <th>
                    <h3>Product Id</h3>
                </th>
                <th>
                    <h3>First Name</h3>
                </th>
                <th>
                    <h3>Last Name</h3>
                </th>
                <th>
                    <h3>City</h3>
                </th>
                <th>
                    <h3>Comments</h3>
                </th>
                <th>
                    <h3>Price</h3>
                </th>
                <th>
                    <h3>Quantity</h3>
                </th>
                <th>
                    <h3>SubTotal</h3>
                </th>
                <th>
                    <h3>Taxes</h3>
                </th>
                <th>
                    <h3>Grand Total</h3>
                </th>
            </tr>

            <?php
            $filename = purchasefile;
            $contents = file($filename);
            foreach ($contents as $line) {
                $array = json_decode($line);
                if ($array != null) {
            ?><tr><?php
                            foreach ($array as $order) {
                            ?><th><?php echo $order; ?></th><?php
                                                        }
                                                            ?></tr><?php
                            }
                        }
                                ?>
        </table>
        <a href="<?php echo "purchasefile"; ?>" download>
            <input type="button" class="pressbtn" value="Download"></a>

    <?php
}

 // ############################### REGISTER / SIGN IN PAGE #############################################
function logins()
{
    ?><div class="loginWrapper">
        
            <form action="account.php" method="POST">
            <h1 style="color:#111">Login to the website</h1>
                <div class="inputBox">
                    <input type="text" placeholder="username" name="username">
                </div>
                <div class="inputBox">
                    <input type="password" placeholder="Password" name="password">
                </div>
                <input type="submit" class="loginss" value="Login">
                <h2>Forget Password ?  </h2>
                <h2>OR</h2>
                <!-- <a href="register.php"> </a> -->
            <a href="register.php">    <input type="submit" class="signup" value="Create Account" onclick="redirectPageSignUp()" name="login"> </a>
            
                <!-- <h2>Fraincais</h2>  -->
            </form>
        </div>
    <?php
}
 // ############################ Implementing Database ##########################################
 // To implement Connection 
  // this is done for accessing connection from the server.php file

// #################################
// $connect=new server();
// $connection=$connect->serverConnnection();
// ###################################

//But i got an error just before i was going to submit it
// The code is ok but i wasnt able to debug the error

// #################################### REGISTER / LOGIN PAGE ##########################################
function signup()
{
    ?>
        <div class="contai">
            <form action="register.php" method="POST">
                <?php $validate = 0; ?>
                <h1 class="formh1">Create your Account..</h1>

               
                <label for="fname" class="lable">First Name</label>
                <span><?php ValidateString("firstname", "Submit", name_length_MAX); ?></span>
                <input type="text" name="firstname" placeholder="Ravz...">
                <br>
                <label for="lname" class="lable">Last Name</label>
                <span><?php ValidateString("LastName", "Submit", name_length_MAX); ?></span>
                <input type="text" name="LastName" placeholder="Dhanju..">
                <br>
                <label for="City" class="lable">City</label>
                <span><?php ValidateString("City", "Submit", city_length); ?></span>
                <input type="text" name="City" placeholder="Montreal..">
                <br>
                <label for="Province" class="lable">Province</label>
          
                <input type="text" name="City" placeholder="Quebec..">
                <br>
                <label for="postalCode" class="lable">Postal Code</label>
            
                <input type="text" name="City" placeholder="H4N 1G3">
                <br>
                <label for="username" class="lable">Username</label>
            
                <input type="text" name="City" placeholder="ravzdhanju">
                <br>
                <label for="password" class="lable">Password</label>

                <input type="password" name="City" placeholder="*****">
                <br>
                <input class="button" type="submit" name="Submit" value="Register">
                <input class="button" type="button" value="Clear" onclick="return reloadPage();">
                <br>
                <h2>OR</h2>
                <input type="button" class="loginss" value="Login " onclick="return redirectPage()">
                </form>
        </div>
    <?php
}

    // ############################### BUY.php page ############################## //
function buypage()
{
    ?>
        <div class="contai">
            <form action="buy.php" method="POST">
               
                <h1 class="formh1">Enter the Details..</h1>

                
                <label for="productcode" class="lable">Product Code</label>
                <select>
                    <option> </option>
                    <option>P</option>
                </select>
                
                <label for="customer" class="lable">Customers</label>
                <select>
                    <option> </option>
                    <option>Mr</option>
                    <option>Mrs</option>
                </select>
                <label for="comment" class="lable">Comments</label>
                <textarea id="subject" name="Comments" placeholder="Write something.." style="height:200px"></textarea>
                <label for="Quantity" class="lable">Quantity</label>
                <span><?php ValidateQuantiy("Quantity", "Submit", MAX_QUANTITY, min_Quantity) ?></span>
                <input type="text" name="Quantity">

                <br>
                <input class="button" type="submit" name="Submit" value="Buy">
                <input class="button" type="button" value="Clear" onclick="return reloadPage();">
                </form>
        </div>
        <!-- '; 
        } -->
        <?php
}

 // THANKS FOR TAKING A LOOK AT MY CODE 
 // I HAVE DONE MY BEST TO MAKE THIS WEBSITE INFORMATIVE AND TO THE POINT
 // I WAS NOT ABLE TO DO SOME TASKS SUCH AS IMPLEMENTING THE LOGIN BUT THE CODE IS CORRECT
 // THANKS A LOT 





    ?>