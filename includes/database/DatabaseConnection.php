<?php

class DatabaseConnection{ //db credentials

    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $db = "oop_db";
    public $table_salaryinfo = "ems_salary";
    public $table_employinfo = "ems_users";
    public $conn = "";

    public function __construct(){ //when calss name and function name is same then the function works as __construct
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db); // connection with db credential
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}