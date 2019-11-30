 document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: [ 'interaction', 'dayGrid'],
			defaultView: 'dayGridMonth',
			selectable: true,
			editable: true,
			locale: 'pl',
			themeSystem: "jquery-ui",
			header:{
				center: 'title',
				left: ''
			},
			events: 'load.php',
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay)
			{
				var title = prompt("Wprowadź tytuł");
				if(title)
				{
						var start = $.fullCalendar.dateFormat(start, "YYYY-MM-DDHH:mm:ss");
						var end = $.fullCalendar.dateFormat(end,"YYYY-MM-DDHH:mm:ss");
						$.ajax({
							url:"add_calendar.php",
							type:"POST",
							data:{title:title, start:start, end:end},
							success:function()
							{
								calendar.fullCalendar('refetchEvents');
								alert("Udało się dodać!");
							}
						})
				}
			},
        });
		
        calendar.render();
      });