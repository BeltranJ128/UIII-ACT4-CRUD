<?php
if (!isset($_POST["id"])) {
    return;
}

$id = $_POST["id"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE id = ? LIMIT 1;");
$sentencia->execute([$id]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
# Si no existe, salimos y lo indicamos
if (!$producto) {
    header("Location: ./vender.php?status=4");
    exit;
}
# Si no hay existencia...
if ($producto->existencias < 1) {
    header("Location: ./vender.php?status=5");
    exit;
}
session_start();
# Buscar producto dentro del carrito
$indice = false;
for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
    if ($_SESSION["carrito"][$i]->id == $id) {
        $indice = $i;
        break;
    }
}
# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $producto->cantidad = 1;
    $producto->total = $producto->precio + $producto->iva;
    array_push($_SESSION["carrito"], $producto);
} else {
    # Si ya existe, se agrega la cantidad
    # Pero espera, tal vez ya no haya
    $cantidadExistente = $_SESSION["carrito"][$indice]->cantidad;
    # si al sumarle uno supera lo que existe, no se agrega
    if ($cantidadExistente + 1 > $producto->existencias) {
        header("Location: ./vender.php?status=5");
        exit;
    }
    $_SESSION["carrito"][$indice]->cantidad++;
    $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precio + ($_SESSION["carrito"][$indice]->iva * $_SESSION["carrito"][$indice]->cantidad ) ;
}
header("Location: ./vender.php");
