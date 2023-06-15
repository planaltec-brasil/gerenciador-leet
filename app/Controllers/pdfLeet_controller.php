<?php

namespace App\Controllers;
use App\Libraries\MeuPDF;

class pdfLeet_controller extends BaseController{

    public function pdfLeet(){
        $mpdf = new MeuPDF();
		$html = view('html_to_pdf');
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->GerarPDF($html);
    }
}