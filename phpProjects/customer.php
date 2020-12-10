<?php
include 'functions/phpFunctions.php'; // including / attaching the functions file
include_once 'server.php';// including / attaching the server file
class customer // initialising the customer class
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

     // ####################################### configuring private fields ########################################## //

    private $customer_Id = ""; //configure customer_id  in a private field
    private $first_Name = ""; // configure firstname  in a private field
    private $last_Name = "";// configure lastname  in a private field
    private  $City = "";//configure city in a private field
    private $Province = "";// configure province in a private field
    private $postal_Code = "";// configure postal code  in a private field
    private  $user_Name = "";//configure username in a private field
    private $user_Password = "";// configure   in a private field


    // ##############################  setting the values in the  private fields #################################################//
    public function construct(
        $P_customer_Id = "",//setting the values of customerid in the  private field
        $P_first_Name = "",//setting the values of first name in the  private field
        $P_last_Name = "",//setting the values of lastname in the  private field
        $P_City = "",//setting the values of city in the  private field
        $P_Province = "",//setting the values of province in the  private field
        $P_postal_Code = "",//setting the values of postal codein the  private field
        $P_user_Name = "",//setting the values of username in the  private field
        $P_Password = ""//setting the values of password in the  private field
    ) {

    // ####################################### setting the values of constructor in the  parameters ###################################### // 

        if ($P_customer_Id != "") {
            $this->customer_Id = $P_customer_Id;//setting the values of constructor in the  parameters
            $this->first_Name = $P_first_Name;//setting the values of constructor in the  parameters
            $this->last_Name = $P_last_Name;
            $this->City = $P_City;              
            $this->Province = $P_Province;
            $this->postal_Code = $P_postal_Code;
            $this->user_Name = $P_user_Name;
            $this->user_Password = $P_Password;//setting the values of constructor in the  parameters
        }
    }

    // #########################################  GETTERS   ########################################### // 


public function getcustomer_Id() //getter for the customerid
{
    return $this->customer_Id;//returning the getter for the customerid
    
}

public function getfirst_Name()//getter for the firstname
    {
        return $this->first_Name;//returning the getter for the firstname
    }
    
    public function getlast_Name()//getter for the lastname
    {
        return $this->last_Name;//returning the getter for the lastname
    }
    

    public function getCity()//getter for the city
    {
        return $this->City;//returning the getter for the city
    }
    

    public function getProvince()//getter for the province
    {
        return $this->Province;//returning the getter for the province
    }


    public function getpostal_Code()//getter for the postalcode
    {
        return $this->postal_Code;//returning the getter for the postalcode
    }
    
    public function getuser_Name()//getter for the username
    {
        return $this->user_Name;//returning the getter for the postalcode
    }
    
    
    public function getuser_Password()//getter for the username
    {
        return $this->user_Password;//returning the getter for the password
    }
    

    // ######################################### Setters ############################################ //
    
    public function setfirst_Name($first_name)  //setter for the first_Name of the customer
    {
       if(ValidateString($first_name, "Save", name_length_MAX)==true)  // Validating string for the firstName
       {
           $this->first_Name=$first_name; //setting value of customer first name when is enter's it and storing it to variable defined above
       }             
    }

    public function setlast_Name($last_name) //setter for the lastname of the customer
    {
       if(ValidateString($last_name, "Save",name_length_MAX)==true) // Validating string for the firstName
        {
            $this->last_Name=$last_name;//setting value of customer last name when is enter's it and storing it to variable defined above
        }
    }

    
    public function setCity($City)//setter for the city
    {
         if(ValidateString($City, "Save", city_length,province_length)==true)  // Validating string for the city
        {
            $this->City=$City;//setting value of customer city when is enter's it and storing it to variable defined above
        }
    }
    
    public function setProvince($Province)//setter for the province
    {
         if(ValidateString($Province, "Save", city_length,province_length)==true)  // Validating string for the province
        {
            $this->Province=$Province;//setting value of province when is enter's it and storing it to variable defined above
        }
    }

    public function setpostal_Code($postal_Code)//setter for the postalcode
    {
         if(ValidateString($postal_Code, "Save",postal_code_length)==true)  // Validating string for the postal code
        {
            $this->postal_Code=$postal_Code;//setting value of postalcode when is enter's it and storing it to variable defined above
        }
    }


    public function setuser_Name($user_Name)//setter for the username
    {
       if(ValidateString($user_Name, "Save", username_length)==true) // Validating string for the username
        {
            $this->user_Name=$user_Name;//setting value of username when is enter's it and storing it to variable defined above
        }
    }
    
    public function setuser_Password($user_Password)//setter for the password
    {
        if(strlen($user_Password)<255)
        {
            $this->user_Password;//setting value of password when is entered and storing it to variable defined above
        }
    }

