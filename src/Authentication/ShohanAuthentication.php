
// client-side/end-user
// form submit ( field1, field2 ) -> data
// Request -> process -> response


// TRY TO NOT USE HTML/FORM/VIEW/UI
// USE CLASS METHOD, JUST PASS DATA AS PARAMTER

// PHP GLOBAL VARIABLE ( $REQUEST, $SESSION )


// Authentication

// form submit ( field1 (email), field2, ..... ) -> data as request
// REGISTER USER -> user account create
   // user account related data get stored in database
   // generate a random key and store it alongside user data
// new account email verification ( with the previous generated key) -> we will have to implement using ( php mail library/function )
   // just created user will have the mail for verification -> with a link somehow holding the previosu generated key
   // user will click in the link -> then somehow we have to VERIFY this user account

// AFTER EMAIL VERIFICATION

// LOGIN -> form submit ( field1 (email), field2, ..... ) -> data as request
   // check if user exists
   // check if credentials are correct
   // check if user is verified 
   
   // IF ALL ABOVE CONDITIONS ARE TRUE
   // LOGIN APPROVE
        // session create -> store data in session variable
        
        // AFTER LOGIN WE CAN SHOW/PRINT/RETURN/OUTPUT
        // authenticated user details + check if the user is authenticated

//LOGOUT
        // sesssion destroy -> remove/delete/unset stored session variable

<?php
namespace Src\Authentication;

class ShohanAuthentication
{
  
// define needed property
// define needed methods

// at first create database
// connect database with pdo // (OPTIONAL) IF YOUR DATABASE CONNECTION CODE IS IN ANOTHER CLASS, THEN USE INHERITANCE
// START WORKING ON AUTEHENTICATION RELATED STUFFS


    public function trialMethod($dataOne, $dataTwo)
    {
            
    }

// create an instance of the class you are using // (OPTIONAL) IF YOU ARE CONFIDENT AND KNOW WHAT YOU ARE DOING, TRY USING CONSTRUCTOR
// call the method by passing values as parameter



// in the entry point of our application

// $myClassInstance = new ShohanAuthentication();

// $myClassInstance-> ......... 
  
}
