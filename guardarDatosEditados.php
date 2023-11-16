<?php

#Salir si alguno de los datos no está presente
if(
	!isset($_POST["nombre"]) || 
	!isset($_POST["descripcion"]) || 
	!isset($_POST["precio"]) || 
	!isset($_POST["exist"]) || 
	!isset($_POST["tipo"]) || 
	!isset($_POST["marca"]) || 
	!isset($_POST["iva"]) || 
	!isset($_POST["id"])
) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$precio = $_POST["precio"];
$exist = $_POST["exist"];
$tipo = $_POST["tipo"];
$marca = $_POST["marca"];
$iva = $_POST["iva"];

$sentencia = $base_de_datos->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, existencias = ?, tipo_producto = ?, marca = ?, iva = ? WHERE id = ?;");
$resultado = $sentencia->execute([$nombre, $descripcion, $precio, $exist, $tipo, $marca, $iva, $id]);

if($resultado === TRUE){
	header("Location: ./listar.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del producto";
?>