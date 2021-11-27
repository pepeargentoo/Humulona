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
		<p class="pcoustome">CIERRE DE CAJA</p>
	</center>	
	<div id="contenido">
		<p style="text-transform: uppercase;font-size: 14px;text-align: center;font-weight:bold;">{{ date('d/m/Y') }}</p>
		<table style="text-transform: uppercase;font-size: 13px;text-align: center">
			<tr>
				<td style="font-weight: bold;">Mesa</td>
				<td style="font-weight: bold;">$</td>
			</tr>
			@foreach($estadias as $e)
			<tr>
				<td style="font-size: 16px;">{{$e->mesa}}</td>
				<td style="font-size: 16px;">{{$e->monto}}</td>
			</tr>
			@endforeach
	
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