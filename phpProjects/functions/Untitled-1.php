<input type="text" name="ProductId" placeholder="Enter The product key Starting with 'Q' ..">
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


                <div class="loginWrapper">
            <form action = "register.php">
            <?php $validate = 0; ?>
            <span style="color:red;"><?php ValidateString("firstname", "Submit", name_length_MAX); ?></span>
                <div class="inputBox">
                    <input type="text" placeholder="First Name" name="firstname">
                    <?php ValidateString("firstname", "Submit", name_length_MAX); ?>
                </div>
                <div class="inputBox">
                    <input type="text" placeholder="Last Name" name="LastName">
                    <span><?php ValidateString("LastName", "Submit", name_length_MAX); ?></span>
                </div>
                
                <div class="inputBox">
                    <input type="text" placeholder="City" name="City">
                    <span><?php ValidateString("City", "Submit", city_length); ?></span>
                </div>
                <div class="inputBox">
                    <input type="text" placeholder="Province" name="province">
                </div>
                <div class="inputBox">
                    <input type="text" placeholder="Postal Code" name="postalcode"> 
                </div>
                <div class="inputBox">
                    <input type="text" placeholder="Username" name="username">
                </div>
                <div class="inputBox">
                    <input type="password" placeholder="Password" name="password">
                </div>

                <input class="button" type="submit" name="Submit" value="Save">
              <input type="submit" class="signup" value="Create Account" >

                <!-- <h2>Forget Password ?</h2> -->
                <!-- <h2>Fraincais</h2>  -->
            </form>
        </div>
        <div class="loginWrapperss">
        <form class="from">
        <h2>OR</h2>
                <input type="submit" class="loginss" value="Login">
</form>
        </div>