<?php
// Obtén el controlador y método desde la URL, por defecto 'Dashboard' y 'dashboard'
$controller = isset($_GET['c']) ? $_GET['c'] : 'Dashboard';
$controller = ucfirst(strtolower($controller)) . 'Controller'; // Capitaliza y añade 'Controller'
$method = isset($_GET['m']) ? $_GET['m'] : 'dashboard';

// Construye la ruta del archivo del controlador
$controllerFile = './controllers/' . $controller . '.php';

// Verifica y carga el archivo del controlador
if (file_exists($controllerFile)) {
    require_once($controllerFile);

    // Verifica si la clase del controlador existe
    if (class_exists($controller)) {
        $object = new $controller();

        // Verifica si el método existe
        if (method_exists($object, $method)) {
            // Si el método es 'show' o 'edit', asegúrate de pasar el ID
            if (($method === 'show' || $method === 'edit') && isset($_GET['id'])) {
                $id = $_GET['id']; // Obtener el ID de la reserva
                $object->$method($id); // Llama al método con el ID
            } else {
                $object->$method(); // Llama al método sin parámetros
            }
        } else {
            echo 'Error: Method ' . $method . ' not found in controller ' . $controller . '.';
        }
    } else {
        echo 'Error: Controller class ' . $controller . ' not found.';
    }
} else {
    echo 'Error: Controller file not found at ' . $controllerFile;
}
