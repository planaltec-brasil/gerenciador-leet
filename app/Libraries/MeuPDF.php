<?php

namespace App\Libraries;

use Mpdf\Mpdf;

class MeuPDF {
    function GerarPDF($html) {
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            // 'format' => 'A4-L',
            // 'orientation' => 'L',
            'setAutoTopMargin' => false,
            'setAutoBottomMargin' => false,
            'autoMarginPadding' => 0,
            'bleedMargin' => 0,
            'crossMarkMargin' => 0,
            'cropMarkMargin' => 0,
            'nonPrintMargin' => 0,
            'margBuffer' => 0,
            'collapseBlockMargins' => false,
            'margin_left' => 3,
            'margin_right' => 3,
            'margin_top' => 10,
            'margin_bottom' => 3,
            'margin_header' => 3,
            'margin_footer' => 3,
        ]);
        
        $mpdf->WriteHTML($html);
		$mpdf->Output('arjun.pdf','I');
    }
}