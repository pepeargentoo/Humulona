<br clear=all>
<br clear=all>
<br clear=all>
<div style="width:100%;margin: 20px;">
<div style="width:20%;float:left;">
  <img src="{{url('logo.png')}}" style="width:100%;">
</div>
<div style="width:78%;">
<h4 style="text-align: right;">PROVEEDOR:
  <span style="font-weight: initial;">{{$pdf['proveedor']}}</span><br>
  FECHA: <span style="font-weight: initial;">{{$pdf['fecha']}}</span>
</h4>
</div>
</div>
<br clear=all>
<br clear=all>
<br clear=all>
<table style="width:100%;">
  <tr>
    <th style="width:10%;border: 1px solid black;">Cantidad</th>
    <th style="border: 1px solid black;">Articulo</th>
    <th style="width:11%;border: 1px solid black;">Precio ($)</th>
  </tr>

    @foreach($pdf['articulos'] as $key=> $ar)
    <tr>
      <td style="width:10%;text-align:center;border: 1px solid black;">{{$pdf['cantidad'][$key]}}</td>
      <td style="border: 1px solid black;">{{$pdf['articulos'][$key]}}</td>
      <td style="width:11%;text-align:center;border: 1px solid black;">{{$pdf['precio'][$key]}}</td>
    </tr>
    @endforeach
</table>
<br clear=all>
<h4 style="text-transform: uppercase;float:right;margin-right: 10%;">Total: ${{$pdf['total']}}</h4>
