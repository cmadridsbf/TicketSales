<?php
// Incluye el archivo de conexión a la base de datos
require_once 'connection.php';
$eventoId = $_GET['eventoId']; // Obtiene el valor de eventoId desde la URL
$usuarioId = $_GET['usuarioId']; // Obtiene el valor de usuarioId desde la URL

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Función para obtener el número total de usuarios registrados
function getNumeroTotalUsuariosRegistrados()
{
    global $pdo;
    $sql = "SELECT COUNT(*) AS total_usuarios FROM usuarios";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

// Función para obtener la lista de todos los eventos programados
function getListaEventosProgramados()
{
    global $pdo;
    $sql = "SELECT * FROM eventos";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// Función para obtener la lista de todos los eventos por categoría
function getEventosPorCategoria()
{
    global $pdo;
    $sql = "SELECT categorias.nombre AS categoria, eventos.nombre AS evento
            FROM eventos
            JOIN categorias ON eventos.categoria_id = categorias.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function getNumeroRegistrosEventoEspecifico($eventoId)
{
    global $pdo;
    $sql = "SELECT COUNT(*) AS total_registros FROM registros WHERE paquete_id = :eventoId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':eventoId', $eventoId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function getRegistrosPorDia()
{
    global $pdo;
    $sql = "SELECT dias.nombre AS dia, registros.id AS registro_id, usuarios.nombre AS usuario
            FROM registros
            JOIN eventos ON registros.paquete_id = eventos.id
            JOIN dias ON eventos.dia_id = dias.id
            JOIN usuarios ON registros.usuario_id = usuarios.id
            ORDER BY dias.nombre, registros.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getNumeroRegistrosPorDia()
{
    global $pdo;
    $sql = "SELECT dias.nombre AS dia, COUNT(*) AS total_registros
            FROM registros
            JOIN eventos ON registros.paquete_id = eventos.id
            JOIN dias ON eventos.dia_id = dias.id
            GROUP BY dias.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getRegistrosPorHora()
{
    global $pdo;
    $sql = "SELECT horas.hora AS hora, registros.id AS registro_id, usuarios.nombre AS usuario
            FROM registros
            JOIN eventos ON registros.paquete_id = eventos.id
            JOIN horas ON eventos.hora_id = horas.id
            JOIN usuarios ON registros.usuario_id = usuarios.id
            ORDER BY horas.hora, registros.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getNumeroRegistrosPorHora()
{
    global $pdo;
    $sql = "SELECT horas.hora AS hora, COUNT(*) AS total_registros
            FROM registros
            JOIN eventos ON registros.paquete_id = eventos.id
            JOIN horas ON eventos.hora_id = horas.id
            GROUP BY horas.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getRegistrosPorPaquete()
{
    global $pdo;
    $sql = "SELECT eventos.nombre AS evento, registros.id AS registro_id, usuarios.nombre AS usuario
            FROM registros
            JOIN eventos ON registros.paquete_id = eventos.id
            JOIN usuarios ON registros.usuario_id = usuarios.id
            ORDER BY eventos.nombre, registros.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getNumeroRegistrosPorPaquete()
{
    global $pdo;
    $sql = "SELECT eventos.nombre AS evento, COUNT(*) AS total_registros
            FROM registros
            JOIN eventos ON registros.paquete_id = eventos.id
            GROUP BY eventos.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getRegistrosPorUsuario()
{
    global $pdo;
    $sql = "SELECT usuarios.nombre AS usuario, registros.id AS registro_id, eventos.nombre AS evento
            FROM registros
            JOIN usuarios ON registros.usuario_id = usuarios.id
            JOIN eventos ON registros.paquete_id = eventos.id
            ORDER BY usuarios.nombre, registros.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getEventosRegistradosPorUsuario($usuarioId)
{
    global $pdo;
    $sql = "SELECT eventos.nombre AS evento
            FROM registros
            JOIN eventos ON registros.paquete_id = eventos.id
            WHERE registros.usuario_id = :usuarioId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getTotalRegistrosPorUsuario()
{
    global $pdo;
    $sql = "SELECT usuarios.nombre AS usuario, COUNT(*) AS total_registros
            FROM registros
            JOIN usuarios ON registros.usuario_id = usuarios.id
            GROUP BY usuarios.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getNumeroRegistrosConRegalos()
{
    global $pdo;
    $sql = "SELECT COUNT(*) AS total_regalos FROM registros WHERE regalo_id IS NOT NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getEventosConPonentes()
{
    global $pdo;
    $sql = "SELECT eventos.nombre AS evento, ponentes.nombre AS ponente
            FROM eventos
            JOIN ponentes ON eventos.ponente_id = ponentes.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getNumeroRegistrosPorEvento()
{
    global $pdo;
    $sql = "SELECT eventos.nombre AS evento, COUNT(*) AS total_registros
            FROM registros
            JOIN eventos ON registros.paquete_id = eventos.id
            GROUP BY eventos.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getEventosPorCiudadYPais()
{
    global $pdo;
    $sql = "SELECT eventos.nombre AS evento, ponentes.ciudad, ponentes.pais
            FROM eventos
            JOIN ponentes ON eventos.ponente_id = ponentes.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getNumeroRegistrosPorCategoria()
{
    global $pdo;
    $sql = "SELECT categorias.nombre AS categoria, COUNT(*) AS total_registros
            FROM registros
            JOIN eventos ON registros.paquete_id = eventos.id
            JOIN categorias ON eventos.categoria_id = categorias.id
            GROUP BY categorias.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// Ejemplo de cómo llamar a las funciones y devolver los informes en JSON
$reportes = array(
    'total_usuarios' => getNumeroTotalUsuariosRegistrados(),
    'eventos_programados' => getListaEventosProgramados(),
    'eventos_por_categoria' => getEventosPorCategoria(),
    'registros_evento_especifico' => getNumeroRegistrosEventoEspecifico($eventoId),
    'registros_por_dia' => getRegistrosPorDia(),
    'numero_registros_por_dia' => getNumeroRegistrosPorDia(),
    'registros_por_hora' => getRegistrosPorHora(),
    'numero_registros_por_hora' => getNumeroRegistrosPorHora(),
    'registros_por_paquete' => getRegistrosPorPaquete(),
    'numero_registros_por_paquete' => getNumeroRegistrosPorPaquete(),
    'registros_por_usuario' => getRegistrosPorUsuario(),
    'eventos_registrados_por_usuario' => getEventosRegistradosPorUsuario($usuarioId),
    'total_registros_por_usuario' => getTotalRegistrosPorUsuario(),
    'numero_registros_con_regalos' => getNumeroRegistrosConRegalos(),
    'eventos_con_ponentes' => getEventosConPonentes(),
    'numero_registros_por_evento' => getNumeroRegistrosPorEvento(),
    'eventos_por_ciudad_y_pais' => getEventosPorCiudadYPais(),
    'numero_registros_por_categoria' => getNumeroRegistrosPorCategoria(),
);

header('Content-Type: application/json');
echo json_encode($reportes);
