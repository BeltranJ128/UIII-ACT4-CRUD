<?php include_once "encabezado.php" ?>

<div class="col-xs-12">
	<h1>Nuevo producto</h1>
	<form method="post" action="nuevo.php">
		<label for="nombre">Nombre del producto:</label>
		<input class="form-control" name="nombre" required type="text" id="nombre" placeholder="Escribe el nombre">

		<label for="descripcion">Descripción:</label>
		<textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"></textarea>

		<label for="precio">Precio:</label>
		<input class="form-control" name="precio" required type="number" id="precio" placeholder="Precio">

		<label for="exist">Existencias:</label>
		<input class="form-control" name="exist" required type="number" id="exist" placeholder="Existencias">

		<label for="tipo_producto">Tipo de producto:</label>
		<input class="form-control" name="tipo_producto" required type="text" id="tipo_producto" placeholder="Tipo de producto">

		<label for="marca">Marca:</label>
		<input class="form-control" name="marca" required type="text" id="marca" placeholder="Marca">
		
		<label for="iva">IVA:</label>
		<input class="form-control" name="iva" required type="number" step="0.1" id="iva" placeholder="Iva">

		<br><br><input class="btn btn-info" type="submit" value="Guardar">
	</form>
</div>
<?php include_once "pie.php" ?>