// this function selects customer according to the variables defined;
// variables such as:-
// # firstname
// # lastname

    public function showData($customer_Id)
    {
        $connection=new server(); //accessing connection from the server.php file
        $connection=$connection->serverConnnection();//accessing connection from the server.php file
        
        $sql="CALL show_Customer(:customer_Id)"; //command for the sql to show data of the customer for example his name or city
        
        $PDOStatement=$connection->prepare($sql); //preapring connection to the sql
        $PDOStatement->bindParam(":customer_Id",$customer_Id);  //binding perimeter
        $PDOStatement->execute(); // executing data
        if($row=$PDOStatement->fetch(PDO::FETCH_ASSOC)) // fetching data
        {
            $this->customer_Id=$row["customer_Id"];
            $this->first_Name=$row["first_Name"];
            $this->last_Name=$row["last_Name"];
            $this->City=$row["City"];
            $this->Province=$row["Province"];
            $this->postal_Code=$row["postal_Code"];
            $this->user_Name=$row["user_Name"];
            $this->user_Password=$row["user_Password"];
        
        }
    }
        // #######################################  writing or uploading data to the database    ####################################
        // this is done for accessing connection from the server.php file


    public function writeData() // writing or uploading data to the database    
    {
        $connection=new server();//accessing connection from the server.php file
        $connection=$connection->serverConnnection();//accessing connection from the server.php file

        if($this->customer_Id=='')
        {
            $sql="CALL insert_Customer(:first_Name,:last_Name,:City,:Province,:postal_Code,:user_Name,:user_Password)"; // depositing data into the database 
            $PDOStatement=$connection->prepare($sql); // preparing connection to the sql
            $PDOStatement->bindParam(":first_Name",$this->first_Name);
            $PDOStatement->bindParam(":last_Name",$this->last_Name);
            $PDOStatement->bindParam(":City",$this->City);
            $PDOStatement->bindParam(":Province",$this->Province);
            $PDOStatement->bindParam(":postal_Code",$this->postal_Code);
            $PDOStatement->bindParam(":user_Name",$this->user_Name);
            $PDOStatement->bindParam(":user_Password",$this->user_Password);
            $PDOStatement->execute();
        }
        else
        {
            $sql="CALL update_Customer(:City,:Province,:postal_Code,:user_Password,:user_Name,:customer_Id)"; // depositing the data into the database
            $PDOStatement=$connection->prepare($sql);// preparing the connections
            $PDOStatement->bindParam(":City",$this->City);// binding the parameters to the connection
            $PDOStatement->bindParam(":Province",$this->Province);// binding the parameters to the connection
            $PDOStatement->bindParam(":postal_Code",$this->postal_Code);// binding the parameters to the connection
            $PDOStatement->bindParam(":user_Password",$this->user_Password);// binding the parameters to the connection
            $PDOStatement->bindParam(":user_Name",$this->user_Name);// binding the parameters to the connection
            $PDOStatement->bindParam(":customer_Id",$this->customer_Id);// binding the parameters to the connection
            $PDOStatement->execute();// executing the data
        }
            

    }

    // ############################### remove the Customer details from the database ######################################
        //this function is for removing the customer from the database

    public function removeCustomer($customer_Id) //this function is for removing the customer from the database
    {
        $connection=new server();//accessing connection from the server.php file
        $connection=$connection->serverConnnection();//accessing connection from the server.php file
        
        $sql="CALL removeCustomer(:customer_Id)";// initilizing the command to call the source routine 
        $PDOStatement=$connection->prepare($sql);   //preparing the connection to the sql
        $PDOStatement->bindParam(":customer_Id",$customer_Id); // binding the parameters to the connection
        $PDOStatement->execute();// executing the data
    }




































}
?>