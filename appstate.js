$(document).ready(function(){
	$.ajax({
		url: "http://localhost/montpellierhorizon/chartjs/datastate.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var user = [];
			var nombre_n = [];

			for(var i in data) {
				user.push(" " + data[i].id_cat);
				nombre_n.push(data[i].nombre_n);
				nombre_n
			}

			var chartdata = {
				labels: user,
				datasets : [
					{
						label: 'STATISTIQUES:',
						backgroundColor: 'rgba(200, 200, 0, 0.75)',
                       
						borderColor: 'rgba(200, 0, 0, 0.75)',
						hoverBackgroundColor: 'rgba(0, 200, 200, 1)', 
						hoverBorderColor: 'rgba(200, 0, 200, 1)',
						data: nombre_n
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});