 function Validate(form)
{
    // DECLARE VARIABLES TO STORE VALUES RETRIEVED FROM FORM
    var fname= document.getElementById("fname");
    var lname= document.getElementById("lname");
    var email= document.getElementById("email");
    var password= document.getElementById("password");
    var err = 0;

    // CALL FUNCTIONS TO PERFORM VALIDATION

    // CALLS REQUIRED FUNCTION TO CHECK IF_EMPTY
    required(fname);
    required(lname);
    required(email);
    required(password);
    isAlphaNumeric(password);

    // FUNCTION DEFINITION OF REQUIRED FUNCTION
    function required(x) 
    {
      // CHECKS IF FIELD IS EMPTY
      if (x.value.length == 0)
      { 
          // CHANGES backgroundColor TO RED IF TEST PASSED
          x.style.backgroundColor='red';
          this.err=1;
          return false;
      }
          return true;
    }

   // FUNCTION DEFINITION OF ISALPHANUMERIC FUNCTION
   function isAlphaNumeric(x)
    {
      // DECALE ARRAY STORING RANGE OF AlphaNumeric VALUE
     var letterNumber = /^[0-9a-zA-Z]+$/;

     // CHECKS IF VALUE FOLLOWS letterNumber RANGE AND IS AlphaNumeric
     if(x.value.match(letterNumber))
      {
        return true;
      }
    else
      {
        // CHANGES backgroundColor TO RED IF TEST FAILED
        x.style.backgroundColor='red';
        this.err=1;
       return false; 
      }
    }

    // FUNCTION DEFINITION OF ANINTEGER FUNCTION
    function anInteger(x)
    {
      // DECALE ARRAY STORING RANGE OF Numeric VALUE
     var number = /^[0-9]+$/;
     // CHECKS IF VALUE FOLLOWS letterNumber RANGE AND IS AlphaNumeric
     if(x.value.match(number))
      {
        return true;
      }
    else
      { 
        // CHANGES backgroundColor TO RED IF TEST FAILED
        x.style.backgroundColor='red';
        this.err=1; 
       return false; 
      }
    }

  if (this.err>0) {
    Alert("Enter Correct values");
  }
}
