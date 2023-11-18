import { Html5QrcodeScanner } from "html5-qrcode";

let html5QrcodeScanner;

function onScanSuccess(decodedText, decodedResult) {
    // Verifica si la URL comienza con "https://ticketsales.store"
    if (decodedText.startsWith("https://ticketsales.store")) {
        // Parsea la URL para obtener los parámetros
        const url = new URL(decodedText);
        const id = url.searchParams.get("id");
        
        if (id) {
            // Cierra la cámara (detiene el escaneo)
            html5QrcodeScanner.clear();
            
            // Realiza una solicitud HTTP para obtener el JSON
            fetch(`https://ticketsales.store/public/RestAPI/getRegaloToken.php?token=${id}`)
                .then(response => response.json())
                .then(data => {
                    // Verifica el valor de "ingreso" en la respuesta
                    if (data.ingreso === 0) {
                        // Usuario no ha reclamado beneficios, muestra un alert personalizado
                        const confirmar = confirm(
                            `Nombre: ${data.nombre}\nApellido: ${data.apellido}\nRegalo: ${data.regalo}\n\n` +
                            "¿Confirmar que el usuario asistió y se le dio sus beneficios?"
                        );
                        
                        if (confirmar) {
                            fetch(`https://ticketsales.store/public/RestAPI/setAsistenciaRegalo.php?token=${id}`)
                            .then(response => response.json())
                            .then(result => {
                                if (result.actualizado === "1") {
                                    // Si actualizado es 1, mostrar una alerta de éxito y recargar la página
                                    alert("Los beneficios recibidos fueron registrados con éxito");
                                    location.reload();
                                } else {
                                    // Si actualizado no es 1, mostrar una alerta de error
                                    alert("Error al registrar los beneficios obtenidos");
                                    location.reload();
                                }
                            })
                            .catch(error => {
                                // Manejar errores de la solicitud
                                console.error("Error de solicitud:", error);
                            });
                            // Recargar la página
                            //location.reload();
                        } else {
                            // Si se hace clic en "Cancelar", recargar la página
                            //location.reload();
                        }
                    } else if (data.ingreso === 1) {
                        // Usuario ya reclamó beneficios, muestra un alert con mensaje diferente
                        const alerta = alert("El usuario ya reclamó sus beneficios");
                        
                        // Agrega un botón "Aceptar" para recargar la página
                        if (alerta) {
                            location.reload();
                        }
                    } else {
                        // Valor de "ingreso" no reconocido
                        console.error("Valor de 'ingreso' no válido en la respuesta.");
                    }
                })
                .catch(error => {
                    console.error("Error al obtener datos: " + error);
                });
        } else {
            console.error("No se encontró el parámetro 'id' en la URL.");
        }
    } else {
        console.error("QR no válido: La URL no comienza con 'https://ticketsales.store'.");
    }
}

function onScanFailure(error) {
    // Handle on scan failure condition.
    console.error(`Code scan error = ${error}`);
}

html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });

html5QrcodeScanner.render(onScanSuccess, onScanFailure);



document.getElementById('btnQr').addEventListener('click', function() {
    const tokenid = prompt("Ingresa el token del boleto:");

    if (tokenid) {
        fetch(`https://ticketsales.store/public/RestAPI/getRegaloToken.php?token=${tokenid}`)
                .then(response => response.json())
                .then(data => {
                    // Verifica el valor de "ingreso" en la respuesta
                    if (data.ingreso === 0) {
                        // Usuario no ha reclamado beneficios, muestra un alert personalizado
                        const confirmar = confirm(
                            `Nombre: ${data.nombre}\nApellido: ${data.apellido}\nRegalo: ${data.regalo}\n\n` +
                            "¿Confirmar que el usuario asistió y se le dio sus beneficios?"
                        );
                        
                        if (confirmar) {
                            fetch(`https://ticketsales.store/public/RestAPI/setAsistenciaRegalo.php?token=${tokenid}`)
                            .then(response => response.json())
                            .then(result => {
                                if (result.actualizado === "1") {
                                    // Si actualizado es 1, mostrar una alerta de éxito y recargar la página
                                    alert("Los beneficios recibidos fueron registrados con éxito");
                                    // location.reload();
                                } else {
                                    // Si actualizado no es 1, mostrar una alerta de error
                                    alert("Error al registrar los beneficios obtenidos");
                                    // location.reload();
                                }
                            })
                            .catch(error => {
                                // Manejar errores de la solicitud
                                console.error("Error de solicitud:", error);
                            });
                            // Recargar la página
                            //location.reload();
                        } else {
                            // Si se hace clic en "Cancelar", recargar la página
                            //location.reload();
                        }
                    } else if (data.ingreso === 1) {
                        // Usuario ya reclamó beneficios, muestra un alert con mensaje diferente
                        const alerta = alert("El usuario ya reclamó sus beneficios");
                        // location.reload();
                        // Agrega un botón "Aceptar" para recargar la página
                        if (alerta) {
                            // location.reload();
                        }
                    } else {
                        // Valor de "ingreso" no reconocido
                        console.error("Valor de 'ingreso' no válido en la respuesta.");
                    }
                })
                .catch(error => {
                    console.error("Error al obtener datos: " + error);
                });
    } else {
        alert("No se ingresó ningún token.");
    }
});