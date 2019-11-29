<!DOCTYPE html>
<html lang='pl'>
  <head>
    <meta charset='utf-8' />

    <link href='fullcalendar/packages/core/main.css' rel='stylesheet' />
    <link href='fullcalendar/packages/daygrid/main.css' rel='stylesheet' />

    <script src='fullcalendar/packages/core/main.js'></script>
    <script src='fullcalendar/packages/daygrid/main.js'></script>
	<script src='fullcalendar/packages/core/locales/pl.js'></script>

   
	
	
	
  </head>
  <body>
	<div class="container-fluid">
    <div id='calendar'></div>
	</div>
	
 <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: [ 'dayGrid' ],
			lang: 'pl',
			editable: true,
			events: 'load.php'
        });
		
        calendar.render();
      });

    </script>
	
  </body>
</html>