<?php
function createpageHeader($title)
{
   ?><!DOCTYPE html>

<html>
   <head>
     <meta charset='UTF-8'>
        
        <title>$title</title>
        <link rel="stylesheet" type="text/css" href="<?php
                                                        $stylesheet = _DEFAULT_STYLESHEET;
                                                        //stylesheet according to the page selected
                                                        if (isset($_GET["mode"])) {
                                                            //stylesheet is applied according to the page selected
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
        <?php
}

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

function showError($errormessage)
{
    echo "<i class ='textError'>";
    echo "<label class=" . CLASS_ERROR . ">" . $errormessage . "</label>";
    echo "</i>";
}
        function fillinput($fieldname)
        {
            if(isset($_POST[$fieldname]))
            {
                echo $_POST[$fieldname];
            }
        }
        
      // Validate name, city.  
function ValidateString($fieldname, $value, $maxlength)
{
    if (isset($_POST[$value])) {   //validate  the feild to be numeric
        if (is_numeric($_POST[$fieldname])) {
            showError(" Enter a string value");
        } else {   //validate if the input is empty
            if ($_POST[$fieldname] == "") {
                showError("Please Enter " . $fieldname);
            }
            //to make sure string is bigger then its maximum length   
            elseif (mb_strlen($_POST[$fieldname]) > $maxlength) {
                showError("The " . $fieldname . " cannot be more than " . $maxlength);
            } else { // validate that all entries are valid
                $_GET["validate"]++;
            }
        }
    }
}
// Validate the Product Key
// function validatekey($fieldname, $value, $maxlength, $startletter)
// {
//     if (isset($_POST[$value])) {
//         // validate if the input is empty
//         if ($_POST[$fieldname] == "") {
//             showError("Please enter valid code");
//         } else {   // validate if the first leter is not empty
//             if (substr(ucfirst($_POST[$fieldname]), 0, 1) != $startletter) {
//                 showError("The Poduct key can only start with Q");
//             }
//             //validate if the product is numeric only    
//             elseif (is_numeric($_POST[$fieldname])) {
//                 showError("Please enter a valid string code");
//             }
//             //validate if the product key is bigger the its max length   
//             elseif (mb_strlen($_POST[$fieldname]) > $maxlength) {
//                 showError("The Product key cannot br bigger then 12 letters");
//             } else {
//                 //validate that all entries are valid
//                 $_GET["validate"]++;
//             }
//         }
//     }
// >?>