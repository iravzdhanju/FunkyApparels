<?php
include 'functions/phpFunctions.php';// including / attaching the functions file
include_once 'server.php';// including / attaching the server file
class product // initialising the product class
{
    //#####Created by : Ravinderpal Singh
    //#####This page has classes which are used to store information of the customers
    //#####here i have used customer_id as a primary key
    //#####first_name to store the first name of the users
    //#####last_name to store the last name of the users
    //#####city , Province, postal_code to store the adddress of the users
    //#####user_name to store the username of the user
    //#####user_password to store the password of the user

      //PLEASE NOTE The order of defing private fields , getter and setters are same as in the database 
        // porpose for this order was to make the code simple and organised

   // ####################################### configuring private fields ########################################## //


    private $product_Id="";//configure customer_id  in a private field
    private $product_Code="";// configure product_code  in a private field
    private $Description="";// configure description  in a private field
    private $Price=0.00;// configure price  in a private field

     // ##############################  setting the values in the  private fields #################################################//

    function construct($id_product="",  //setting the values of idproduct in the  private field
                        $code_Product="",//setting the values of code_Product  in the  private field
                        $Price=0.00,//setting the values of price in the  private field
                        $Desc="") //setting the values of description in the  private field


    // ####################################### setting the values of constructor in the  parameters ###################################### // 
    {
        $this->product_Id=$id_product;//setting the values of constructor in the  parameters
        $this->product_Code=$code_Product;
        $this->Price=$Price;
        $this->Description=$Desc;//setting the values of constructor in the  parameters
    }

     // #########################################  GETTERS   ########################################### // 

    public function getproduct_Code() //getter for the product code
    {
       
        return $this->product_Code;//returning the getter for the product code

    }
    function getproduct_Description()//getter for the description
    {
        return $this->Description;//returning the getter for the description
    }
    function getproductPrice()//getter for the product price
    {
        return $this->Price;//returning the getter for the product price
    }

    // ######################################### Setters ############################################ //

    function setProductCode($code_Product)//setter for the product code of the product
    {
        if(validatekey($code_Product, "Save", keylength, key)==TRUE)// Validating string for the product Code
        {
            $this->product_Code=$code_Product;//setting value of Product Code  and storing it to perimeter defined above
        }
    }

    function setproductDescription($Desc)//setter for the product description
    {
       if(strlen($Desc< comment_Length))// Validating string for the description
       {
           $this->Description=$Desc;//setting value of description and storing it to perimeter defined above
       }
    }
    function setproduct_Price($Price)//setter for the productprice
    {
        if(validatePrice($Price, "Save", limit_price, min_price)==TRUE)// Validating string for the productprice
        {
            $this->Price=$Price;//setting value of productprice and storing it to perimeter defined above
        }
    }

// this function selects products according to the variables defined which mainly are the perimeters;
// variables such as:-
// # productcode
// # price
// # description
    
    public function showData($product_Code)
    {
        $connection=new server();//accessing connection from the server.php file
        $connection=$connection->serverConnnection();//accessing connection from the server.php file
        
        $sql="CALL show_Product(:product_Code)";//shows data of the product
        
        $PDOStatement=$connection->prepare($sql);//preapring connection to the sql
        $PDOStatement->bindParam(":product_Code",$product_Code);//binding perimeter
        $PDOStatement->execute();// executing data
        if($row=$PDOStatement->fetch(PDO::FETCH_ASSOC)) // fetching data
        {
            $this->Price=$row["Price"];
            $this->Description=$row["Description"];
        }
    }
    
        // #######################################  writing or uploading data to the database    ####################################
        // this is done for accessing connection from the server.php file

    public function writeData()// writing or uploading data to the database  
    {
        $connection=new server();//accessing connection from the server.php file
        $connection=$connection->serverConnnection();//accessing connection from the server.php file
        if($this->product_Id=='')
        {
            $sql="CALL insert_Product(:product_Code,:Price,:Description)";// depositing data of product into the database 
            $PDOStatement=$connection->prepare($sql); // preparing the connection
            $PDOStatement->bindParam(":product_Code",$this->product_Code); //binding the product perimeter
            $PDOStatement->bindParam(":Price",$this->Price);//binding the price perimeter
            $PDOStatement->bindParam(":Description",$this->Description);//binding the description perimeter
            $PDOStatement->execute(); //executing the commands
        }
        else
        {
            $sql="CALL update_Product(:Price,:product_Code,:Description)"; // updating the data whenever their are existing details of similar product
            $PDOStatement=$connection->prepare($sql); //preparing the connection for sql
            $PDOStatement->bindParam(":Price",$this->Price); //binding the perimeters
            $PDOStatement->bindParam(":product_Code",$this->product_Code); // binding the perimeters
            $PDOStatement->bindParam(":Description",$this->Description);   // binding the perimeters
            $PDOStatement->execute(); //executing the query
        }
            
        }
         
    // ############################### remove the product details from the database ######################################
        //this function is for removing the product from the database

    public function removeProduct($product_Id)//this function is for removing the product from the database
    {
        $connection=new server();//accessing connection from the server.php file
        $connection=$connection->serverConnnection();//accessing connection from the server.php file
        
        $sql="CALL remove_Customer(:product_Id)";// initilizing the command to call the source routine 
        $PDOStatement=$connection->prepare($sql); //preparing the connection to the sql
        $PDOStatement->bindParam(":product_Id",$product_Id); // binding the parameters to the connection
        $PDOStatement->execute(); // executing the data
    }





































}
?>