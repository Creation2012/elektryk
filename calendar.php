<?php include 'top.php'; ?>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> --->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales-all.js"> </script>

 
  <script> 
  document.addEventListener('DOMContentLoaded', function() {
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
	lang: 'pl',
	locale: 'pl',
    editable:true,
    events: 'load.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
	var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
	var modal = document.getElementById("myModal");
	
	document.getElementById("Start").value = start;
	document.getElementById("End").value = end;
	
	modal.style.display = "block";
	
	var span = document.getElementsByClassName("close")[0];
	span.onclick = function() {
	  modal.style.display = "none";
	  calendar.fullCalendar('refetchEvents');	
	}
	  window.onclick = function(event) {
	  if (event.target == modal) {
		modal.style.display = "none";
		calendar.fullCalendar('refetchEvents');	
	  }
	}
	calendar.fullCalendar('refetchEvents');	

	},
	
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
	 var income = event.income;
	 var category = event.category;
     $.ajax({
      url:"update_calendar.php",
      type:"POST",
      data:{income:income, category:category, title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
		alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
	 var income = event.income;
	 var category = event.category;
     $.ajax({
      url:"update_calendar.php",
      type:"POST",
      data:{income:income, category:category, title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Zaktualizowano");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Chcesz usunąć ten projekt?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete_calendar.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Usunięto");
       }
      })
     }
    }
   });
  });
  });
  </script>
  
<div class="container-fluid" id="main-content">
		
<div class="col-lg-12">

  <div class="card shadow mb-4">
	<div class="card-header py-3">
	  <h6 class="m-0 font-weight-bold text-primary">Kalendarz</h6>
	</div>
	<div class="card-body">
		<div id="calendar">
		</div>
	</div>
  </div>

</div>
</div>

	
	<script>
	document.addEventListener('DOMContentLoaded', function() {
	$('#add').click(function(){
		alert("wykonuje");
		var title = $("#Name").val();
		var income = $("#Income").val();
		var category  = $("#Category").val();
		var start = $("#Start").val(); 
		var end = $("#End").val();
		  $.ajax({
		   url:"add_calendar.php",
		   type:"POST",
		   data:{title:title, income:income, category:category, start:start, end:end},
		   success:function()
		   {
			alert("Dodano");
			document.getElementById("#f_modal").reset();
		   }
		   
		 });
     });
	});
	</script>

<?php //include 'bottom.php'; ?>