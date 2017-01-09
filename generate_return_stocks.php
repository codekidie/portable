<?php  
    ob_start();
    
    require_once('vendor/autoload.php');
  
    include('generate_return_stacks_data.php');

    $content = ob_get_clean();

    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('return_stocks_report.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }