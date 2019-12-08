function getSearchParameters() {
      var prmstr = window.location.search.substr(1);
      return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
}

function transformToAssocArray( prmstr ) {
    var params = {};
    var prmarr = prmstr.split("&");
    for ( var i = 0; i < prmarr.length; i++) {
        var tmparr = prmarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    return params;
}

document.addEventListener('DOMContentLoaded', function() {
	$('#add').click(function(){
		var title = $("#Name").val();
		var category  = $("#Category").val();
		var desc = $("#Desc").val(); 
		var worker = $("#Pracownik").val();
		var handler = getSearchParameters();
		var project = handler['id'];
		$("#Name, #Category").removeClass("border-danger border-warning");
		if(title == "")
			$('#Name').addClass("border-danger");
		else if(category == "")
			$('#Category').addClass("border-danger");
		else{
		  $.ajax({
		   url:"additionalPHP/add_task.php",
		   type:"POST",
		   data:{title:title, category:category, desc:desc, worker:worker, project:project},
		   success:function(data)
		   {
			   var task = data;
			   console.log(task);
			  $.ajax({
                type: "post",
                url: "additionalPHP/add_handler.php",
                data: {project:project, task:task, worker:worker},
                success: function (data) {
					alert("Dodano");
					$('#add_task').val('');
                }
            });
		   }
	})};
     });
	});