<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
        $this->load->helper('url_helper');
        session_start();
        $this->load->library('encryption');
    }

    public function index()
    {
        $this->view();
    }

    public function view($page = 'login')
    {

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if ($page == 'client') {
            $user_events = $this->Main_model->get_user_events_data($_SESSION['user_id']);
            $data['events'] = $user_events;
        }
        $this->load->view('templates/header', $data);
        if ($page != 'login')
            $this->load->view('templates/navbar');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }
    // client
    public function ajax_get_user_data()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if ($username == '' || $password == '') {
            $login_data['status'] = false;
            $login_data['msg'] = 'Informações incompletas';
        } else {
            $user_data = $this->Main_model->get_user_data($username);
            if ($password == $this->encryption->decrypt($user_data[0]->password)) {
                $login_data['status'] = true;
                $login_data['msg'] = '';
                $_SESSION['user_id'] = $user_data[0]->id;
            } else {
                $login_data['status'] = false;
                $login_data['msg'] = 'Login ou Password errado';
            }
        }
        echo json_encode($login_data, JSON_UNESCAPED_UNICODE);
    }

    public function ajax_register_event()
    {
        $event_data = $this->input->get();
        $insert_satus = $this->Main_model->register_event($event_data);
        echo json_encode($insert_satus, JSON_UNESCAPED_UNICODE);
    }

    public function upload_image()
    {
       
        print_r($_FILES["event_image"]);exit;
        $table = 'events';
        $last_inserted_id = $this->Main_model->get_last_id($table,$_SESSION['user_id']);
        //print_r($last_inserted_id);exit;
        $filename = 'event_'.$last_inserted_id;
        $ext = $_FILES["imagem_produto"];
        // $targetPath = './imagens/' . $_FILES['imagem_produto']['name'];
        $targetPath = base_url('/assets/images/client_uploads/'.$filename).$ext;
        move_uploaded_file($_FILES["imagem_produto"]["tmp_name"], $targetPath);
        $this->view('client');
    }
}
