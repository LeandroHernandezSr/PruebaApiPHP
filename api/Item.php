<?php

require_once("CrudInterface.php");
require_once("DataBase.php");

class CrudPersona implements Crud
{

    private $dataBase;
    private $json = array();
    private $contenidoJson;

    public function __construct()
    {
        $this->dataBase = new DataBase();
    }

    public function getAllItems()
    {
        $resultado = mysqli_query($this->dataBase->connect(), "SELECT * FROM `alumno`");
        if (!$resultado) {
            throw new Exception("Error en el select");
        }

        $items = array();

        while ($reg = mysqli_fetch_array($resultado)) {
            $item = array(
                'id' => $reg['id'],
                'nombre' => $reg['nombre'],
                'apellido' => $reg['apellido'],
                'edad' => $reg['edad']
            );
            $items[] = $item;
        }

        $contenidoJson = json_encode($items, true);

        header('Content-Type: application/json');
        http_response_code(200);

        mysqli_close($this->dataBase->connect());
        return $contenidoJson;
    }


    public function getItem($id)
    {
        $resultado = mysqli_query($this->dataBase->connect(), "SELECT * FROM `alumno` WHERE id=$id");
        if (!$resultado) {
            throw new Exception("Error en el select");
        }
        while ($reg = mysqli_fetch_array($resultado)) {
            $this->json['id'] = $reg['id'];
            $this->json['nombre'] = $reg['nombre'];
            $this->json['apellido'] = $reg['apellido'];
            $this->json['edad'] = $reg['edad'];
        }

        $this->contenidoJson = json_encode($this->json, true);
        header('Content-Type: application/json');
        http_response_code(200);
        mysqli_close($this->dataBase->connect());
        return $this->contenidoJson;
    }

    public function deleteItem($id)
    {
        $resultado = mysqli_query($this->dataBase->connect(), "DELETE FROM `alumno` WHERE id = $id");
        if ($resultado === false) {
            throw new Exception("Error en el delete");
        } else {
            if (mysqli_affected_rows($this->dataBase->connect()) === 0) {
                echo "No se encontró ningún alumno con el ID: $id";
            } else {
                echo "Alumno con id=$id borrado correctamente";
                mysqli_close($this->dataBase->connect());
            }
        }
    }

    public function updateItem($id, $nombre, $apellido, $edad)
    {
        $dataBase = new DataBase();


        if (!$this->dataBase->connect()) {
            die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
        }

        $consulta = "UPDATE alumno SET nombre = '$nombre', apellido = '$apellido', edad = '$edad' WHERE id = '$id'";


        if (mysqli_query($this->dataBase->connect(), $consulta)) {
            echo "Los datos del alumno se han actualizado correctamente.";
        } else {
            echo "Error al actualizar los datos del alumno: " . mysqli_error($this->dataBase->connect());
        }

        mysqli_close($this->dataBase->connect());
    }


    public function createItem($nombre, $apellido, $edad)
    {
        $query = "INSERT INTO `alumno` (nombre, apellido, edad) VALUES ('$nombre', '$apellido', $edad)";
        $resultado = mysqli_query($this->dataBase->connect(), $query);

        mysqli_query($this->dataBase->connect(),$query);

        if (mysqli_affected_rows($this->dataBase->connect())>0) {
            echo "Registro insertado correctamente.";
            mysqli_close($this->dataBase->connect());
        } else {
            echo "Error en la consulta de inserción.";
        }
    }

    public function deleteAllItems()
    {   
        $dataBase=new DataBase();
        $query="DELETE FROM `alumno`";
        mysqli_query($this->dataBase->connect(),$query);
        if(mysqli_affected_rows($this->dataBase->connect())>0){
            echo "Delete hecho correctamente";
        }else{
            echo "Error en el delete";
        }
        mysqli_close($this->dataBase->connect());
    }
}
