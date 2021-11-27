<html style="width: 52mm;">
	<head></head>
	<style type="text/css">
		.pcoustome{
			font-size: 20px;
			font-weight: bold;
			text-align: center;
			margin-bottom: 20px;
		}
		img{
			width: 90%;
		}
	</style>
	<body>
	<center>

		<p class="pcoustome">MESA {{$mesa}}</p>
		<p style="font-size: 18px;font-weight: bold;
			text-align: center;
			margin-bottom: 20px;">
			<?php
			$a= shell_exec('date "+%T" ');
			print($a);
			?></p>
	</center>
	<div id="contenido">

		<table style="text-transform: uppercase;font-size: 13px;text-align: center">
			<tr>
				<td style="font-weight: bold;">Cant</td>
				<td style="font-weight: bold;">Plato</td>
			</tr>
			@for($i=0;$i<count($cocina->cantidad);$i++)
			<tr>
				<td style="font-size: 16px;">{{$cocina->cantidad[$i]}}</td>
				<td style="font-size: 16px;">{{$cocina->producto[$i]}} {{$cocina->descripcion[$i]}} </td>
			</tr>
			@endfor
		</table>
	</div>
	<p style="color:white;display: none">___________________</p>
	<p style="color:white;display: none">___________________</p>
	<p style="color:white;display: none">___________________</p>
	<p style="color:white;display: none">___________________</p>
	<p style="color:white;display: none">___________________</p>

	</body>
	<script>
		if (window.print) {
			window.print();
			window.onafterprint = function(){

  				window.location.href = "{{url('panelbarra/mesas')}}";
  			}
		}
	</script>
</html>
