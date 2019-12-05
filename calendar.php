<?php include 'top.php'; ?>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales-all.js"> </script>

	<style>
	/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: absolute; /* Stay in place */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 25%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  text-align: right;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.fc-content{
	color: white;
}
	</style>
	
 <div id="myModal" class="modal">
			  <!-- Modal content -->
			  <div class="modal-content">
				<span class="close">&times;</span>
				<form name="f_modal" class="col-lg-12">
					<div class="form-group">
						<label for="exampleFormControlInput1">Nazwa projektu:</label>
						<input type="text" class="form-control" id="Name" placeholder="Wprowadź nazwę projektu" required>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Kategoria:</label>
						<select class="form-control" id="Category" required>
						<option value=""> Wybierz </option>
						  <?php 
							$stmt = $pdo->query('SELECT category_id, category_name FROM category');
							foreach($stmt as $row)
							{
								echo '<option value='.$row['category_id'].'>'. $row['category_name'] .'</option>';
							}
							
							$stmt->closeCursor();
							
						  ?>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Wartość:</label>
						<input type="text" class="form-control" id="Income" placeholder="Wprowadź wartość projektu" required>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Start:</label>
						<input type="datetime" class="form-control" id="Start" placeholder="data" required>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Deadline:</label>
						<input type="datetime" class="form-control" id="End" placeholder="data" required>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Ilość pracowników:</label>
						<input type="number" min="0" class="form-control" id="Max" placeholder="Wprowadź ilość pracowników" required>
					</div>
					<input type="button" id="add" class="btn btn-primary mb-2" value="Dodaj">
				</form>
			  </div>
  </div>
 
  <script> 
  document.addEventListener('DOMContentLoaded', function() {
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
	plugins: ['dayGrid'],
	lang: 'pl',
	locale: 'pl',
    editable:true,
    events: 'load.php',
	firstDay: 1,
	displayEventTime : false,
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
		var title = $("#Name").val();
		var income = $("#Income").val();
		var category  = $("#Category").val();
		var start = $("#Start").val(); 
		var end = $("#End").val();
		var max = $("#Max").val();
		  $.ajax({
		   url:"add_calendar.php",
		   type:"POST",
		   data:{title:title, income:income, category:category, start:start, end:end, max:max},
		   success:function()
		   {
			alert("Dodano");
			document.getElementById("#f_modal").reset();
		   }
		   
		 });
     });
	});
	
	$('.dropdown').click(function(){
		if($(this).hasClass('show')){
			$(this).removeClass('show');
			$(this).children('a').attr('aria-expanded','false');
			$(this).children('div').removeClass('show');
		}
		else{
			$(this).addClass('show');
			$(this).children('a').attr('aria-expanded','true');
			$(this).children('div').addClass('show');
		}
	});
	</script>
 <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Wykonał Bartosz Ostrowski i Arkadiusz Kojtek z wykorzystaniem SB ADMIN 2</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  
  <!-- Custom javascript script-->
  <script src="js/mainsite.js"></script>
  <script src="js/admincontrol.js"></script>
<?php //include 'bottom.php'; ?>