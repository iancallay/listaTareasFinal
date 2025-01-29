<?php
// Incluir configuración externa
include('conexion.php');

// Configuración de encabezados para CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept');
header('Content-Type: application/json; charset=utf-8');

// Validar conexión a la base de datos
if (!$conection) {
    echo json_encode(array('estado' => false, 'mensaje' => 'Error de conexión a la base de datos.'));
    exit();
}

// Capturar datos JSON del cuerpo de la solicitud
$post = json_decode(file_get_contents("php://input"), true);

// Validar que la acción esté definida
if (!isset($post['action'])) {
    echo json_encode(array('estado' => false, 'mensaje' => 'Acción no especificada.'));
    exit();
}

// Acción: insertar tarea
if ($post['action'] == 'insertar') {
    if (!isset($post['titulo'], $post['descripcion'], $post['estado']) ||
        empty($post['titulo']) || empty($post['descripcion']) || empty($post['estado'])) {
        echo json_encode(array('estado' => false, 'mensaje' => 'Todos los campos son obligatorios.'));
        exit();
    }

    $titulo = mysqli_real_escape_string($conection, $post['titulo']);
    $descripcion = mysqli_real_escape_string($conection, $post['descripcion']);
    $estado = mysqli_real_escape_string($conection, $post['estado']);

    $sql_insert = "INSERT INTO tareas (titulo, descripcion, estado) VALUES ('$titulo', '$descripcion', '$estado')";

    if (mysqli_query($conection, $sql_insert)) {
        echo json_encode(array('estado' => true, 'mensaje' => 'Tarea insertada correctamente.'));
    } else {
        echo json_encode(array('estado' => false, 'mensaje' => 'Error al insertar la tarea: ' . mysqli_error($conection)));
    }
}

// Acción: eliminar tarea
elseif ($post['action'] == 'eliminar') {
    if (!isset($post['id']) || empty($post['id'])) {
        echo json_encode(array('estado' => false, 'mensaje' => 'El ID es obligatorio para eliminar.'));
        exit();
    }

    $id = mysqli_real_escape_string($conection, $post['id']);
    $sql_delete = "DELETE FROM tareas WHERE id = '$id'";

    if (mysqli_query($conection, $sql_delete)) {
        echo json_encode(array('estado' => true, 'mensaje' => 'Tarea eliminada correctamente.'));
    } else {
        echo json_encode(array('estado' => false, 'mensaje' => 'Error al eliminar la tarea: ' . mysqli_error($conection)));
    }
}

// Acción: actualizar tarea
elseif ($post['action'] == 'actualizar') {
    if (!isset($post['id'], $post['titulo'], $post['descripcion'], $post['estado']) ||
        empty($post['id']) || empty($post['titulo']) || empty($post['descripcion']) || empty($post['estado'])) {
        echo json_encode(array('estado' => false, 'mensaje' => 'Todos los campos son obligatorios para actualizar.'));
        exit();
    }

    $id = mysqli_real_escape_string($conection, $post['id']);
    $titulo = mysqli_real_escape_string($conection, $post['titulo']);
    $descripcion = mysqli_real_escape_string($conection, $post['descripcion']);
    $estado = mysqli_real_escape_string($conection, $post['estado']);

    $sql_update = "UPDATE tareas SET titulo = '$titulo', descripcion = '$descripcion', estado = '$estado' WHERE id = '$id'";

    if (mysqli_query($conection, $sql_update)) {
        echo json_encode(array('estado' => true, 'mensaje' => 'Tarea actualizada correctamente.'));
    } else {
        echo json_encode(array('estado' => false, 'mensaje' => 'Error al actualizar la tarea: ' . mysqli_error($conection)));
    }
}

// Acción: obtener tarea por ID
elseif ($post['action'] == 'tarea') {
    if (!isset($post['id']) || empty($post['id'])) {
        echo json_encode(array('estado' => false, 'mensaje' => 'El ID es obligatorio.'));
        exit();
    }

    $id = mysqli_real_escape_string($conection, $post['id']);
    $sql = "SELECT * FROM tareas WHERE id = '$id'";
    $query = mysqli_query($conection, $sql);

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        echo json_encode(array('estado' => true, 'tarea' => $row));
    } else {
        echo json_encode(array('estado' => false, 'mensaje' => 'No se encontró la tarea.'));
    }
}

// Acción: listar todas las tareas
elseif ($post['action'] == 'listar') {
    $sql = "SELECT * FROM tareas";
    $query = mysqli_query($conection, $sql);

    if (mysqli_num_rows($query) > 0) {
        $datos = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $datos[] = $row;
        }
        echo json_encode(array('estado' => true, 'tareas' => $datos));
    } else {
        echo json_encode(array('estado' => false, 'mensaje' => 'No hay tareas registradas.'));
    }
} else {
    echo json_encode(array('estado' => false, 'mensaje' => 'Acción no válida.'));
    exit();
}
?>