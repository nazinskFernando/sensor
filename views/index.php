<!DOCTYPE html>
<html lang="en">
<head>
  <title>Gráfico de Temperatura - ESP8266 + PHP + MYSQL (Versão 2)</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta http-equiv='refresh' content='5' URL=''>    
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <!-- JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!-- Google Chart -->  
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
<?php
//Inclui a conexão com o BD
require_once '../model/Sensor.php';

$sensor = new Sensor();

$temperatura = json_encode($sensor->getDadosTemperatura());
$umidade = json_encode($sensor->getDadosUmidade());
$umidadeSolo = json_encode($sensor->getDadosUmidadeSolo());
$chuva = json_encode($sensor->getDadosChuva());
?>
<table style="width:100%">
    <tr>
        <td><div class="container" style="height: 200px; width: 90%" id="chart_div"></div></td>
    </tr>
    <tr>
        <div class="container" style="height: 200px; width: 90%" id="chart_umidade"></div>
    </tr>
</table>
<br><br>
<?php
    if($chuva == 1){
         echo "<img src='imagem/drop.png'>";
          echo "Sem chuva";
    }
    if($chuva == 2){
         echo "<img src='imagem/drop (1).png'>";
         echo "Chuva fraca";
    }
    if($chuva == 3){
         echo "<img src='imagem/drop (2).png'>";
          echo "Chuva moderada";
    }
    if($chuva == 4){
         echo "<img src='imagem/drop (3).png'>";
          echo "Chuva forte";
    }
    
     if($umidadeSolo == 1){
         echo "<img src='imagem/shovel.png'>";
          echo "Solo Seco";
    }
    if($umidadeSolo == 2){
         echo "<img src='imagem/shovel (1).png'>";
         echo "Solo Moderado";
    }
    if($umidadeSolo == 3){
         echo "<img src='imagem/shovel (2).png'>";
          echo "Solo Úmido";
    }
    if($umidadeSolo == 4){
         echo "<img src='imagem/shovel (3).png'>";
          echo "Solo Muito úmido";
    }
   
?>

</body>
<script>
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(temperatura);
google.charts.setOnLoadCallback(umidade);

function temperatura() {
     var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Temperatura');

      data.addRows(<?php echo $temperatura?>);

        var options = {
          title: 'Temperatura',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

        chart.draw(data, options);
    }
    
function umidade() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Umidade');

      data.addRows(<?php echo $umidade?>);

      var options = {
          title: 'Umidade',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

      var chart = new google.visualization.LineChart(document.getElementById('chart_umidade'));
      chart.draw(data, options);
    }
    
</script>
</html>