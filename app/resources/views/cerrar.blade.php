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
		<p class="pcoustome">TIKET NO VALIDO COMO FACTURA</p>
	</center>	
	<div id="contenido">
		<p style="text-transform: uppercase;font-size: 14px;text-align: center;font-weight:bold;">MESA {{$mesa->nombre}}</p>
		<table style="text-transform: uppercase;font-size: 13px;text-align: center">
			<tr>
				<td style="font-weight: bold;">Cant</td>
				<td style="font-weight: bold;">ART</td>
				<td style="font-weight: bold;">$</td>
			</tr>
			@for($i=0;$i<count($finproducto['cantidad']);$i++)
			<tr>
				<td style="font-size: 16px;">{{$finproducto['cantidad'][$i]}}</td>
				<td style="font-size: 16px;">{{$finproducto['producto'][$i]}}</td>
				<td style="font-size: 16px;">{{$finproducto['precio'][$i]}}</td>
			</tr>
			@endfor
		</table>
		<p>TOTAL $: {{$total}}</p>
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

  				window.location.href = "{{url('panelbarra')}}";
  			}
		}
	</script>
</html>