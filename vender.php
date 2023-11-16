<?php
session_start();
include_once "encabezado.php";
if (!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>
<div class="col-xs-12">
	<h1>Mantenimiento</h1>
	<?php
	if (isset($_GET["status"])) {
		if ($_GET["status"] === "1") {
	?>
			<div class="alert alert-success">
				<strong>¡Correcto!</strong> Venta realizada correctamente
			</div>
		<?php
		} else if ($_GET["status"] === "2") {
		?>
			<div class="alert alert-info">
				<strong>Venta cancelada</strong>
			</div>
		<?php
		} else if ($_GET["status"] === "3") {
		?>
			<div class="alert alert-info">
				<strong>Ok</strong> Producto quitado de la lista
			</div>
		<?php
		} else if ($_GET["status"] === "4") {
		?>
			<div class="alert alert-warning">
				<strong>Error:</strong> El producto que buscas no existe
			</div>
		<?php
		} else if ($_GET["status"] === "5") {
		?>
			<div class="alert alert-danger">
				<strong>Error: </strong>El producto está agotado
			</div>
		<?php
		} else {
		?>
			<div class="alert alert-danger">
				<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
			</div>
	<?php
		}
	}
	?>
	<br>
	<form method="post" action="agregarAlCarrito.php">
		<label for="id">ID del producto:</label>
		<input autocomplete="off" autofocus class="form-control" name="id" required type="text" id="id" placeholder="Escribe el id">
		
	</form>
	<br><br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Descripción</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Marca</th>
				<th>Iva</th>
				<th>Total</th>
				<th>Quitar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($_SESSION["carrito"] as $indice => $producto) {
				$granTotal += $producto->total;
				$idp = $producto->id;
				$np = $producto->nombre;
				$iva = $granTotal * 0.08;
			?>
				<tr>
					<td><?php echo $producto->id ?></td>
					<td><?php echo $producto->nombre ?></td>
					<td><?php echo $producto->descripcion ?></td>
					<td><?php echo $producto->precio ?></td>
					<td>
						<form action="cambiar_cantidad.php" method="post">
							<input name="indice" type="hidden" value="<?php echo $indice; ?>">
							<input min="1" name="cantidad" class="form-control" required type="number" step="0.1" value="<?php echo $producto->cantidad; ?>">
						</form>
					</td>
					<td><?php echo $producto->marca ?></td>
					<td><?php echo $producto->iva ?></td>
					<td><?php echo $producto->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice ?>"><i class="fa fa-trash"></i></a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<h3>Total: <?php echo $granTotal; ?></h3>
	<form action="./terminarVenta.php" method="POST">
		<label for="idc">ID del cliente:</label>
		<input autocomplete="off" autofocus class="form-control" name="idc" required type="text" id="idc" placeholder="Escribe el id">
		<label for="ide">ID del empleado:</label>
		<input autocomplete="off" autofocus class="form-control" name="ide" required type="text" id="ide" placeholder="Escribe el id">
		<br>
		<input name="total" type="hidden" value="<?php echo $granTotal; ?>">
		<input name="idp" type="hidden" value="<?php echo $idp; ?>">
		<input name="np" type="hidden" value="<?php echo $np; ?>">
		<input name="iva" type="hidden" value="<?php echo $iva; ?>">
		<button type="submit" class="btn btn-success">Terminar venta</button>
		<a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
	</form>
</div>
<?php include_once "pie.php" ?>