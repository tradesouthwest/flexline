/* @package flexline 
@param id="nav_mobi" class="nav-button Button
nav-wrapper #mobile_menu style="display: flex"
*/
    //document.getElementById("nav_mobi").addEventListener('click', openMenu );
    function openMenu(){
    
        var opv = document.getElementById("nav_mobi").value;
        var men = document.getElementById("mobile_menu");
        
        if( '' != opv ) {
            if ( men.style.display === "flex" ) {
                men.style.display = "none";
            } else {
                men.style.display = "flex";
            }
        }
    
    return false;
  }
