<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mypdo extends CI_Controller{


    function __construct() {
            parent::__construct();
        }

    function index(){
        $data = array(
            'title' => 'PDO Testing',
            'content' => 'pdo/pdo_view',
            'msg' => 'message',
            'page_title' => 'PDO Testing',
        );
        $this->load->view('page', $data);
    }

    function test(){
        $host = 'localhost';
        $db_name = 'machoui_stuff';
        $username = 'machoui_php';
        $password = 'Skipper1';
        $table = 'podcasts';
        $number = 500;

        try{
            $conn = new PDO('mysql:host=localhost;dbname=machoui_stuff', $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare('SELECT * FROM podcasts WHERE number = :number');
            $stmt->execute(array('number' => $number));

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($result)){
                foreach($result as $row){
                    print_array($row);
                }
            }else{
                echo 'No records found.';
            }



    } catch(PDOException $e){
        echo 'ERROR: ' . $e->getMessage();
    }








    }
}
?>