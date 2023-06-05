<?php

require_once("Item.php");


if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/api/Controlador.php/getallitems') {
    $crudPersona = new CrudPersona();
    echo $crudPersona->getAllItems();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && strpos($_SERVER['REQUEST_URI'], '/api/Controlador.php/getItem') !== false) {
    $id = $_GET['id'];
    $crudPersona = new CrudPersona();
    echo $crudPersona->getItem($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && strpos($_SERVER['REQUEST_URI'], '/api/Controlador.php/deleteItem') !== false) {
    $id = $_GET['id'];
    $crudPersona = new CrudPersona();
    $crudPersona->deleteItem($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['REQUEST_URI'], '/api/Controlador.php/createItem') !== false) {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data !== null && isset($data['nombre']) && isset($data['apellido']) && isset($data['edad'])) {
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $edad = $data['edad'];
        $crudPersona = new CrudPersona();
        $crudPersona->createItem($nombre, $apellido, $edad);
    } else {
        echo "Datos JSON no válidos.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT' && strpos($_SERVER['REQUEST_URI'], '/api/Controlador.php/updateItem') !== false) {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);


    if ($data !== null && isset($data['id']) && isset($data['nombre']) && isset($data['apellido']) && isset($data['edad'])) {
        // Obtén los valores de los campos
        $id = $data['id'];
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $edad = $data['edad'];
      
        $crudPersona=new CrudPersona();
        $crudPersona->updateItem($id,$nombre,$apellido,$edad);
        
      } else {
        echo "Datos JSON no válidos.";
      }
      
}
