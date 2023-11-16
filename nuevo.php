<?php
#Salir si alguno de los datos no está presente
if(!isset($_POST["nombre"]) || !isset($_POST["descripcion"]) || !isset($_POST["precio"]) || !isset($_POST["exist"]) || !isset($_POST["tipo_producto"]) || !isset($_POST["marca"]) || !isset($_POST["iva"])) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$precio = $_POST["precio"];
$exist = $_POST["exist"];
$tipo_producto = $_POST["tipo_producto"];
$marca = $_POST["marca"];
$iva = $_POST["iva"];

$sentencia = $base_de_datos->prepare("INSERT INTO productos(nombre, descripcion, precio, existencias, tipo_producto, marca, iva) VALUES (?, ?, ?, ?, ?, ?, ?);");
$resultado = $sentencia->execute([$nombre, $descripcion, $precio, $exist, $tipo_producto, $marca, $iva]);

if($resultado === TRUE){
	header("Location: ./listar.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista";


?>
<?php include_once "pie.php" ?>