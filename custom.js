$(document).ready(function() {
    $('.push_menu').click(function() {
        $(".wrapper").toggleClass("active");
    });
    $('.menu a').click(function() {
        $('.menu a').not(this).removeClass('active');
        $(this).toggleClass('active');
        
    });
   
});




function check() {
    if(document.getElementById('password').value ===
            document.getElementById('confirmpassword').value) {
        document.getElementById('message');
        $('#register').prop('disabled', false);
    } else {
        document.getElementById('message').innerHTML = "Password&Confirm Password Not Matching";
        $('#register').prop('disabled', true);
    }
  }


document.addEventListener("DOMContentLoaded", function() {
    var dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            var submenu = this.nextElementSibling;
            submenu.classList.toggle('show-submenu');
        });
    });
});


$(document).ready(function() {
    $('#Table.table').DataTable();
});




  

    







  


  


  
