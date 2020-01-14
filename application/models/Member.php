<?php

    // 모델(Models)은 데이터베이스와 연동해서 사용하기 위한 클래스


    // code igniter에서 코드를 웹에서 직접 접근하는 경우를 허용하지 않게 하는 코드
    defined('BASEPATH') or exit('직접 문서에 접근할 수 없습니다.');

    // code igniter에서 사용하는 모델 클래스 제작 (반드시 CI_Model 상속)
    class Member extends CI_Model{

        // 멤버변수
        private $name;
        private $msg;

        // 생성자
        public function __construct(){
            parent::__construct();

            $this->name="Sonny";
            $this->msg="Hello CI";

        }

        public function getName(){
            return $this->name;
        }
        public function getMessage(){
            return $this->msg;
        }

    }








?>