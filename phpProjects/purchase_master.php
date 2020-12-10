<?php
include 'functions/phpFunctions.php';// including / attaching the functions file
include_once 'server.php';// including / attaching the server file
include'product.php';// including the product.php file from local storage
class purchase_master// initialising the purchase class
{
    //#####Created by : Ravinderpal Singh
    //#####This page has classes which are used to store information of the customers
    //#####here i have used customer_id as a primary key
    //#####first_name to store the first name of the users
    //#####last_name to store the last name of the users
    //#####city , Province, postal_code to store the adddress of the users
    //#####user_name to store the username of the user
    //#####user_password to store the password of the user

    // PLEASE NOTE The order of defing private fields , getter and setters are same as in the database 
    // porpose for this order was to make the code simple and organised
    // i have initialized the private variables on the top of the files to make it usable


     // ####################################### configuring private fields ########################################## //


    private $purchase_Id="";//configure purchaseid  in a private field
    private $user_Name="";// configure username  in a private field
    private $product_Code="";// configure product_code  in a private field
    private $Price=0.00;//configure price in a private field
    private $quantity_Sold=0;//configure quantity which are sold in a private field
    private $Comment="";//configure comment in a private field
    private $Subtotal=0.00;//configure subTotal in a private field
    private $grandTotal=0.00;//configure grandTotal in a private field
    private $Taxes=0.00;//configure Taxes in a private field




       // ##############################  setting the values in the  private fields #################################################//

public function construct($P_purchase_Id="",//setting the values of purchaseid in the  private field
                        $P_user_Name="",//setting the values of username in the  private field
                        $P_product_Code="",//setting the values of productcode in the  private field
                        $P_Price=0.00,//setting the values of price in the  private field
                        $P_quantity_Sold=0,//setting the values of quantity which are sold in the  private field
                        $P_Comment="",//setting the values of comment in the  private field
                        $P_Subtotal=0.00,//setting the values of subtotal in the  private field
                        $P_grandTotal=0.00,//setting the values of grandtotal in the  private field
                        $P_Taxes=0.00)//setting the values of taxes in the  private field



                        // ####################################### setting the values of constructor in the  parameters ###################################### // 
    {
        $this->purchase_Id = $P_purchase_Id;//setting the values of constructor in the  parameters
        $this->user_Name = $P_user_Name;//setting the values of constructor in the  parameters
        $this->product_Code = $P_product_Code;
        $this->Price = $P_Price;
        $this->quantity_Sold = $P_quantity_Sold;//setting the values of constructor in the  parameters
        $this->Comment = $P_Comment;
        $this->Subtotal = $P_Subtotal;
        $this->grandTotal = $P_grandTotal;//setting the values of constructor in the  parameters
        $this->Taxes = $P_Taxes;//setting the values of constructor in the  parameters
    }

       // #########################################  GETTERS   ########################################### // 


    public function getuser_Name() //getter for the username
    {
       return $this->user_Name; //returning the getter for the username
    }
    public function getproduct_Code()//getter for the product code
    {
        return $this->product_Code;//returning the getter for the product code
    }

    public function getproduct_Price()//getter for the product code
    {
        $product=new product(); // initilizating the new object
        $product->showData($this->product_Code);//returning the getter for the username
        $this->Price=$product->getproductPrice();//returning the getter for the username
    }
    public function getproduct_quantity_Sold()//getter for the sold quantity
    {
        return $this->quantity_Sold;//returning the getter for the sold quantity
    }
    public function getproduct_Comment()//getter for the comments
    {
        return $this->Comment;//returning the getter for the comments
    }
    
    public function getproduct_Subtotal()//getter for the subTotal
    {
        return $this->Subtotal;//returning the getter for the subtotal
    }
     
    public function getproduct_grandTotal()//getter for the grandtotal
    {
        return $this->grandTotal;//returning the getter for the grandtotal
    }

    public function getproduct_Taxes()//getter for the taxes
    {
        return $this->Taxes;//returning the getter for the taxes
    }
// ####################################### setters #################################### //

public function setproductPrice()//setter for the product price of the product
{
    $this->Price = $this->getproduct_Price();//setting value of customer first name when is enter's it and storing it to variable defined above
}

public function setproduct_Code($product_Code)//setter for the product price of the product
    {
        if(validatekey($product_Code, "Submit", keylength, key)==TRUE)// Validating string for the productcode
        {
            $this->product_Code=$product_Code;      //setting value of product price first   storing it to perimeter defined above      
        }       
    }

     public function setQuantity($quantity_Sold)//setter for the quantity sold of the product
     {
        if(validateQuantiy($quantity_Sold,"Save", min_Quantity,MAX_QUANTITY))// Validating string for the quantity sold
        {
            $this->quantity_Sold=$quantity_Sold;//setting value of quantity Sold and storing it to perimeter defined above
       }
     }


