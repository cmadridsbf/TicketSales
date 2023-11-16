import { jsPDF } from "jspdf";
import "jspdf-autotable"; // Importa la extensión de autotable

document.getElementById('añadirPonenteBtn').addEventListener('click', function() {
    genPDF();
});

function genPDF() {
    // Crear instancia de jsPDF
    const doc = new jsPDF();

    // Título del documento
    doc.text('Reporte de Usuarios', 10, 10);

    // Suponiendo que los datos de los usuarios provienen de tu API
    const usuarios = [
        { nombre: 'Juan', apellido: 'Pérez', email: 'juan.perez@example.com' },
        { nombre: 'Ana', apellido: 'Gómez', email: 'ana.gomez@example.com' },
        // ... otros usuarios
    ];

    // Crear las cabeceras de la tabla
    const cabeceras = [['Nombre', 'Apellido', 'Email']];
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
}
