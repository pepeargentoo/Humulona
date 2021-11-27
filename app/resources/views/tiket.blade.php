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
		<img src="{{url('logo.png')}}"  />
		<p class="pcoustome">TIKET NO VALIDO COMO FACTURA</p>
	</center>	
	<div id="contenido"></div>
	<p class="pcoustome">GRACIAS POR SU COMPRA</p>
	<p style="color:white;display: none">___________________</p>
	</body>
	<script>
		if (window.print) {
			window.print();
			window.onafterprint = function(){
  				window.location.href = "{{url('/')}}";
  			}
		}
	</script>
</html>