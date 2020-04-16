<?php 
include 'class/mamuncrud.php';

$model = new MamunCRUD;
$id = $_REQUEST['id'];
$delete = $model->delete($id);
?>