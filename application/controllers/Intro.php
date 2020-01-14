<?php

    // 경로: http://localhost/code_igniter/index.php/Intro


    // code igniter에서 코드를 웹에서 직접 접근하는 경우를 허용하지 않게 하는 코드
    defined('BASEPATH') or exit('직접 접근할 수 없습니다.');

    // 클래스명은 파일명과 같아야 함
    // controller는 CI_Controller를 상속받아야 함
    class Intro extends CI_Controller{
        // 이 컨트롤러 클래스인 Intro가 처음 실행될 때 별도의 지정이 없다면
        // 무조건 호출되는 메소드: index() (마치 index.html)
        public function index(){
            echo "Intro index!<br>";

            // echo로 화면을 만드는 것은 불편하고 코드가 복잡해짐
            // 화면에 보여지는 것들은 views 폴더 안에 별도의 문서로 제작하고
            // 이를 불러와서 보여주는 것이 더 효율적
            $this->load->view('intro_view'); // 문서명
            
        }
        
        // Intro를 실행할 때 특정 메소드를 지정해서 실행가능
        // http://localhost/code_igniter/index.php/Intro/show (마치 폴더경로 같음)
        // function의 이름을 Intro/뒤에 써주어 경로 실행
        
        public function show(){
            echo "Intro show!<br>";
            
            // 별도의 view 문서로 화면 설계하고 보여주기
            $this->load->view('intro_show');
            
            // 하나의 함수 안에서 여러 뷰 load 가능
            $this->load->view('intro_show2');

        }

        // index.php 경로를 중간에 나타내고 싶지 않다면
        // config/config.php-> $config['index_page'] = ''; + 루트폴더에 .htaccess 파일 설정


        // index.php가 아닌 Intro.php를 메인으로 만들고 싶으면
        // config/routes.php의 default_controller 설정


        // 이를 이용해서 웹페이지의 공통모듈 작업 가능
        // header.php, content.php, footer.php 등 따로 제작 가능
        public function module(){
            // add header view
            $this->load->view('module/header.php');
            // add content view
            $this->load->view('module/content.php');
        }

        // view에 데이터 전달하기
        public function transmit(){

            // 뷰를 load하면서 보내줄 데이터들을 연관배열로
            $data= array("name"=>"Sonny", "msg"=>"COYS");

            // views/trans/first.php를 load하면서 데이터 전달
            $this->load->view('trans/first', $data);
        }

        // 뷰를 로딩하여 화면에 보여주는 것이 아닌 문자열로 리턴
        public function returnView(){
            // 세번째 파라미터: 문자열로 리턴할 지 여부 (default: false)
            $str=$this->load->view('intro_view', '', true);
            echo "로딩한 뷰의 문자열 데이터: ".$str;
        }


        
        // 데이터를 관리하는 Model 문서에 대해 알아보기
        // application/models/Member.php를 만들어서 모델 문서 제작
        public function members(){

            // application/models/Member.php문서 로드하기
            $this->load->model('Member');

            // 위에서 로딩하면 이 컨트롤러 클래스의 객체(Intro)의 멤버변수로
            // Member라는 클래스객체 참조변수가 생김
            $name= $this->Member->getName();
            $msg= $this->Member->getMessage();
            // echo "$name, $msg";

            // 뷰에 전달할 연관배열
            $data=array();
            $data['name']=$name;
            $data['msg']=$msg;

            // 뷰 문서로 보여주기 위해 데이터 전달
            $this->load->view('member/member_view', $data);

            // ※참고※
            // 모델을 로딩하면 자동으로 Controller 클래스의 멤버변수가 만들어짐
            // 이때 기본 변수명은 Model클래스의 클래스명과 같음(73,74번줄처럼)
            // 변수명을 별명으로 변경 가능
            // $this->load->model('Member', 'aaa');
            // $this->aaa->getName();
            // $this->aaa->getMessage();
        }
        
        // code igniter의 데이터베이스 사용하기
        public function database(){
            // 모델 문서의 데이터를 데이터베이스에서 읽어오기
            // 그 작업은 모델 문서에서 실행

            $this->load->model('board/boardDB');

            $rows= $this->boardDB->getBoard();
            foreach($rows as $row){
                echo $row['num'].",".$row['name'].",".$row['msg']."<hr>";
            }

            // 뷰 문서를 이용하여 보여주기
            $data['rows']= $rows; // 뷰 문서에 보낼 데이터
            $this->load->view('trans/board_view', $data);


        }

        // DB에 값 입력하는 메소드
        public function insertBoard(){
            $name=$_POST['name'];
            $msg=$_POST['msg'];

            $this->load->model('board/boardDB');
            $this->boardDB->insertRecord($name, $msg);

            // 리스트를 보여주는 화면 로딩하는 메소드 실행
            $this->database();
        }

    }

?>