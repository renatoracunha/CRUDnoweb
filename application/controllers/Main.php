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

    #navibar
    public function logout()
    {
        session_unset();
        $this->view();
    }

    public function index()
    {
        $this->view();
    }

    public function view($page = 'landingpage', $param = '')
    {

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }



        $data['title'] = ucfirst($page); // Capitalize the first letter
        if ($page == 'client' || $page == 'landingpage') {//fetching event data in some cases.
            if ($page != 'client') 
               $event_status = 1;
            else
                $event_status = 0;
            $user_events = $this->Main_model->get_user_events_data($event_status);
            $data['events'] = $user_events;
        } else if ($page == 'editevent') {
            $data['event_data'] = $this->Main_model->get_event_data($param);
        }
        //loading pages by section
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
            //decrypting and testing password
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
        //setting a custom name to the image
        $last_inserted_id = $this->Main_model->get_last_event($_SESSION['user_id']);
        $filename = 'event_' . end($last_inserted_id)->id;
        $filename . '.' . $ext;
        $update_satus = $this->Main_model->update_image_path($filename, end($last_inserted_id)->id);
        //uploading the image to the server
        if ($update_satus) {
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/client_uploads/' . $filename;
            move_uploaded_file($_FILES["event_image"]["tmp_name"], $targetPath);
            $this->view('client');
        }else{
           echo "Erro no upload, procurar equipe de desenvolvimento";
        }
    }

    #edit event
    public function ajax_edit_event()
    {
        $event_data = $this->input->get();
        $update_satus = $this->Main_model->edit_event($event_data);
        echo json_encode($update_satus, JSON_UNESCAPED_UNICODE);
    }

    #client
    public function ajax_delete_event()
    {
        $event_id = $this->input->post('event_id');
        $delete_satus = $this->Main_model->delete_event($event_id);
        echo json_encode($delete_satus, JSON_UNESCAPED_UNICODE);
    }
    public function ajax_status_event()
    {
        $event_id = $this->input->post('event_id');
        $status = $this->input->post('status');
        $update_satus = $this->Main_model->status_event($event_id, $status);
        echo json_encode($update_satus, JSON_UNESCAPED_UNICODE);
    }
}
