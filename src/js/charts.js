(function() {
    const grafica = document.querySelector('#informes-grafica');
    if (grafica) {
        obtenerDatos();

        async function obtenerDatos() {
            try {
                const url = 'https://ticketsales.store/public/RestAPI/GetUser.php';
                const respuesta = await fetch(url);

                if (!respuesta.ok) {
                    throw new Error('Error al obtener datos de la API');
                }

                const usuarios = await respuesta.json();

                const confirmados = usuarios.filter(usuario => usuario.confirmado).length;
                const noConfirmados = usuarios.length - confirmados;

                const ctx = document.getElementById('informes-grafica').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Confirmados', 'No Confirmados'],
                        datasets: [{
                            label: '',
                            data: [confirmados, noConfirmados],
                            backgroundColor: [
                                '#ea580c',
                                '#84cc16'
                            ]
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });

               
            } catch (error) {
                console.error(error);
            }
        }
    }

  
})();