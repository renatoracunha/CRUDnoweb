<?php
class Main_model extends CI_Model
{
    //Trata os caracteres para utf-8, tanto os de entrada como os de saída de dados.
    function __construct()
    {
        $this->load->database();
        //$this->db->query( "SET NAMES 'utf8'" );
    }

    #
    #Login
    #
    public function get_user_data($username)
    {
        // $query = $this->db->get('users');
        $query = $this->db->get_where('users', array('username' => $username));
        // print_r($query->result());exit;
        return $query->result();
        /*
            return true;
        else
            return false;*/
        // print_r($query->result());exit;

        // print_r($query->result());
        // exit;
        /*$stmt = $this->db->prepare("SELECT * from users");

		// $stmt->bindValue(':TELEFONE', $telefone, PDO::PARAM_STR);
		// $stmt->bindValue(':SENHA', $senha, PDO::PARAM_STR);

		$stmt->execute();

		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);*/

        //return $query->result();
    }

    public function get_user_events_data($user_id)
    {
        $query = $this->db->get_where('events', array('user_id' => $user_id));
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
}
