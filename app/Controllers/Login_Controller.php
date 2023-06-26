<?php

namespace App\Controllers;

class Login_Controller extends BaseController {

    public function login() {
        return view('login');
    }

    
    private function _checkLogin($post) {
        $usuario = $post['usuario'];
        $senha = SHA1(MD5($post['senha']));
        return $this->usuarioModel->checkLogin($usuario, $senha);
    }

    public function verificaLogin() {
        $retorno = false;

        if(isset($_POST['usuario']) && isset($_POST['senha'])) {
            $res = $this->user_model->checkLogin(["usuario" => $_POST['usuario'], "senha" => SHA1(MD5($_POST['senha']))]);

            if(!empty($res)) {
                $newdata = [
                    'id'  => $res['id_usuario'],
                    'usuario'  => $res['usuario'],
                    'logged_in' => true,
                ];
                
                $this->session->set($newdata);
                
                $retorno = true;    
            }
        }

        echo json_encode($retorno);
        
    }

    public function logout() {
        session()->destroy();
    
        return redirect()->route('login');
    }


}