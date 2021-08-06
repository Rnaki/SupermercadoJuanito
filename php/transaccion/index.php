<?php

require '../../transbank/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Inicializamos el objeto Transaction
|--------------------------------------------------------------------------
*/

session_start();
use Transbank\Webpay\WebpayPlus\Transaction;
$amount = $_POST["totalCompraTransbank"];
//$transaction = new \Transbank\Webpay\WebpayPlus\Transaction();
$transaction = new Transaction();
// Por simplicidad de este ejemplo, este es nuestro "controlador" que define que vamos a hacer dependiendo del parametro ?action= de la URL.
$response = $transaction->create('ordertest', $_SESSION["id_venta"], $amount, 'http://test2.local/php/seleccionSucursal.php?action=result');

$url= $response->getUrl();
$token = $response->getToken();
?>
<html>
    <head>
    </head>
    <body>
<form method="post" action="<?php echo $url?>">
  <input type="hidden" name="token_ws" value="<?php echo $token ?>" />
  <input type="submit" value="Ir a pagar" />
</form>
</body>
</html>
