<?php

class DatabaseConnection{ //db credentials

    protected $host = "localhost";
    protected $user = "root";
    protected $password = "";
    protected $db = "oop_db";
    protected $table_salaryinfo = "ems_salary";
    protected $table_employinfo = "ems_users";
    protected $conn = "";

    public function __construct(){ //when calss name and function name is same then the function works as __construct
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db); // connection with db credential
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
