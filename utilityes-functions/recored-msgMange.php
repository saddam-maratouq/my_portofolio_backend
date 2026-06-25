


<?php 

#  update function 

  function updateRecordMsg ( string  $urlPath ,  int $timer = 1000)   { 

        echo '
      <div id="success-msg" style="text-align:center; background:green; color:white; padding:10px;">
          Record updated successfully ✅
          <script>
              setTimeout(function() {
               window.location.href = "' . $urlPath . '?msg=record-update-successfully";
             
              }, ' . intval($timer) . ' );
          </script>
      </div>
      ';


  }


  function  failedUpdateRecordMsg($timer = 1000 )  {

        echo '
      <div id="success-msg" style="text-align:center; background:red; color:white; padding:10px;">
         Record updated failed ❌
          <script>
              setTimeout(function() {
                   window.location.href = window.location.pathname + "?msg=record-updated-failed" 
                  
              }, ' . intval($timer) . ' );
          </script>
      </div>
      ';

 
  } ; 


  # insert function 

    function addRecordMsg  ( int $timer = 1000)   { 

        echo '
      <div id="success-msg" style="text-align:center; background:green; color:white; padding:10px;">
          Record Added successfully ✅
          <script>
              setTimeout(function() {
                
               window.location.href = window.location.pathname + "?msg=recored-added-succsesfully" 


              }, ' . intval($timer) . ' );
          </script>
      </div>
      ';

  }

//    window.location.href = "' . $urlPath . '?msg=record-added-successfully"; 
  


      function failedAddRecordMsg (   int $timer = 1000)   { 

        echo '
      <div id="success-msg" style="text-align:center; background:red; color:white; padding:10px;">
          Record Added failed ❌
          <script>
              setTimeout(function() {
            
                window.location.href = window.location.pathname + "?msg=record-added-failed" 

              }, ' . intval($timer) . ' );
          </script>
      </div>
      ';


  }


  


?>