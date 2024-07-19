<?php
class UserController extends BaseController
{
    private function genToken($username, $uid, $is_admin)
    {
        $issuedAt   = new DateTimeImmutable();
        $expire     = $issuedAt->modify('+30 days')->getTimestamp();      
       
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);
        $payload =  json_encode([
            'iat'  => $issuedAt->getTimestamp(),         
            'nbf'  => $issuedAt->getTimestamp(),        
            'exp'  => $expire,                         
            'username' => $username,
            'uid' => $uid,
            'is_admin' => $is_admin
        ]);

        //encode 
        $base64UrlHeader = base64UrlEncode($header);
        $base64UrlPayload = base64UrlEncode($payload);
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, SECRET, true);
        $base64UrlSignature = base64UrlEncode($signature);

        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }
    private function validate_token($jwt)
    {
        $tokenParts = explode('.', $jwt);
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signatureProvided = $tokenParts[2];

       


        // Check secret
        $base64UrlHeader = base64UrlEncode($header);
        $base64UrlPayload = base64UrlEncode($payload);
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, SECRET, true);
        $base64UrlSignature = base64UrlEncode($signature);

        $signatureValid = ($base64UrlSignature === $signatureProvided);

        $data = json_decode($payload, true);
        $now = new DateTimeImmutable();
        $exp = intval($data['exp']);

        $tokenExpired = $exp - $now->getTimestamp();

        if ($signatureValid && ($tokenExpired > 0))
            return array(
                "username" => $data['username'],
                "uid" => $data['uid'],
                "is_admin" => $data['is_admin'],
            );
        return null;
    }
    public function login()
    {
        $arr_cookie_options = array(
            'expires' => time() + 60 * 60 * 24 * 30,
            'path' => '/',
            'secure' => true,
            'httponly' => true,
        );
        if (isset($_COOKIE['token'])) {
            $value = $this->validate_token($_COOKIE['token']);
            if ($value != NULL && empty($_SESSION['username'])) {
                $_SESSION['username'] = $value['username'];
                $_SESSION['uid'] = $value['uid'];
                $_SESSION['is_admin'] = intval($value['is_admin']);
            }
        }
        if (!empty($_SESSION['username'])) {
            $this->redirect("home", "view");
        }
        if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
            $result = $this->User->login($_REQUEST['username'], $_REQUEST['password']);
            if (count($result) == 1) {
                $_SESSION['username'] = $result['User']['username'];
                $_SESSION['uid'] = $result['User']['id'];
                $_SESSION['is_admin'] = intval($result['User']['is_admin']);
                if (isset($_REQUEST['remember'])) {
                    setcookie("token", $this->genToken($_SESSION['username'], $_SESSION['uid'], $_SESSION['is_admin']), $arr_cookie_options);
                }
                $this->redirect("home", "view");
            } else
                $this->set("message", "Invalid username or password");
        } else {
        }
    }


    public function logout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['uid']);
        unset($_SESSION['is_admin']);
        setcookie('token', null, -1, '/'); 

        header('Location:' . (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "?url=home/view"));
    }

    public function signup()
    {
        if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            $user = $this->User->getOne($username);
            if (count($user) > 0) {
                $this->set("message", "Username already exist!");
                return;
            } else {
                $result = $this->User->createOne($username, hash_password($password));
                if ($result == 0){
                    $this->set("message", $this->User->getError());
                }else{
                $this->redirect("user", "login");
                }
            }
        }
    }
}
