<?php
if(!isset($_POST["total"])) exit;


session_start();


$total = $_POST["total"];
$ide = $_POST["ide"];
$idc = $_POST["idc"];
$idp = $_POST["idp"];
$np = $_POST["np"];
$iva = $_POST["iva"];
include_once "base_de_datos.php";


$ahora = date("Y-m-d H:i:s");


$sentencia = $base_de_datos->prepare("INSERT INTO mantenimiento(id_cliente, id_empleado, id_producto, nom_producto, iva, fecha, total) VALUES (?, ?, ?, ?, ?, ?, ?);");
$sentencia->execute([$idc,$ide,$idp,$np,$iva,$ahora, $total]);

$sentencia = $base_de_datos->prepare("SELECT id FROM mantenimiento ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$id_mantenimiento = $resultado === false ? 1 : $resultado->id;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO cant_producto(id_producto, id_mantenimiento, cantidad) VALUES (?, ?, ?);");
$sentenciaExistencia = $base_de_datos->prepare("UPDATE productos SET existencias = existencias - ? WHERE id = ?;");
foreach ($_SESSION["carrito"] as $producto) {
	$total += $producto->total;
	$sentencia->execute([$producto->id, $id_mantenimiento, $producto->cantidad]);
	$sentenciaExistencia->execute([$producto->cantidad, $producto->id]);
}
$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
header("Location: ./vender.php?status=1");
?>