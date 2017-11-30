function navBarDrop(){
   document.getElementById("myDrop").classList.toggle("show");
   window.onclick = function(event){
      if(!event.target.matches('.dropButton')){
         var dropdowns = document.getElementsByClassName("drop-content");
         var i;
         for(i = 0; i < dropdowns.length; i++) {
            var openDropDown = dropdowns[i];
            if (openDropDown.classList.contains('show')){
               openDropDown.classList.remove('show');
            }
         }
      }
   }
}

$(document).ready(function(){
   $("#loadButton").click(function(){
      $.post(
      "index.php",
      {action: 'ajaxRequest'},
      function(response, status){
         $("#videoDiv").html(response);
      });
   });
});