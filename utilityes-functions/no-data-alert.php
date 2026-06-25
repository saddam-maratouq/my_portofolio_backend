

<?php 

function showNoRecordsMessage() {

 $msg = 
    '
    <h2 style="text-align:center; display: flex; align-items: center; justify-content: center; gap: 10px;">
    <i class="material-icons"></i>
    No Data Available Yet
   </h2>
   ' ;

   return $msg ;

   // you can dynamic icon if you want depend on page as argument  <i class="material-icons">$iconName</i>

}
