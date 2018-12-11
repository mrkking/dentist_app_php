<?php
/**
 * Created by PhpStorm.
 * User: kking
 * Date: 12/9/18
 * Time: 10:45 AM
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../db.php';

class member {

    private $connection;
    private $table_name = "member";
    private $db = null;

    public function __construct($connection){
        $this->connection = $connection;
        $this->db = new db();
    }

    //C
    public function create($user_data){
        $sql = "INSERT INTO " . $this->table_name . " (email, first_name, last_name, password, phone, gender) VALUES (?,?,?,?,?,?)";

        $vars = [];
        foreach ($user_data as $val) {
           array_push($vars, $val);
        }
        try{
            $this->connection->prepare($sql)->execute($vars);
            return $this->getMemberByCredentials($user_data['email'], $user_data['password'])[0];
        } catch(PDOException $err) {
            http_response_code(400);
            switch ($err->getCode()) {
                case 23000:
                    return 'email already exists';
                default:
                    return 'failed to create';
            }
        }
    }
    //R
    public function read() {
        return $this->db->read($this->table_name);
    }

    public function getMemberByID($id){
        $stmt = $this->connection->query('select * from ' . $this->table_name . ' WHERE id =  "'. $id . '"');
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getMemberByCredentials($email, $password){
        $stmt = $this->connection->query('select * from ' . $this->table_name . ' WHERE email =  "'. $email . '" AND password = "' . $password . '"');
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    //U
    public function update($data){
        return $this->db->update($this->table_name, $data);
    }
    //D
    public function removeMember($id) {
        return $this->db->remove($this->table_name, $id);
    }
}