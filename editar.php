<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE id = ?;");
$sentencia->execute([$id]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
if($producto === FALSE){
	echo "¡No existe algún producto con ese ID!";
	exit();
}

?>
<?php include_once "encabezado.php" ?>
	<div class="col-xs-12">
		<h1>Editar producto con el ID <?php echo $producto->id; ?></h1>
		<form method="post" action="guardarDatosEditados.php">
			<input type="hidden" name="id" value="<?php echo $producto->id; ?>">
	
			<label for="nombre">Nombre:</label>
			<input value="<?php echo $producto->nombre ?>" class="form-control" name="nombre" required type="text" id="nombre" placeholder="Escribe el código">

			<label for="descripcion">Descripción:</label>
			<textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"><?php echo $producto->descripcion ?></textarea>

			<label for="precio">Precio:</label>
			<input value="<?php echo $producto->precio ?>" class="form-control" name="precio" required type="number" id="precio" placeholder="Precio de venta">

			<label for="exist">Existencias:</label>
			<input value="<?php echo $producto->existencias ?>" class="form-control" name="exist" required type="number" id="exist" placeholder="Precio de compra">

			<label for="tipo">Tipo de producto:</label>
			<input value="<?php echo $producto->tipo_producto ?>" class="form-control" name="tipo" required type="text" id="tipo" placeholder="Cantidad o existencia">

			<label for="marca">Marca:</label>
			<input value="<?php echo $producto->marca ?>" class="form-control" name="marca" required type="text" id="marca" placeholder="Cantidad o existencia">

			<label for="iva">IVA:</label>
			<input value="<?php echo $producto->iva ?>" class="form-control" name="iva" required type="text" id="iva" placeholder="Cantidad o existencia">

			<br><br><input class="btn btn-info" type="submit" value="Guardar">
			<a class="btn btn-warning" href="./listar.php">Cancelar</a>
		</form>
	</div>
<?php include_once "pie.php" ?>
