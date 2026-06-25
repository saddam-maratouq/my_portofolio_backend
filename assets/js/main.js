


// this function event for redrict to page based on text search input // 


let searchTextInput = document.getElementById('searchInput') 


function searchPageRedirect(e) {
      e.preventDefault() ; 
      let searchInputValue = searchTextInput.value.trim().toLowerCase() ;

     

switch (searchInputValue) {
    case 'users':
      window.location.href = "../../examples/users/view-users.php";
      break;
    case 'snacks':
      window.location.href = "../../examples/snaks/view-snaks.php";
      break;
    case 'burgers':
      window.location.href = "../../examples/burgers/view-about.php";
      break;
    case 'order details':
    case 'order' :  
      window.location.href = "../../examples/orders-history/orders-details.php";
      break;
    default:
     window.location.href = "../../examples/404-page/no-page.php";
  }
  
}

  searchTextInput.value = ""


  //  



    
function submitFormStop(e) {
  alert('inside preventt')
      e.preventDefault();
}


 