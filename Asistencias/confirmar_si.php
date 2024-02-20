<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap">
    <link rel="stylesheet" href="confirmar_si.css">

    <title>Lista de inscriptos</title>
    
     
</head>
<body>
    <form action="procesar_confirmacion_si.php" method="post">
            
        <h1>LISTA DE INSCRIPTOS</h1>
        <label for="nombreApellido">Selecciona tu nombre:</label>
        <select name="nombreApellido" id="nombreApellido" required>
            <?php
            $archivo = 'Lista.csv';
            if (($gestor = fopen($archivo, 'r')) !== FALSE) {
                while (($datos = fgetcsv($gestor, 1000, ',')) !== FALSE) {
                    echo "<option value='" . $datos[0] . " " . $datos[1] . "'>" . $datos[0] . " " . $datos[1] . "</option>";
                }
                fclose($gestor);
            }
            
            ?>
        </select>
        <a href="index.html" class="back-to-index">Volver atrás</a>
        <button type="submit">Confirmar</button>
        <!-- Dentro del formulario en confirmar_si.php -->


    </form>
</body>
</html>

