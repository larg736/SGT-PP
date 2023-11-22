// Obtenemos el canvas del gráfico
var ctx = document.getElementById('usersBar').getContext('2d');
    
// Creamos la gráfica
var usersBar = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Usuarios registrados',
            data: [],
            backgroundColor:['rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
            borderColor: ['rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
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

// Función para filtrar los usuarios registrados por fechas
function filterUsersByDate() {
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();

    $.ajax({
        url: "/users-filter",
        type: "GET",
        data: { start_date: start_date, end_date: end_date },
        dataType: "json",
        success: function (data) {
            usersBar.data.labels = data.labels;
            usersBar.data.datasets[0].data = data.data;
            usersBar.update();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

// Llamamos a la función para filtrar los usuarios registrados al cargar la página
filterUsersByDate();

// Evento para el botón de filtrado
$('#filter').click(function () {
    filterUsersByDate();
});