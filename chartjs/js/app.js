$(document).ready(function(){
	$.ajax({
		url: '/data.php?lang=' + ER_Locale.lang+'',
		method: "GET",
		success: function(data) {
			console.log(data);
			
			var faculty = [];
			var avg_faculty = [];
			
			for(var i in data) {
				faculty.push(" " + data[i].facultyNameKZ);
				avg_faculty.push(data[i].avg_faculty);
			}
			
			var chartdata = {
				labels: faculty,
				datasets : [
					{
						label: ER_Locale.get('Факультеттің орта балы'),
						backgroundColor: 'rgba(222, 115, 0, 1)',
						borderColor: 'rgba(252, 252, 252, 1)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: avg_faculty
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