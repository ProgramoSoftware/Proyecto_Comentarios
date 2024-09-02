<?php
include 'config.php';
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['USUARIO_ID'])) {
    header("Location: ../vista/iniciosesion.html");
    exit();
}

// Manejar la acción de agregar comentario
if (isset($_POST['comentar'])) {
    $comentario = $conexion->real_escape_string($_POST['comentario']);
    $usuario_id = $_SESSION['USUARIO_ID'];
    $reply_id = $_POST['reply_id'] ?? NULL; // Debe ser NULL si no hay respuesta

    // Reemplazar NULL con una cadena vacía si la base de datos no acepta NULL
    $reply_id = $reply_id === '' ? NULL : $reply_id;

    $query = "INSERT INTO comentarios (comentario, usuario_id, reply) VALUES ('$comentario', '$usuario_id', " . ($reply_id ? "'$reply_id'" : "NULL") . ")";
    $result = $conexion->query($query);

    if (!$result) {
        echo "<p>Error al insertar comentario: " . $conexion->error . "</p>";
    }
}

// Obtener los comentarios principales (sin respuesta)
$query = "SELECT * FROM comentarios WHERE reply IS NULL ORDER BY fecha DESC";
$result = $conexion->query($query);

if (!$result) {
    echo "<p>Error al obtener comentarios: " . $conexion->error . "</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">

    <title>Sistema de Comentarios</title>
    <script>
        function toggleReplyForm(id) {
            const form = document.getElementById('reply-form-' + id);
            if (form) {
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            }
        }
    </script>
</head>
<body>
<header>
    <div class="menu">
        <img src="../image/1.png" alt="Menú" class="dropdown-button" onclick="toggleDropdown()">
        <div id="dropdown-content" class="dropdown-content">
            <a href="../AIMYS.php">INICIO</a>
            <a href="../vista/JavaScript/views/JsTuto.html">JS</a>
            <a href="../vista/Java/view/JavaTuto.html">Java</a>
            <a href="../vista/PHP/view/PhPTuto.html">PHP</a>
            <a href="../vista/Python/view/PythonTuto.html">Python</a>
            <a href="../comentarios/index.php">Comentar</a>

            
           
        </div>
        <div class="perfil">
            <img src="../image/4.png" alt="Menú" class="dropdown-button1" onclick="toggles()">
            <div id="dropdown-content1" class="dropdown-content1">
                <a href="../cambiarContraseña/cambiarPassword.php">Cambiar Contraseña</a>
                <a href="../vista/configuracion.php">Configuración</a>
                <a href="../basededatos/cerrarSesion.php">Cerrar sesión</a>
            </div>

            <script>
                function toggleDropdown() {
                    document.getElementById("dropdown-content").classList.toggle("show");
                }
            </script>
            <script>
                function toggles() {
                    document.getElementById("dropdown-content1").classList.toggle("show");
                }
            </script>
            <div>
</div>
</header>
    <div id="container">
        <h1>Agregar Comentario</h1>
        <form method="post" action="">
            <textarea name="comentario" required></textarea>
            <input type="hidden" name="reply_id" value="">
            <input class="segundo" type="submit" name="comentar" value="Comentar">
        </form>

        <h1>Comentarios</h1>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Obtener el nombre del usuario
                $userQuery = "SELECT NOMBRES FROM usuario WHERE USUARIO_ID = '" . $row['usuario_id'] . "'";
                $userResult = $conexion->query($userQuery);

                if ($userResult && $userResult->num_rows > 0) {
                    $user = $userResult->fetch_assoc();

                    echo "<div class='comentario'>";
                    echo "<div class='comentario-header'>" . $user['NOMBRES'] . " - <span class='comentario-fecha'>" . $row['fecha'] . "</span></div>";
                    echo "<p>" . $row['comentario'] . "</p>";
                    echo "<button onclick=\"toggleReplyForm(" . $row['id'] . ")\">Responder</button>";

                    // Mostrar formulario de respuesta
                    echo "<div class='responder-form' id='reply-form-" . $row['id'] . "' style='display:none;'>";
                    echo "<form method='post' action=''>";
                    echo "<textarea name='comentario' required></textarea>";
                    echo "<input type='hidden' name='reply_id' value='" . $row['id'] . "' />";
                    echo "<input class='segundo' type='submit' name='comentar' value='Responder'>";
                    echo "</form>";
                    echo "</div>";

                    // Mostrar respuestas
                    $replyQuery = "SELECT * FROM comentarios WHERE reply = '" . $row['id'] . "' ORDER BY fecha ASC";
                    $replyResult = $conexion->query($replyQuery);

                    if ($replyResult && $replyResult->num_rows > 0) {
                        echo "<div class='replies'>";
                        while ($rep = $replyResult->fetch_assoc()) {
                            $user2Query = "SELECT NOMBRES FROM usuario WHERE USUARIO_ID = '" . $rep['usuario_id'] . "'";
                            $user2Result = $conexion->query($user2Query);

                            if ($user2Result && $user2Result->num_rows > 0) {
                                $user2 = $user2Result->fetch_assoc();
                                echo "<div class='comentario'>";
                                echo "<div class='comentario-header'>" . $user2['NOMBRES'] . " - <span class='comentario-fecha'>" . $rep['fecha'] . "</span></div>";
                                echo "<p>" . $rep['comentario'] . "</p>";
                                echo "</div>";
                            }
                        }
                        echo "</div>";
                    }

                    echo "</div>";
                } else {
                    echo "<div class='comentario'>";
                    echo "<div class='comentario-header'>Usuario no encontrado - <span class='comentario-fecha'>" . $row['fecha'] . "</span></div>";
                    echo "<p>" . $row['comentario'] . "</p></div>";
                }
            }
        } else {
            echo "<p>No hay comentarios.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
$conexion->close();
?>
