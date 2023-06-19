<?php

namespace App\Controllers;
use App\Libraries\MeuPDF;

class pdfLeet_controller extends BaseController{

    public function pdfLeet(){
        $mpdf = new MeuPDF();

        $ids = $_POST['idsPedidos'];

        $data['list'] = $this->carregameupau->carregameupau($ids);

		$html = view('html_to_pdf', $data);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->GerarPDF($html);
    }
}