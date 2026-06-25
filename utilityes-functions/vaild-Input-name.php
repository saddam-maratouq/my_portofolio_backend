
<?php

    # invalid input pattern (A1-10 ... Z1-10)
    //   $inputPattern = '/^[A-Z]([1-9]|10)$/i'; // 1 to 9 include 10 
    //  if ( ! preg_match($inputPattern , $tableNameValue)  ) {
    //      $invalidPatternMatchErr  = true ;  
    //  }  
    #


function validateInputPatternName($inputValue, &$invalidPatternMatchErr) {
    if (!preg_match('/^[A-Z]([1-9]|10)$/i', $inputValue)) {
      $invalidPatternMatchErr = true ; 
        return false;
    }
    return true  ; // no err catch 
}

