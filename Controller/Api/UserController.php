<?php
// CODE BASED ON REST API TUTORIAL
class UserController extends BaseController

{
    /** 
* "/user/list" Endpoint - Get list of users 
*/

    //function which takes the user input from the frontend and passes to UserModel to verify credentials using SQL statement
    public function loginAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            try {
                 /** 
* Getting model for input
*/
                $userModel = new UserModel();
                //grabbing user input
                $data = json_decode(file_get_contents('php://input'), true);
                $arrUser = $userModel->getUsers($data);
                    /** 
* Checking if it goes through: 
*/
                if ($arrUser){
                    $response = json_encode(['msg' => 'User logged in!', 'data' => $arrUser[0], 'code' => 0]);
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
//register function which inputs new user into the database
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
//displays all of the songs in the ratings table 
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
//function to insert a new song based on user input
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

//given an id, function is updated to user input
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
//given id, song gets deleted from ratings table
    public function deleteSongAction(){
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $strErrorDesc = '';
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $songModel = new SongModel();
                $data = json_decode(file_get_contents('php://input'), true);
                $arrUser = $songModel->deleteSong($data);
                $response = json_encode(['msg'=>'Song deleted!']);
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
