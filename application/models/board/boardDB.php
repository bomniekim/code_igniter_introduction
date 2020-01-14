<?php

    defined('BASEPATH') or exit('직접 접근 불가');

    class boardDB extends CI_Model{
        public function __construct(){
            parent::__construct();

        }

        // board 테이블의 레코드값 읽어오는 함수
        public function getBoard(){
            // database를 관리하는 DBMS(Mysql)에 접속
            
            // database.php에 설정된 데이터베이스 접속 데이터로 접속하기
            $this->load->database();

            // 위에서 로드하면 DB를 제어할 수 있는 객체($this->db)가 생성됨

            // $this->db를 이용해서 원하는 쿼리 작성( PDO 객체와 메소드가 다름)
            $result= $this->db->query('SELECT * FROM ci_board');

            //$result 객체에 쿼리의 결과를 배열로 달라고 요청할 수 있음
            $rows=$result->result_array();
            // result_array()는 쿼리의 결과를 2차원 배열로 리턴시켜 줌
            // 각 레코드는 연관배열로 되어 있음

            $this->db->close(); // 권장

            // 가져온 2차원 배열 데이터를 리턴
            return $rows;

        }

        // 데이터를 저장하는 메소드
        public function insertRecord($name, $msg){
            // DB접속
            $this->load->database();

            $data= array('name'=>$name, 'msg'=>$msg);
            $this->db->insert('ci_board', $data);

        }
    }


?>

