<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Asistencia - Redirección</title>
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Validación de datos
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $celular = $_POST['celular'];

        // Agregar los datos a Asistentes.csv
        $archivoAsistentes = 'Asistentes.csv';
        $nuevaPersona = [$nombre, $apellido, $celular];

        // Guardar la nueva persona en Asistentes.csv
        if (($gestor = fopen($archivoAsistentes, 'a')) !== FALSE) {
            fputcsv($gestor, $nuevaPersona);
            fclose($gestor); // Redirigir a la página de agradecimiento
            header('Location: agradecimiento.html');
            exit();
        }
    }
