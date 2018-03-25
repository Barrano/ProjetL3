$(document).ready(function(){
	$.ajax({
		url: "http://localhost/montpellierhorizon/chartjs/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var user = [];
			var boite_n = [];

			for(var i in data) {
				user.push("user " + data[i].nom_uti);
				boite_n.push(data[i].boite_n);
				boite_n
			}

			var chartdata = {
				labels: user,
				datasets : [
					{
						label: 'BOITE DE NUIT',
						backgroundColor: 'rgba(200, 200, 0, 0.75)',
                       
						borderColor: 'rgba(200, 0, 0, 0.75)',
						hoverBackgroundColor: 'rgba(0, 200, 200, 1)', 
						hoverBorderColor: 'rgba(200, 0, 200, 1)',
						data: boite_n
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