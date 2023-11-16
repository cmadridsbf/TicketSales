(function() {
    const masVendido = document.querySelector('#informes-grafica-mas-vendido');
    const graficaUsuariosConfirmados = document.querySelector('#informes-grafica-usuarios-confirmados');
    if (masVendido) {
        obtenerDatos();

        async function obtenerDatos() {
            try {
                const url = 'https://ticketsales.store/public/RestAPI/GetRegistros.php';
                const respuesta = await fetch(url);

                if(!respuesta.ok) {
                    throw new Error('Error al obtener datos de la API');
                }

                const registros = await respuesta.json();

                let gananciasPresencial = registros.filter(registro => registro.paquete_id == 1).length * 199;
                let gananciasVirtual = registros.filter(registro => registro.paquete_id == 2).length * 49;

                const data = {
                    labels: [
                        'Presencial',
                        'Virtual'
                    ],
                    datasets: [{
                        data: [gananciasPresencial, gananciasVirtual],
                        backgroundColor: [
                            '#FF6384',
                            '#36A2EB'
                        ],
                        hoverBackgroundColor: [
                            '#FF6384',
                            '#36A2EB'
                        ]
                    }]
                };

                const ctx = document.getElementById('informes-grafica-mas-vendido').getContext('2d');
                const myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Ganancias'
                            }
                        }
                    },
                });

               
            } catch (error) {
                console.error(error);
            }
        }
    }
    
    if (graficaUsuariosConfirmados) {
        obtenerDatos1();

        async function obtenerDatos1() {
            try {
                const url = 'https://ticketsales.store/public/RestAPI/GetUser.php';
                const respuesta = await fetch(url);

                if (!respuesta.ok) {
                    throw new Error('Error al obtener datos de la API');
                }

                const usuarios = await respuesta.json();

                const confirmados = usuarios.filter(usuario => usuario.confirmado).length;
                const noConfirmados = usuarios.length - confirmados;

                const ctx = document.getElementById('informes-grafica-usuarios-confirmados').getContext('2d');
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
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Usuarios'
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