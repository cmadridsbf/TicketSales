<?php

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

$enlace = 'https://ticketsales.store/boleto?id='.$registro->token;

$result = Builder::create()
    ->writer(new PngWriter())
    ->data($enlace)
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(ErrorCorrectionLevel::High)
    ->size(100)
    ->margin(10)
    ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
    ->validateResult(false)
    ->build();

$imageData = $result->getDataUri();

?>

<main class="pagina">
    <h2 class="pagina__heading"><?php echo $titulo; ?></h2>
    <p class="pagina__descripcion">Tu Boleto - Te recomendamos almacenarlo, puedes compartirlo en redes sociales.</p>

    <div id="boleto-virtualId"class="boleto-virtual">

        <div class="boleto boleto--<?php echo strtolower($registro->paquete->nombre); ?> boleto--acceso">
            <div class="boleto__contenido">
                <h4 class="boleto__logo">TicketSales</h4>
                <p class="boleto__plan"><?php echo $registro->paquete->nombre; ?></p>
                <p class="boleto__nombre"><?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido; ?></p>
            </div>
            <div class="boleto__qr">
                <img src="<?php echo $imageData; ?>" alt="Boleto QR Code">
            </div>
            <p class="boleto__codigo"><?php echo '#' . $registro->token; ?></p>
        </div>
    </div>
    <!-- <button id="capturarBoton">Capturar Div como Imagen</button> -->

</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.2.2/html2canvas.min.js"></script>

<script>
  document.getElementById('capturarBoton').addEventListener('click', function() {
    html2canvas(document.getElementById('boleto-virtualId')).then(function(canvas) {
      var img = canvas.toDataURL('image/png');
      var link = document.createElement('a');
      link.href = img;
      link.download = 'miDiv.png';
      link.click();
    });
  });
</script>




