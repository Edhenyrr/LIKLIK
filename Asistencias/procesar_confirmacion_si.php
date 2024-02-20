<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asegúrate de validar y sanitizar los datos antes de usarlos
    $nombreApellido = $_POST['nombreApellido'];

    // Divide el nombre y apellido
    list($nombre, $apellido) = explode(" ", $nombreApellido);

    // Leer la lista actual desde Lista.csv
    $archivoLista = 'Lista.csv';
    $lista = [];

    if (($gestor = fopen($archivoLista, 'r')) !== FALSE) {
        while (($datos = fgetcsv($gestor, 1000, ',')) !== FALSE) {
            $lista[] = $datos;
        }
        fclose($gestor);
    }
    // Eliminar el nombre seleccionado de Lista.csv
    $archivoListaTmp = 'Lista_tmp.csv';
    if (($gestorTmp = fopen($archivoListaTmp, 'w')) !== FALSE) {
        foreach ($lista as $persona) {
            if ($persona[0] != $nombre || $persona[1] != $apellido) {
                fputcsv($gestorTmp, $persona);
            }
        }
        fclose($gestorTmp);

        // Renombrar el archivo temporal a Lista.csv
        rename($archivoListaTmp, $archivoLista);
    }

    // Mover el nombre seleccionado a Asistentes.csv
    $archivoAsistentes = 'Asistentes.csv';
    $listaAsistentes = [];

    // Agregar el nombre seleccionado a Asistentes.csv
    $listaAsistentes[] = [$nombre, $apellido];

    // Guardar la lista de asistentes
    if (($gestor = fopen($archivoAsistentes, 'a')) !== FALSE) {
        foreach ($listaAsistentes as $datos) {
            fputcsv($gestor, $datos);
        }
        fclose($gestor);
    }

    // Imprimir contenido actual de Asistentes.csv (depuración)
    $contenidoAsistentes = file_get_contents($archivoAsistentes);
    echo "<pre>Contenido actual de Asistentes.csv:\n$contenidoAsistentes</pre>";

    // Eliminar el nombre seleccionado de Lista.csv
    foreach ($lista as $clave => $persona) {
        if ($persona[0] == $nombre && $persona[1] == $apellido) {
            unset($lista[$clave]);
        }
    }

    // Guardar la lista actualizada en Lista.csv
    if (($gestor = fopen($archivoLista, 'w')) !== FALSE) {
        foreach ($lista as $datos) {
            fputcsv($gestor, $datos);
        }
        fclose($gestor);
    }

    // Imprimir contenido actual de Lista.csv (depuración)
    $contenidoLista = file_get_contents($archivoLista);
    echo "<pre>Contenido actual de Lista.csv:\n$contenidoLista</pre>";

    // Redirigir de vuelta a confirmar_si.php o a donde sea necesario
    header('Location: agradecimiento.html');
    exit();
}
