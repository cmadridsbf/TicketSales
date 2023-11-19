import { jsPDF } from "jspdf";
import "jspdf-autotable";

document.getElementById('rptUsuariosRegistrados').addEventListener('click', function() {
    obtenerUsuarios();
});

document.getElementById('rptUsuariosRegistradosConfirmados').addEventListener('click', function() {
    obtenerUsuariosConfirmados();
});

document.getElementById('rptRegalosEscogidos').addEventListener('click', function() {
    obtenerRegalos();
});

document.getElementById('rptPonentes').addEventListener('click', function() {
    obtenerPonentes();
});

document.getElementById('rptConferencias').addEventListener('click', function() {
    obtenerConferencia();
});
document.getElementById('rptBitacora').addEventListener('click', function() {
    const fechaInicio = prompt('Ingrese la Fecha Inicial (YYYY-MM-DD):');
    const fechaFin = prompt('Ingrese la Fecha Final (YYYY-MM-DD):');

    // Confirmación para el tipo de evento
    const esPresencial = confirm('¿El evento es Presencial?');
    const esVirtual = !esPresencial && confirm('¿El evento es Virtual?');
    // Si no es ni presencial ni virtual, se asume que es gratis.

    // Determinar el tipo de evento basado en las respuestas
    let tipoEvento;
    if (esPresencial) {
        tipoEvento = 1; // Presencial
    } else if (esVirtual) {
        tipoEvento = 2; // Virtual
    } else {
        tipoEvento = 3; // Gratis
    }

    // Mostrar los resultados
    alert(`Fecha Inicial: ${fechaInicio}\nFecha Final: ${fechaFin}\nTipo de Evento: ${tipoEvento}`);

    //obtenerBitacora();
});

async function obtenerUsuarios() {
    try {
        // Obtener datos de la API
        const response = await fetch('https://ticketsales.store/public/RestAPI/GetUser.php');
        const usuarios = await response.json();

        // Crear instancia de jsPDF
        const doc = new jsPDF();

        // Título del documento
        doc.text('Reporte de Usuarios', 10, 10);

        // Crear las cabeceras de la tabla
        const cabeceras = [['Nombre', 'Apellido', 'Correo']];

        // Extraer los datos necesarios del JSON
        const datos = usuarios.map(u => [u.nombre, u.apellido, u.email]);

        // Agregar la tabla al documento
        doc.autoTable({
            head: cabeceras,
            body: datos,
            startY: 20,
            styles: { font: 'times', fontSize: 11 },
            headStyles: { fillColor: [22, 160, 133] },
            margin: { top: 30 }
        });

        // Guardar el PDF generado
        doc.save('reporte-usuarios.pdf');
    } catch (error) {
        console.error('Error al obtener datos:', error);
    }
}

async function obtenerUsuariosConfirmados() {
    try {
        // Obtener datos de la API
        const response = await fetch('https://ticketsales.store/public/RestAPI/GetUser.php');
        const usuarios = await response.json();

        // Filtrar solo los usuarios confirmados
        const usuariosConfirmados = usuarios.filter(u => u.confirmado === 1);

        // Crear instancia de jsPDF
        const doc = new jsPDF();

        // Título del documento
        doc.text('Reporte de Usuarios Confirmados', 10, 10);

        // Crear las cabeceras de la tabla
        const cabeceras = [['Nombre', 'Apellido', 'Correo']];

        // Extraer los datos necesarios del JSON
        const datos = usuariosConfirmados.map(u => [u.nombre, u.apellido, u.email]);

        // Agregar la tabla al documento
        doc.autoTable({
            head: cabeceras,
            body: datos,
            startY: 20,
            styles: { font: 'times', fontSize: 11 },
            headStyles: { fillColor: [22, 160, 133] },
            margin: { top: 30 }
        });

        // Guardar el PDF generado
        doc.save('reporte-usuarios-confirmados.pdf');
    }catch (error) {
        console.error('Error al obtener datos:', error);
    }
}

