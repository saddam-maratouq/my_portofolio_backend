
<?php


//  count record for limited item added ...

$check = $connect->query("SELECT id FROM $tableName");
if (!$check) {
     die("Query failed for table :  $tableName ") ; // 
}

$countTableRows = $check->num_rows;


# this functions add  to html element input , button etc ... 

// disable enable html element depend on reach max limit record 
  function   mangeLimitedRecord( )  : string {
   
    global $editData ,   $maxLimited  ,  $countTableRows  ;

    if ($editData)  return      ($countTableRows >  $maxLimited ? 'disabled' : '' ) ; 
   
    else            return      ($countTableRows >=  $maxLimited ? 'disabled' : '' ) ; // default insert 
 
  }



// if update record (no title for warn limit) or check limit to show title if reached ....
  function mangeLimitedTitle() : string {

    global $editData ,   $maxLimited  ,  $countTableRows  ;

    return  $editData ?  ''   :  
    (   $countTableRows >= $maxLimited  ? 'Maximum limit reached ( '. $countTableRows .' items). Please remove an item to add a new one.' : '') ;

  }

  