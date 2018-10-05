$(document).ready(function() {
		var iC = document.getElementById("incomeChart");
		var n1,n2,n3,n4,n5,n6,n7,n8,n9,n10,n11,n12;
		n1 = $("#n01").text();
		n2 = $("#n02").text();
		n3 = $("#n03").text();
		n4 = $("#n04").text();
		n5 = $("#n05").text();
		n6 = $("#n06").text();
		n7 = $("#n07").text();
		n8 = $("#n08").text();
		n9 = $("#n09").text();
		n10 = $("#n10").text();
		n11 = $("#n11").text();
		n12 = $("#n12").text();
		var incomeChart = new Chart(iC, {
		    type: 'bar',
		    data: {
		        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun","July","Aug","Sep","Oct","Nov","Dec"],
		        datasets: [{
		            label: 'Income Chart of 2017',
		            data: [n1, n2, n3, n4, n5, n6, n7, n8, n9, n10, n11, n12],
		            backgroundColor: [
		                'rgba(0, 155, 119,0.7)',
		                'rgba(149, 82, 81,0.7)',
		                'rgba(214, 80, 118,0.7)',
		                'rgba(239, 192, 80,0.7)',
		                'rgba(91, 94, 166,0.7)',
		                'rgba(128,128,0,0.7)',
		                'rgba(188, 36, 60,0.7)',
		                'rgba(128,0,128,0.7)',
		                'rgba(255,153,18,0.7)',
		                'rgba(0,201,87,0.7)',
		                'rgba(14, 33, 5,0.7)',
		                'rgba(0,78,89,0.7)'
		            ]
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        },
		        animation: {
		        	duration: 5000
		        }
		    }
		});

		var eC = document.getElementById("expenseChart");
		var e1,e2,e3,e4,e5,e6,e7,e8,e9,e10,e11,e12;
		e1 = $("#e01").text();
		e2 = $("#e02").text();
		e3 = $("#e03").text();
		e4 = $("#e04").text();
		e5 = $("#e05").text();
		e6 = $("#e06").text();
		e7 = $("#e07").text();
		e8 = $("#e08").text();
		e9 = $("#e09").text();
		e10 = $("#e10").text();
		e11 = $("#e11").text();
		e12 = $("#e12").text();
		var expenseChart = new Chart(eC, {
		    type: 'line',
		    data: {
		        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun","July","Aug","Sep","Oct","Nov","Dec"],
		        datasets: [{
		            label: 'Expense Chart of 2017',
		            data: [e1, e2, e3, e4, e5, e6, e7, e8, e9, e10, e11, e12],
		            backgroundColor: [
		                'rgba(188, 36, 60,0.7)',
		                'rgba(128,0,128,0.7)',
		                'rgba(149, 82, 81,0.7)',
		                'rgba(214, 80, 118,0.7)',
		                'rgba(239, 192, 80,0.7)',		                
		                'rgba(128,128,0,0.7)',
		                'rgba(14, 33, 5,0.7)',		                
		                'rgba(0, 155, 119,0.7)',
		                'rgba(255,153,18,0.7)',
		                'rgba(0,201,87,0.7)',
		                'rgba(91, 94, 166,0.7)',
		                'rgba(0,78,89,0.7)'
		            ]
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        },
		        animation: {
		        	duration: 5000
		        }
		    }
		});
	});