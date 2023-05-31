<?php

namespace App\Controllers;

class Login_Controller extends BaseController {
    
    public function login() {
        if($this->session->get('id') != ''){
            return redirect()->route('clientes');
        }
        return view('login');
    }

    public function verificaLogin() {
        if(isset($_POST['usuario']) && isset($_POST['senha'])) {
            $res = Login_Controller::_checkLogin($_POST);

            if(!empty($res)) {
                $newdata = [
                    'id'  => $res['id'],
                    'usuario'  => $res['usuario'],
                    'logged_in' => true,
                ];
                
                $this->session->set($newdata);
                
                $res = true;    
            }
        } else {
            $res = false;
        }

        echo json_encode($res);
        
    }

    private function _checkLogin($post) {
        $usuario = $post['usuario'];
        $senha = SHA1(MD5($post['senha']));

        return $this->usuarioModel->checkLogin($usuario, $senha);
    }

    public function logout() {
        return false;
    }

}