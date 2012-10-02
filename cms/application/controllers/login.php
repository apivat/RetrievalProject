<?php

class Login extends Controller {

    function Login() {
        parent::Controller();
    }

    function index() {
        $data['title'] = 'Login';

        $this->session->sess_destroy();

        if ($_POST) {
            if ($this->login_model->checkLogin()) {
                redirect('/home');
            } else {
                $data['status'] = 'false';
            }
        }

        $this->load->view('login', $data);
    }

}