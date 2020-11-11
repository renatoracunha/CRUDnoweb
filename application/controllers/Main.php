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

    public function view($page = 'login', $param = '')
    {

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }



        $data['title'] = ucfirst($page); // Capitalize the first letter
        if ($page == 'client') {
            $user_events = $this->Main_model->get_user_events_data($_SESSION['user_id']);
            $data['events'] = $user_events;
        } else if ($page == 'editevent') {
            $data['event_data'] = $this->Main_model->get_event_data($param);
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


    #register event
    public function ajax_register_event()
    {
        $event_data = $this->input->get();
        $insert_satus = $this->Main_model->register_event($event_data);
        echo json_encode($insert_satus, JSON_UNESCAPED_UNICODE);
    }

    public function upload_image()
    {
        $ext = explode('.', $_FILES["event_image"]['name']);
        $ext = end($ext);

        $last_inserted_id = $this->Main_model->get_last_event($_SESSION['user_id']);
        $filename = 'event_' . end($last_inserted_id)->id;
        // print_r($filename);
        // exit;

        // $ext = explode($_FILES["event_image"], '.');
        // $ext = end($ext);
        // $targetPath = './imagens/' . $_FILES['imagem_produto']['name'];
        $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/client_uploads/' . $filename . '.' . $ext;
        move_uploaded_file($_FILES["event_image"]["tmp_name"], $targetPath);
        $this->view('client');
    }

    #edit event
    public function ajax_edit_event()
    {
        $event_data = $this->input->get();
        $update_satus = $this->Main_model->edit_event($event_data);
        echo json_encode($update_satus, JSON_UNESCAPED_UNICODE);
    }
}
