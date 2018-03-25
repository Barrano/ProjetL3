$(document).ready(function(){
	$.ajax({
		url: "http://localhost/montpellierhorizon/chartjs/dataresto.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var user = [];
			var restaurant_n = [];

			for(var i in data) {
				user.push("user " + data[i].nom_uti);
				restaurant_n.push(data[i].restaurant_n);
				restaurant_n
			}

			var chartdata = {
				labels: user,
				datasets : [
					{
						label: 'RESTAURANT',
						backgroundColor: 'rgba(200, 200, 0, 0.75)',
                       
						borderColor: 'rgba(200, 0, 0, 0.75)',
						hoverBackgroundColor: 'rgba(0, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 0, 200, 1)',
						data: restaurant_n
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