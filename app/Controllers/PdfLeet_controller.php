<?php

namespace App\Controllers;
use App\Libraries\MeuPDF;

class PdfLeet_controller extends BaseController{

    public function pdfLeet(){
        $pedidos = $_GET['ids'];//implode(',', [ 56,57 ]);
        
        $mpdf = new MeuPDF();
        $data = [
            'pedido' => $this->pdfzinModel->carregaPedidos($pedidos)
        ];

        foreach($data['pedido'] as $pedido) {
            $pedido->produtos = $this->pdfzinModel->carregaProdutosPedidos($pedido->id_pedido);

             /* Endpoint */
            $url = 'https://gsplanaltec.com/GerenciamentoServicos/APIControle/s3files';
    
            /* eCurl */
            $curl = curl_init($url);
    
            /* Data */
            $SendData = [
                'file'=> $pedido->foto_pedido, 
                'path'=>'uploadLeet'
            ];
    
            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $SendData);
                
            /* Define content type */
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                
            /* Return json */
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
            /* make request */
            $result = curl_exec($curl);
                
            /* close curl */
            curl_close($curl);

            var_dump($result);
            exit;

            foreach($pedido->produtos as $produto) {
                $produto->acrescimos = $this->pdfzinModel->carregaAcrescimosProdutosPedidos($pedido->id_pedido, $produto->produtos_pedido);
            }
        }

		$html = view('pdforcamentoleet', $data);
		$this->response->setHeader('Content-Type', 'application/pdf');

        $config = [
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
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 3,
            'margin_header' => 3,
            'margin_footer' => 3,
        ];

		$mpdf->GerarPDF($html, 'meudoc', $config);
    }
}