    public function setproduct_Comment($Comment)//setter for the product comment of the product
    {
        if(strlen($Comment < comment_Length))// Validating string for the comment
        {
           $this->Comment=$Comment;//setting value of comment and storing it to perimeter defined above
        }
    }
    public function setproduct_Subtotal()//setter for the product price of the product
    {
        $this->SubTotal=$this->getproduct_quantity_Sold()*$this->getproduct_Price();// Validating string for the comment
    }

    public function setproduct_Taxes()//setter for the product price of the product
     {
         $this->Taxes=Current_Tax*$this->getproduct_Subtotal();
    }

    public function setproduct_grandTotal()//setter for the product price of the product
    {
        $this->GrandTotal=$this->getproduct_Subtotal()*$this->getproduct_Taxes();
    }

    
// this function selects purchases according to the variables defined;
// variables such as:-
// # username
// # product code

    public function showData()
    {
        $connection=new server(); //accessing connection from the server.php file
        $connection=$connection->serverConnnection();//accessing connection from the server.php file
        if($this->purchase_Id=='')
        {
            $sql="CALL insert_Purchase(:user_Name,:product_Code,:product_Price,:quantity_Sold,:Comments,:Taxes,:Subtotal,:grandTotal)";//command for the sql to show data of the purchases for example his price or quantity
            
            $PDOStatement=$connection->prepare($sql); //preparing the sql statement
            $PDOStatement->bindParam(":user_Name",$this->UserName);//binding perimeter for user_name
            $PDOStatement->bindParam(":product_Code",$this->ProductCode); // binding perimerter for product code
            $PDOStatement->bindParam(":product_Price",$this->Price);
            $PDOStatement->bindParam(":quantity_Sold",$this->quantity_Sold);
            $PDOStatement->bindParam(":Comments",$this->Comment);
            $PDOStatement->bindParam(":Taxes",$this->Taxes);
            $PDOStatement->bindParam(":Subtotal",$this->SubTotal);
            $PDOStatement->bindParam(":grandTotal",$this->GrandTotal);//binding perimeter for the grandTotal
            $PDOStatement->execute();// executing the command
        }
        else
        {
            $sql="CALL update_Purchase(:quantity_Sold,:product_Code,:purchase_Id,:Price,:Subtotal,:Taxes,:grandTotal)"; //updating the table if the query doesnt work
            $PDOStatement=$connection->prepare($sql);//preparing the sql for initialising command
            $PDOStatement->bindParam(":quantity_Sold",$this->quantity_Sold);
            $PDOStatement->bindParam(":product_Code",$this->product_Code);
            $PDOStatement->bindParam(":purchase_Id",$this->purchase_Id);
            $PDOStatement->bindParam(":Price",$this->Price);
            $PDOStatement->bindParam(":Subtotal",$this->Subtotal);
            $PDOStatement->bindParam(":Taxes",$this->Taxes);
            $PDOStatement->bindParam(":grandTotal",$this->grandTotal);
            $PDOStatement->execute();//executing the commands
        }     
        }


        
// #######################################  writing or uploading data to the database    ####################################
        // this is done for accessing connection from the server.php file



        public function writeData($purchase_Id)
        {
            global $connection;
            
            $sql="CALL show_Purchase(:purchase_Id)";
              
            $PDOStatement=$connection->prepare($sql);
            $PDOStatement->bindParam(":purchase_Id",$purchase_Id);
            $PDOStatement->execute();
            if($row=$PDOStatement->fetch(PDO::FETCH_ASSOC))
            {
                $this->PurchaseId=$row["purchase_Id"];
                $this->UserName=$row["user_Name"];
                $this->ProductCode=$row["product_Code"];
                $this->Price=$row["Price"];
                $this->Taxes=$row["Taxes"];
                $this->SubTotal=$row["Subtotal"];
                $this->GrandTotal=$row["grandTotal"];
                $this->Comment=$row["Comments"];
                $this->quantity_Sold=$row["quantity_Sold"];
            }
        }
        
      public function removePurchase($purchase_Id)
      {
        $connection=new server();//accessing connection from the server.php file
        $connection=$connection->serverConnnection();//accessing connection from the server.php file
          
          $sql="CALL DeletePurchase(:purchase_Id)";// initilizing the command to call the source routine 
          $PDOStatement=$connection->prepare($sql);//preparing the connection to the sql
          $PDOStatement->bindParam(":purchase_Id",$purchase_Id); // binding the parameters to the connection
          $PDOStatement->execute();// executing the data
      }



















}
?>