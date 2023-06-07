<?php namespace App\Controllers;
use \Mpdf\Mpdf;
class pdfLeet_controller extends BaseController{

    public function pdfLeet(){

        $mpdf = new Mpdf;
       
		$html = view('html_to_pdf',[]);""
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output('arjun.pdf','I');

    }
}