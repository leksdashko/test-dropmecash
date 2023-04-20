jQuery(document).ready(function($){
    
    
    const btns = document.querySelectorAll('form .input');
for (const btn of btns) {
  btn.addEventListener('click', function() {

    btn.classList.add("has-value");
    
   // if($('form .input').val()){
   //      btn.classList.add("xuy-value");
   // }
    
  });
}


   
    });