async function obtenerRegalos() {
    try {
        // Obtener datos de la API
        const response = await fetch('https://ticketsales.store/public/RestAPI/GetRegistros.php');
        const registros = await response.json();

        // Obtener datos de la relación entre regalo_id e id de regalo
        const responseRegalos = await fetch('https://ticketsales.store/public/RestAPI/GetRegalos.php');
        const regalos = await responseRegalos.json();
        const regalosPorId = regalos.reduce((acc, regalo) => {
            acc[regalo.id] = regalo.nombre;
            return acc;
        }, {});

        // Contar registros por regalo_id
        const conteoRegalos = {};
        registros.forEach(registro => {
            const regaloId = registro.regalo_id;
            if (conteoRegalos[regaloId]) {
                conteoRegalos[regaloId]++;
            } else {
                conteoRegalos[regaloId] = 1;
            }
        });

        // Crear instancia de jsPDF
        const doc = new jsPDF();

        // Título del documento
        doc.text('Reporte de Regalos', 10, 10);

        // Crear las cabeceras de la tabla
        const cabeceras = [['Regalo', 'Cantidad']];

        // Extraer los datos necesarios del conteo
        const datos = Object.entries(conteoRegalos).map(([regaloId, cantidad]) => [regalosPorId[regaloId], cantidad]);

        // Agregar la tabla al documento
        doc.autoTable({
            head: cabeceras,
            body: datos,
            startY: 20,
            styles: { font: 'times', fontSize: 11 },
            headStyles: { fillColor: [22, 160, 133] },
            margin: { top: 30 }
        });

        // Guardar el PDF generado
        doc.save('reporte-regalos.pdf');
    } catch (error) {
        console.error('Error al obtener datos:', error);
    }
}

async function obtenerPonentes() {
    try {
        // Obtener datos de la API
        const response = await fetch('https://ticketsales.store/public/RestAPI/GetPonentes.php');
        const ponentes = await response.json();

        // Crear instancia de jsPDF
        const doc = new jsPDF();

        // Título del documento
        doc.text('Reporte de Ponentes', 10, 10);

        // Crear las cabeceras de la tabla
        const cabeceras = [['Nombre', 'Apellido', 'Ciudad', 'País']];

        // Extraer los datos necesarios del JSON
        const datos = ponentes.map(ponente => [ponente.nombre, ponente.apellido, ponente.ciudad, ponente.pais]);

        // Agregar la tabla al documento
        doc.autoTable({
            head: cabeceras,
            body: datos,
            startY: 20,
            styles: { font: 'times', fontSize: 11 },
            headStyles: { fillColor: [22, 160, 133] },
            margin: { top: 30 }
        });

        // Guardar el PDF generado
        doc.save('reporte-ponentes.pdf');
    }catch (error) {
        console.error('Error al obtener datos:', error);
    }
}

async function obtenerConferencia() {
    try {
        // Obtener datos de la API
        const response = await fetch('https://ticketsales.store/public/RestAPI/GetEventos.php');
        const eventos = await response.json();

        // Crear instancia de jsPDF
        const doc = new jsPDF();

        // Título del documento
        doc.text('Reporte de Eventos', 10, 10);

        // Crear las cabeceras de la tabla
        const cabeceras = [['Nombre', 'Descripción', 'Asientos Disponibles']];

        // Extraer los datos necesarios del JSON
        const datos = eventos.map(evento => [evento.nombre, evento.descripcion, evento.disponibles]);

        // Agregar la tabla al documento
        doc.autoTable({
            head: cabeceras,
            body: datos,
            startY: 20,
            styles: { font: 'times', fontSize: 11 },
            headStyles: { fillColor: [22, 160, 133] },
            margin: { top: 30 }
        });

        // Guardar el PDF generado
        doc.save('reporte-eventos.pdf');
    }catch (error) {
        console.error('Error al obtener datos:', error);
    }
}
