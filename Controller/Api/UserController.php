<?php
class UserController extends BaseController

{
    /** 
* "/user/list" Endpoint - Get list of users 
*/
    public function loginAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();
                $data = json_decode(file_get_contents('php://input'), true);
                // if(isset($data['username']) && isset($data['password'])) {               
                //     $user = $data['username'];
                //     $pass = $data['password'];
                // }
                // $user = $data['username'];
                // $pass = $data['password'];
                $arrUser = $userModel->getUsers($data['username'], $data['password']);
                if ($arrUser){
                    $response = json_encode(['msg' => '', 'data' => $arrUser[0], 'code' => 0]);
                } else  {
                    $response = json_encode(['msg' => 'username or password is not correct', 'code'=>1]);
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $response,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function createAction() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $strErrorDesc = '';

        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();
                $data = json_decode(file_get_contents('php://input'), true);
                $arrUser = $userModel->insertUser($data);
                $response = json_encode(['msg'=>'User registered!']);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $response,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
        }

    public function songlistAction() {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $songModel = new SongModel();
                $arrUsers = $songModel->getRatings();
                $fullarr = array();
                if ($arrUsers){
                    for ($i = 0; $i < count($arrUsers); $i++) {
                        $fullarr[] = $arrUsers[$i];
                    $response = json_encode(['msg' =>'', 'data'=> $fullarr,'code' =>0]);
                    }
                }else {
                    $response = json_encode(['msg'=> 'no songs found', 'code'=>1]);
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $response,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function songinsertAction(){
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $strErrorDesc = '';
        if (strtoupper($requestMethod) == 'POST') {
            try{
                $songModel = new SongModel();
                $data = json_decode(file_get_contents('php://input'), true);
                $arrUser = $songModel->insertRating($data);
                $response = json_encode(['msg'=>'Song inserted!']);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage(). 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        }else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $response,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function songDeleteAction(){
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $strErrorDesc = '';
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $songModel = new SongModel();
                $data = json_decode(file_get_contents('php://input'),true);
                $arrUser = $songModel->deleteRating($data);
                $response = json_encode(['msg'=> 'Song deleted']);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage(). 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        }else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $response,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function updateSongAction(){
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $strErrorDesc = '';
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $songModel = new SongModel();
                $data = json_decode(file_get_contents('php://input'), true);
                $arrUser = $songModel->updateSong($data);
                if ($arrUser){
                    $response = json_encode(['msg'=> 'Song is now updated to ', 'data' => $arrUser[0], 'code' => 0]);
                } else {
                    $response = json_encode(['msg' => 'Could not update the song!', 'code' => 1]);
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $response,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}