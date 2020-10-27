
  var idEliminar=0;
  var month=[];
  var totalSalesAmount=[];
  var monthsWithName=[];
  

  $(document).ready(function(){
    $.ajax({
      url: '/section/reports/SalesReports/salesreportsmonthly',
      method: 'POST',
      data:{ 
        id:1,
        _token: $('input[name="_token"]').val()
      }
  }).done(function(res){
      // alert(res);
      // alert('chegou aqui');
      // string to JSON
      var arreglo = JSON.parse(res);
      // alert(res);

      for(var x=0; x<arreglo.length; x++){
        // alert(10);
          console.log(arreglo);
          console.log(arreglo[x].id)
          console.log(arreglo[x].name)
          console.log(arreglo[x].SKU)
          console.log(arreglo[x].monthSales) 
          month.push(arreglo[x].monthSales);

            if(arreglo[x].monthSales == 1){
              monthsWithName.push('January')
            }
            else if(arreglo[x].monthSales == 2){
              monthsWithName.push('Feb')
            }
            else if(arreglo[x].monthSales == 3){
              monthsWithName.push('March')
            }
            else if(arreglo[x].monthSales == 4){
              monthsWithName.push('April')
            }
            else if(arreglo[x].monthSales == 5){
              monthsWithName.push('May')
            }
            else if(arreglo[x].monthSales == 6){
              monthsWithName.push('June')
            }
            else if(arreglo[x].monthSales == 7){
              monthsWithName.push('July')
            }
            else if(arreglo[x].monthSales == 8){
              monthsWithName.push('August')
            }
            else if(arreglo[x].monthSales == 9){
              monthsWithName.push('September')
            }
            else if(arreglo[x].monthSales == 10){
              monthsWithName.push('October')
            }
            else if(arreglo[x].monthSales == 11){
              monthsWithName.push('November')
            }
            else if(arreglo[x].monthSales == 12){
              monthsWithName.push('December')
          }
          totalSalesAmount.push(arreglo[x].totalSalesAmount);
       }
        generatePieChart();
     });
    });

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function generatePieChart(){
// Pie Chart Example
var ctx = document.getElementById("line-chart-earnings");
var lineChartEarnings = new Chart(ctx, {
  type: 'line',
  data: {
    labels: monthsWithName,
    datasets: [
    { 
      data:  totalSalesAmount,
      backgroundColor: ['#4e73df', '#1cc88a', '#59188f', '#4e73df', '#1cc88a', '#59188f', '#4e73df', '#1cc88a', '#59188f', '#4e73df', '#1cc88a', '#59188f'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }
    
  
  ],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
}