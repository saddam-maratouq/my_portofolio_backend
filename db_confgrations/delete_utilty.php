
<?php 


function  deleteRecord ($table_name , $id , $connect   )  {

     $delete_sql = " DELETE FROM $table_name WHERE id= $id  ";

    $result = mysqli_query( $connect,  $delete_sql);

    if ($result) {
        // edit later to show logic msg .... 
        header("Location: ?msg=Delete record successfully ");
        exit();
    } else {
        die(" Failed delete new record  ") ;
        
    }

}


?>