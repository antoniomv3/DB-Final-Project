function navBarDrop(){
   document.getElementById("myDrop").classList.toggle("show");
   window.onclick = function(event){
      if(!event.target.matches(".dropButton")){
         var dropdowns = document.getElementsByClassName("drop-content");
         var i;
         var openDropDown;
         for(i = 0; i < dropdowns.length; i+=1) {
            openDropDown = dropdowns[i];
            if (openDropDown.classList.contains('show')){
               openDropDown.classList.remove('show');
            }
         }
      }
   };
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
   
   $(".editIcon").hover(
      function(){$(this).parent().parent().parent().addClass("table-warning");},
      function(){$(this).parent().parent().parent().removeClass("table-warning");}
   );
   
   $(".editIcon").click(function(){
      event.preventDefault;
      $id = $(this).parent().parent().parent().children().children().html();
      var form = '<form id="editForm" action="index.php" method="post"><input type="hidden" name="action" value="editStudent"><input type="hidden" name="StudentID" value="' +$id+'"></form>';
      $(".hiddenSubmitDiv").html(form);
      $("#editForm").submit();
   });
   
   $(".deleteIcon").hover(
      function(){$(this).parent().parent().parent().addClass("table-danger");},
      function(){$(this).parent().parent().parent().removeClass("table-danger");}
   );
   
   $(".deleteIcon").click(function(){
      event.preventDefault();
      $id = $(this).parent().parent().parent().children().children().html();
      $last = $(this).parent().parent().parent().find("td.lastName").html();
      $first = $(this).parent().parent().parent().find("td.firstName").html();
      var form = '<form id="deleteForm" action="index.php" method="post"><input type="hidden" name="action" value="deleteStudent"><input type="hidden" name="StudentID" value="' +$id+'"></form>';
      $(".hiddenSubmitDiv").html(form);
      $(".modal-title").html($first + ' ' + $last + ' - ' + $id);
      $("#myModal").modal('toggle');
   });
   
   $(".submitDelete").click(function(){
      $("#deleteForm").submit();
   });
  
   $(".studentSelect").hover(
      function(){$(this).parent().parent().addClass("table-success");},
      function(){$(this).parent().parent().removeClass("table-success");}
   );
   
   $(".studentSelect").click(function(){
      event.preventDefault();
      $id = $(this).html();
      var form = '<form id="studentSelectForm" action="index.php" method="post"><input type="hidden" name="action" value="selectStudent"><input type="hidden" name="StudentID" value="' +$id+'"></form>';
      $(".hiddenSubmitDiv").html(form);
      $("#studentSelectForm").submit();
   });
   
   $(".backIcon").click(function(){
      event.preventDefault();
      var form = '<form id="masterStudentForm" action="index.php" method="get"><input type="hidden" name="nav" value="view"></form>';
      $(".hiddenSubmitDiv").html(form);
      $("#masterStudentForm").submit();
   });
   
   $(".editIconInner").click(function(){
      event.preventDefault();
      $id = $("#innerStudentID").html();
      var form = '<form id="masterStudentForm" action="index.php" method="post"><input type="hidden" name="action" value="editStudent"><input type="hidden" name="StudentID" value="' +$id+'"></form>';
      $(".hiddenSubmitDiv").html(form);
      $("#masterStudentForm").submit();
   });
});