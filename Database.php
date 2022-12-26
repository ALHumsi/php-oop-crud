<?php

    class Database
    {
        private $serverName = 'localhost';
        private $userName = 'root';
        private $password = '';
        private $dbName = 'softcompany';

        private $conn;

        public function __construct()
        {
            $this->conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
            if(!$this->conn)
            {
                die("Error: ". mysqli_connect_error());
            }
        }


        public function insert($sql)
        {
            if(mysqli_query($this->conn, $sql))
            {
                return header("Location: employees.php");
            }
            else
            {
                die("Error: ". mysqli_error($this->conn));
            }
        }

        public function update($sql)
        {
            if(mysqli_query($this->conn, $sql))
            {
                return header("Location: employees.php");
            }
            else
            {
                die("Error: ". mysqli_error($this->conn));
            }
        }

        public function inc_password($password)
        {
            return sha1($password);
        }

        public function read($table)
        {
            $sql = "SELECT * FROM $table";
            $result = mysqli_query($this->conn, $sql);
            $data = [];
            if($result)
            {
                if(mysqli_num_rows($result))
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $data[] = $row;
                    }
                }
                return $data;
            }
            else
            {
                die("Error: ". mysqli_error($this->conn));
            }
        }

        public function find($table, $id)
        {
            $sql = "SELECT * FROM $table WHERE `id` = '$id'";
            $result = mysqli_query($this->conn, $sql);
            if($result)
            {
                 if(mysqli_num_rows($result))
                 {
                     return mysqli_fetch_assoc($result);
                 }
                 return false;
            }
            else
            {
                die("Error: ". mysqli_error($this->conn));
            }
        }

        public function delete($table, $id)
        {
            $sql = "DELETE FROM $table WHERE `id` = '$id'";
            if(mysqli_query($this->conn, $sql))
            {
                return header("Location: employees.php");
            }
            else
            {
                die("Error: ". mysqli_error($this->conn));
            }
        }
    }