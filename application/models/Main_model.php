<?php
class Main_model extends CI_Model
{
    //Trata os caracteres para utf-8, tanto os de entrada como os de saída de dados.
    function __construct()
    {
        $this->load->database();
    }

    #
    #Login
    #
    public function get_user_data($username)
    {
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->result();
    }

    public function get_user_events_data($status)
    {
        if ($status == 1) 
            $query = $this->db->order_by('event_date', 'ASC')->order_by('event_hour', 'ASC')->get_where('events',array('status' => $status,'event_date >=' => date('Y-m-d')));
        else
            $query = $this->db->from('events')->order_by('event_date', 'ASC')->order_by('event_hour', 'ASC')->get();
        return $query->result();
    }

    public function register_event($event_data)
    {

        $insert_data = array(
            'title' => $event_data['event_title'],
            'user_id' => $_SESSION['user_id'],
            'description' => $event_data['event_description'],
            'event_date' => $event_data['event_date'],
            'event_hour' => $event_data['event_hour'],
            'image' => 'temp.jpg',
            'address' => $event_data['event_address']
        );

        $results = $this->db->insert('events', $insert_data);
        return $results;
    }

    public function get_last_event($user_id)
    {
        $sql = "SELECT id FROM events WHERE user_id = ? ";
        $query = $this->db->query($sql, array($user_id));
        return $query->result();
    }

    public function update_image_path($image, $event_id)
    {
        $update_data = array(
            'image' => $image,
        );

        $this->db->set($update_data);
        $this->db->where('id', $event_id);
        $results = $this->db->update('events');
        return $results;
    }

    public function get_event_data($event_id)
    {
        $query = $this->db->get_where('events', array('id' => $event_id));
        return $query->result();
    }

    public function edit_event($event_data)
    {

        $update_data = array(
            'title' => $event_data['event_title'],
            'description' => $event_data['event_description'],
            'event_date' => $event_data['event_date'],
            'event_hour' => $event_data['event_hour'],
            'address' => $event_data['event_address']
        );

        $this->db->set($update_data);
        $this->db->where('id', $event_data['event_id']);
        $results = $this->db->update('events');
        return $results;
    }

    #client
    public function delete_event($event_id)
    {
        $results = $this->db->delete('events', array('id' => $event_id));
        return $results;
    }

    public function status_event($event_id, $status)
    {
        $update_data = array(
            'status' => $status,
        );

        $this->db->set($update_data);
        $this->db->where('id', $event_id);
        $results = $this->db->update('events');
        return $results;
    }
}
