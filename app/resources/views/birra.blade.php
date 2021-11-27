<html style="width: 52mm;">
	<head></head>
	<style type="text/css">
		.pcoustome{
			font-size: 16px;
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
		<img src="{{url('logo.png')}}"  />
		<p class="pcoustome">TIKET INTERNO</p>
	</center>	
	<div id="contenido">
		<p style="text-transform: uppercase;font-size: 14px;text-align: center;font-weight:bold;">MESA {{$mesa}}</p>
		<table style="text-transform: uppercase;font-size: 13px;text-align: center">
			<tr>
				<td style="font-weight: bold;">Cant</td>
				<td style="font-weight: bold;">Trago</td>
			</tr>
			@for($i=0;$i<count($cocina->cantidad);$i++)
			<tr>
				<td style="font-size: 16px;">{{$cocina->cantidad[$i]}}</td>
				<td style="font-size: 16px;">{{$cocina->producto[$i]}}</td>
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