<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Dash_controller extends BaseController{

    public function index(){

        return view('login');

    }

    public function dashleet(){

        $data = [
            'pagina' => 'home'
        ];

        return view('Dashboard', $data);

    }



    function CadsCliente(){

       $data = [
            'pagina' => 'cadastroCliente'
        ];

        return view('Dashboard', $data);
    }

    function CadsProduto(){

        $data = [
             'pagina' => 'cadastroProduto'
         ];
 
         return view('Dashboard', $data);
     }

     function CadsUsuario(){

        $data = [
             'pagina' => 'cadastroUsuario'
         ];
 
         return view('Dashboard', $data);
     }

     function CadsAcrescimo(){

        $data = [
             'pagina' => 'CadsAcrescimo'
         ];
 
         return view('Dashboard', $data);
     }
}