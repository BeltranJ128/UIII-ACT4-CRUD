<?php include_once "encabezado.php" ?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT mantenimiento.total, mantenimiento.fecha, mantenimiento.id, mantenimiento.iva, mantenimiento.id_empleado, mantenimiento.id_cliente, GROUP_CONCAT(	productos.nombre, '..',  productos.descripcion, '..', cant_producto.cantidad SEPARATOR '__') AS productos FROM mantenimiento INNER JOIN cant_producto ON cant_producto.id_mantenimiento = mantenimiento.id INNER JOIN productos ON productos.id = cant_producto.id_producto GROUP BY mantenimiento.id ORDER BY mantenimiento.id;");
$mantenimientos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<div class="col-xs-12">
		<h1>Cantidad de Productos</h1>
		<div>
			<a class="btn btn-success" href="./vender.php">Nueva <i class="fa fa-plus"></i></a>
		</div>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Número</th>
					<th>ID Cliente</th>
					<th>ID Empleado</th>
					<th>Fecha</th>
					<th>Productos vendidos</th>
					<th>IVA</th>
					<th>Total</th>
					<th>Ticket</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($mantenimientos as $mantenimiento){ ?>
				<tr>
					<td><?php echo $mantenimiento->id ?></td>
					<td><?php echo $mantenimiento->id_cliente ?></td>
					<td><?php echo $mantenimiento->id_empleado ?></td>
					<td><?php echo $mantenimiento->fecha ?></td>
					<td>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Descripción</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach(explode("__", $mantenimiento->productos) as $productosConcatenados){ 
								$producto = explode("..", $productosConcatenados)
								?>
								<tr>
									<td><?php echo $producto[0] ?></td>
									<td><?php echo $producto[1] ?></td>
									<td><?php echo $producto[2] ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<td><?php echo $mantenimiento->iva ?></td>
					<td><?php echo $mantenimiento->total ?></td>
					<td><a class="btn btn-info" href="<?php echo "imprimirTicket.php?id=" . $mantenimiento->id?>"><i class="fa fa-print"></i></a></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminarVenta.php?id=" . $mantenimiento->id?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php include_once "pie.php" ?>