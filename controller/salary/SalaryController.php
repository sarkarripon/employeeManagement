<?php

session_start();
require_once("../../include/database/DatabaseConnection.php");


class SalaryController extends DatabaseConnection
{
    public $base_url = "http://localhost/sarkar/php/Exercise/oopems/";

    public function InsertToDatabase($data)
    {
        $columns        = implode(", ", array_keys($data));
        $escaped_values = array_map(array($this->conn, 'real_escape_string'), array_values($data));
        $values         = implode("', '", $escaped_values);
        $sql            = "INSERT INTO $this->table_salaryinfo ($columns) VALUES ('$values')";
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
                    header('Location: ' . $this->base_url . 'index?page=salary-add');
                    $_SESSION['success_msg'] = "Record Successful";
                    exit();
                }
    }

    public function EmployeeReadFromDatabase()
    {
//        $sql    = "SELECT * FROM $this->table_employinfo";
//        $result = $this->conn->query($sql);
//        $rows   = $result->fetch_all(MYSQLI_ASSOC);
//        return $rows; // returning the formatted result
    }

    public function EmployeeReadFromDatabaseSingle()
    {
//        $sql    = "SELECT * FROM $this->table_employinfo where id = 1";
//        $result = $this->conn->query($sql);
//        $row   = mysqli_fetch_assoc($result);
//        return $row;
    }

    public function SalaryReadFromDatabase()
    {
//        $sql    = "SELECT * FROM $this->table_salaryinfo";
//        $result = $this->conn->query($sql);
//        $rows   = $result->fetch_all(MYSQLI_ASSOC);
//        return $rows;
    }

    public function SalaryReadFromDatabaseSingle($id)
    {
//        $sql    = "SELECT * FROM $this->table_employinfo where id = $id";
//        $result = $this->conn->query($sql);
//        $row   = mysqli_fetch_assoc($result);
//        return $row;
    }

    public function DatabaseUpdate($updateData)
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

    public function FinalActionAfterDatabaseUpdate($updateData)
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

    public function DeleteFromDatabase($deleteid)
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

    public function FinalActionAfterDeleteFromDatabase($deleteid)
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
        if (isset($data['emid']) && empty($data['emid'])) {
            $_SESSION['error_message']['emErr'] = "Please select an employee";
        } else {
            unset($_SESSION['error_message']['emErr']);
        }
        if (isset($data['amount']) && empty($data['amount'])) {
            $_SESSION['error_message']['amountErr'] = "Amount is required";

        } else {
            unset($_SESSION['error_message']['amountErr']);
        }
        if (isset($data['year']) && empty($data['year'])) {
            $_SESSION['error_message']['yearErr'] = "Year is required";

        } else {
            unset($_SESSION['error_message']['yearErr']);
        }
        if (isset($data['month']) && empty($data['month'])) {
            $_SESSION['error_message']['monthErr'] = "Month is required";

        } else {
            unset($_SESSION['error_message']['monthErr']);
        }

        if (count($_SESSION['error_message']) > 0) {
            header('Location: ' . $this->base_url . 'index?page=salary-add');
        } else {
            $this->InsertToDatabase($data);
        }
    }
}

$dbConncetion = new SalaryController();

$data = $_POST;
$dbConncetion->ValidateUserInput($data);













