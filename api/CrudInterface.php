<?php

interface Crud{
    
    public function getAllItems();

    public function getItem($id);

    public function deleteItem($id);

    public function updateItem($id,$nombre,$apellido,$edad);

    public function createItem($nombre,$apellido,$edad);

    public function deleteAllItems();

}

?>