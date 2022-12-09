<?php
session_start();
require_once("../../include/database/DatabaseConnection.php");

class EmployeeController extends DatabaseConnection
{
    public $base_url = "http://localhost/sarkar/php/Exercise/oopems/";

    public function InsertToDatabase($data)
    {
        $columns        = implode(", ", array_keys($data));
        $escaped_values = array_map(array($this->conn, 'real_escape_string'), array_values($data));
        $values         = implode("', '", $escaped_values);
        $sql            = "INSERT INTO $this->table_employinfo ($columns) VALUES ('$values')";
        if ($this->conn->query($sql) === TRUE) {
            $this->FinalActionAfterInsertToDatabase($data);
        } else {
            return false;
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }

    }

    public function FinalActionAfterInsertToDatabase($data)
    {
        if (!empty($data)) {
            header('Location: ' . $this->base_url . 'index?page=employee-add');
            $_SESSION['success_msg'] = "Record Successful";
            exit();
        }
    }

    public function EmployeeReadFromDatabase()
    {
        $sql    = "SELECT * FROM $this->table_employinfo";
        $result = $this->conn->query($sql);
        $rows   = $result->fetch_all(MYSQLI_ASSOC);
        return $rows; // returning the formatted result
    }

    public function EmployeeReadFromDatabaseSingle()
    {
//        $sql    = "SELECT * FROM $this->table_employinfo where id = 1";
//        $result = $this->conn->query($sql);
//        $row   = mysqli_fetch_assoc($result);
//        return $row;
    }

    public function DatabaseUpdate($data)
    {
//        $sql_values = '';
//        $sep        = '';
//        foreach ($updateData as $key => $val) {
//            $sql_values .= $sep . '' . $key .' = ';
//            $sql_values .=  "'".$this->conn->real_escape_string($val)."'";
//            $sep        = ', ';
//        }
//        $sql = "update $this->table set $sql_values where id = " . $this->conn->real_escape_string($id);
//
//        if ($this->conn->query($sql) === TRUE) {
//            return true;
//        } else {
//            echo "Error: " . $sql . "<br>" . $this->conn->error;
//        }
    }

    public function FinalActionAfterDatabaseUpdate($Data)
    {
//        if (!empty($updateData)) {
//            $result = $this->validateData($updateData);
//            if ($result) {
//                unset($updateData['update_data']);
//                $inserted = $this->dbUpdateQuery($updateData);
//                if ($inserted) {
//                    header("location: index.php");
//                    $_SESSION['updateSuccess_msg'] = "Updated Successfully";
//                    exit();
//                }
//            }
//        }
    }

    public function DeleteFromDatabase($data)
    {
//        $id     = $deleteid;
//        $sql    = "DELETE from $this->table where id = $id";
//        $result = mysqli_query($this->conn, $sql);
//        if ($result) {
//            return true;
//        } else {
//            echo "Error: " . $sql . "<br>" . $this->conn->error;
//        }
    }

    public function FinalActionAfterDeleteFromDatabase($data)
    {
//        if (isset($deleteid)) {
//            $result = $this->dbDeleteQuery($deleteid);
//            if ($result) {
//                header("location: index.php");
//                $_SESSION['delSuccess_msg'] = "Deleted Successfully";
//                exit();
//            }
//        }
    }

    public function ValidateUserInput($data)
    {
        $_SESSION['error_message'] = [];
        if (isset($data['fname']) && empty($data['fname'])) {
            $_SESSION['error_message']['fnameErr'] = "First name is required";
        } else {
            unset($_SESSION['error_message']['fnameErr']);
        }
        if (isset($data['lname']) && empty($data['lname'])) {
            $_SESSION['error_message']['lnameErr'] = "Last name is required";

        } else {
            unset($_SESSION['error_message']['lnameErr']);
        }
        if (isset($data['email']) && empty($data['email'])) {
            $_SESSION['error_message']['emailErr'] = "Email is required";

        } else {
            unset($_SESSION['error_message']['emailErr']);
        }
        if (isset($data['mobile']) && empty($data['mobile'])) {
            $_SESSION['error_message']['mobileErr'] = "Mobile is required";

        } else {
            unset($_SESSION['error_message']['mobileErr']);
        }
        if (isset($data['address']) && empty($data['address'])) {
            $_SESSION['error_message']['addressErr'] = "Address is required";

        } else {
            unset($_SESSION['error_message']['addressErr']);
        }
        if (isset($data['bgroup']) && empty($data['bgroup'])) {
            $_SESSION['error_message']['bgroupErr'] = "Blood group is required";

        } else {
            unset($_SESSION['error_message']['bgroupErr']);
        }
        if (isset($data['height']) && empty($data['height'])) {
            $_SESSION['error_message']['heightErr'] = "Height is required";

        } else {
            unset($_SESSION['error_message']['heightErr']);
        }
        if (isset($data['designation']) && empty($data['designation'])) {
            $_SESSION['error_message']['designationErr'] = "Designation is required";

        } else {
            unset($_SESSION['error_message']['designationErr']);
        }
        if (isset($data['team']) && empty($data['team'])) {
            $_SESSION['error_message']['teamErr'] = "Team is required";

        } else {
            unset($_SESSION['error_message']['teamErr']);
        }

        if (count($_SESSION['error_message']) > 0) {
            header('Location: ' . $this->base_url . 'index?page=employee-add');
        } else {
            unset($_SESSION['error_message']);
            $this->InsertToDatabase($data);
        }
    }
}

$objEmployeeController = new EmployeeController();

$data = $_POST;
$objEmployeeController->ValidateUserInput($data);













