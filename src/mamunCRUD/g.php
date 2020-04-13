<?php 
include 'class/mamuncrud.php';

$model = new MamunCRUD;
$data = $model->fetch();

foreach ($data as $value) {
	echo $value["title"];
}
?>