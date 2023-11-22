// Obtenemos el canvas del gráfico
var ctx = document.getElementById('demandsBar').getContext('2d');
    
// Creamos la gráfica
var demandsBar = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Tareas registrados',
            data: [],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 0.2)',
            borderWidth: 1
        }]
    },
    options: {
        /* scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        } */
    }
});



// Función para filtrar 
function filterDemandsByDateBar() {
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
 
    $.ajax({
        url: "/demands-filter",
        type: "GET",
        data: { start_date: start_date, end_date: end_date },
        dataType: "json",
        success: function (data) {
            demandsBar.data.labels = data.labels;
            demandsBar.data.datasets[0].data = data.data;
            demandsBar.update();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

// Llamamos a la función para filtrar 
filterDemandsByDateBar();
 
// Evento para el botón de filtrado
$('#filter').click(function () {
    filterDemandsByDateBar();
});