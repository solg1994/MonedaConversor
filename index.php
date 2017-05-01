<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/monedas/estilos.css" media="screen" />
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/flexboxgrid/6.3.0/flexboxgrid.min.css' rel='stylesheet'>
</head>
<div>
  <img alt='Logo'  src='logo2.png' width='400'>
</div>
<h1>Conversor de Moneda</h1>
<body href="#fondo">
  <form name="form_moneda" action="index.php" method="post" accept-charset="utf-8" class="form-horizontal" >
  <?php
      $siglas = array("AUD" => "Dolar Australiano","BGN" => "Lev Bulgaria","BRL" => "Real Brasilenio","CAD" => "Dolar Canadiense","CHF" => "Franco Suizo","CNY" => "Yuan Chino","CZK" => "Corona Checa","DKK" => "Corona Danesa","GBP" => "Libra Esterlina Britanica","HKD" => "Dolar de Hong Kong","HRK" => "Kuna Croata","HUF" => "Florin Hungaro","IDR" => "Rupia Indonesia","ILS" => "Shekel Israeli","INR" => "Rupia Hindu","JPY" => "Yen Japones","KRW" => "Won Surcoreano","MXN" => "Peso Mexicano","MYR" => "Ringgit Malasio","NZD" => "Dolar Neozelandes","PHP" => "Peso Filipino","PLN" => "Zloty Polaco","RON" => "Reu Rumano","RUB" => "Rublo Ruso","SEK" => "Corona Sueca","SGD" => "Dolar Singapurense","THB" => "Baht Thailandes","TRY" => "Lira Turca","USD" => "Dolar Estadounidense","ZAR" => "Rand Sudafricano");
  ?>

  <!-- Moneda base -->
  <div class="input-group container">
    <label class="control-label" for="label_moneda_covertir">Seleccione moneda base: </label>
    <select name="moneda_base" class="form-control">
    <?php
          foreach($siglas as $moneda => $desc){
              echo "<option value=$moneda>$desc</option>";
          }
      ?>
    </select>
  </div>

  <!-- Moneda a convertir -->
  <div class="input-group container">
    <label class="control-label" for="label_moneda_covertir">Seleccione moneda a convertir</label>
    <select name="moneda_convertir" class="form-control">
    <?php
          foreach($siglas as $moneda => $desc){
              echo "<option value=$moneda>$desc</option>";
          }
      ?>
    </select>
  </div>
  <div class="input-group container" >
        <label for="valor">Ingrese cantidad a convertir:</label>
        <span class="glyphicon glyphicon-usd"></span>
        <input type="number" value="0" min="0" class="form-control" name="cantidad">
      </div>
  <!-- Boton convertir-->
</br>
      <p><input type="submit" name = submit ="submit" value= "Convertir"/></p>
    </form>
</body>
</html>



<!--Seccion de PHP-->
<?php

include 'request.php';
//variables que vienen del html
$opcion_valor=$_POST['moneda_convertir'];
$base= $_POST['moneda_base'];
$cantidad1 = $_POST['cantidad'];
$url = "http://api.fixer.io/latest?base=".$base;
if(((string)$opcion_valor) != ((string)$base )){
      $result1 = json_decode(callAPI("GET",$url));
      $cambio = $cantidad1 * $result1->{'rates'}->{$opcion_valor};
      $moneda_base = $siglas[$base];
      $moneda_convertir = $siglas[$opcion_valor];
      $conversion = $cantidad1." ".$moneda_base." son ".$cambio." ".$moneda_convertir;
     echo "<div  class=\"container\">$conversion</div";
     //echo $conversion;
    }
    else{
      echo "<div class=\"container1\">Elija distintas monedas para el cambio</div>";
    }
?>
