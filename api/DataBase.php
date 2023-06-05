<?php

class DataBase {
    private $datos = array(
        "host" => "localhost:3310",
        "user" => "root",
        "password" => "",
        "database" => "base4"
    );

    public function connect() {
        if (!isset($this->datos['host'], $this->datos['user'], $this->datos['password'], $this->datos['database'])) {
            throw new Exception("Faltan parámetros de conexión");
        }

        $conexion = mysqli_connect($this->datos['host'], $this->datos['user'], $this->datos['password'], $this->datos['database']);
        if (mysqli_connect_errno()) {
            throw new Exception("Error en la conexión a la base de datos: " . mysqli_connect_error());
        } else {
            return $conexion;
        }
    }
}
