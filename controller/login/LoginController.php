<?php
session_start();
require_once("../../includes/database/DatabaseConnection.php"); // include database connection

class LoginController extends DatabaseConnection
{
    public $base_url = "http://localhost/sarkar/php/Exercise/oopems/"; //base_url
    public function authenticateLogin($logInData)
    {
        $where  = "email='" . $logInData['email'] . "' and '" . $logInData['password'] . "'";
        $sql    = "SELECT id,fname,email FROM $this->table_employinfo WHERE $where"; // RAW Query
        $result = $this->conn->query($sql); //passing the query to MYSql Server
        $row    = mysqli_fetch_assoc($result); // formatting the returned query
        return $row; // returning the formatted result
    }

    public function getLoginData($data)
    {
        if (!empty($data)) {
            $result = $this->validateLoginData($data); // send data to next function for next operation and returned value assigned to $result.
            if ($result) {
                $authenticate = $this->authenticateLogin($data); // when data stored successfully then it returns true
                if (!empty($authenticate)) { //when store is true then redirect to index page
                    $_SESSION['fname']=$authenticate['fname'];
                    header('Location:' .  $this->base_url.'index.php?page=dashboard');

                } else {
                    $_SESSION['loginFaild_msg'] = "input did not match";
                    header('Location: ' . $this->base_url . 'index.php?page=login');

                }
            }
        }
    }

    public function validateLoginData($logInData)
    {

        if (isset($logInData['email']) && empty($logInData['email'])) {
            $_SESSION['error_message']['email_error'] = "Email required";
        } else {
            unset($_SESSION['error_message']['email_error']);
        }
        if (isset($logInData['password']) && empty($logInData['password'])) {
            $_SESSION['error_message']['password_error'] = "Password is required";

        } else {
            unset($_SESSION['error_message']['password_error']);
        }

        if (count($_SESSION['error_message']) > 0) {
            header('Location: ' . $this->base_url . 'index.php?page=login');

        } else {
            return true;
        }
    }
    public function logOut($logoutData){

        if ($logoutData['user'] == $_SESSION['fname']){
//            var_dump($logoutData['fname']);exit();
            session_unset();
            session_destroy();
            header('Location: ' . $this->base_url . 'index.php?page=login');
        }
    }
}
$login = new LoginController();


if(isset($_POST['page_source']) && $_POST['page_source'] == 'login_page' ){

    $login->getLoginData($_POST);
}

if($_POST['page_source'] == 'logout_page' )
{

    $data = $_POST;
    $login->logOut($data);

}



unset($_SESSION['loginFaild_msg']);


