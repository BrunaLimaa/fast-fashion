
<?php
use Dompdf\Dompdf;
use League\Plates\Template\Func;

$html = "";
$total = 0;
foreach($carts as $product){
    $html .= $product->name . "<br>";
    $html .= $product->price . "<br>";
    $total = $product->price + $total;
}



//require_once 'dompdf/autoload.inc.php';

$dompdf = new Dompdf();

$page = '<h1 style="text-align:center;">NOTA FISCAL '. CONF_SITE_NAME .'</h1><br>
<h2>Lista de Produtos</h2>
<p>' . $html . '</p>
<h2>Informações pessoais</h2>
<p>NOME COMPLETO: '.$user->getName().'</p>
<p>EMAIL: '.$user->getEmail().'</p>
<h2>Total:</h2><h3>R$'.$total.'</h3>
<h4>Informações adicionais:</h4>
<p>'. CONF_SITE_NAME .'</p>
<p>EMAIL:fastfashion@gmail.com</p>

';



 $dompdf->loadHtml($page);
 $dompdf->render();
 $dompdf->stream("nota_fiscal.pdf");


