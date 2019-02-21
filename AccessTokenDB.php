<?php
    class AccessTokenDB {
        private $servername;
        private $username;
        private $password;
        private $connection;
        private $conversion;

        public function __construct($conversion) {
            $this->setConversion($conversion);
            $this->setRequired();
            $this->setServername("mysql:dbname=" . constant("DB_NAME"));
            $this->setUsername(constant("DB_USER"));
            $this->setPassword(constant("DB_PASSWORD"));
            $this->connectDB();
        }

        public function setRequired() {
            if ($this->isConversion()) {
                require_once "required_path";
            } else {
                require_once( ABSPATH . "required_path" );
            }
        }

        public function connectDB() {
            try {
                $this->setConnection(new PDO($this->getServername(), $this->getUsername(), $this->getPassword()));
                $this->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected Successfuly";
            } catch(PDOException $e) {
                echo "Connection Failed: " . $e->getMessage();
            }
        }

        public function saveAccessToken($token) {
            $sql = "INSERT INTO wp_rd_token VALUE (default, :token)";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(":token", $token);
            $stmt->execute();
            echo "</br>" . $stmt->rowCount() . " records ADDED successfully!";
        }

        public function updateAccessToken($token) {
            $sql = "UPDATE wp_rd_token SET token = :token";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(":token", $token);
            $stmt->execute();
            echo "</br>" . $stmt->rowCount() . " records UPDATED successfully!";
        }

        public function getAccessToken() {
            $sql = "SELECT token FROM wp_rd_token";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_LAZY);
            return $result["token"];
        }

        private function getServername() {
            return $this->servername;
        }

        private function setServername($servername) {
            $this->servername = $servername;
        }

        private function getUsername() {
            return $this->username;
        }

        private function setUsername($username) {
            $this->username = $username;
        }

        private function getPassword() {
            return $this->password;
        }

        private function setPassword($password) {
            $this->password = $password;
        }

        public function getConnection() {
            return $this->connection;
        }

        public function setConnection($connection) {
            $this->connection = $connection;
        }

        public function isConversion() {
            return $this->conversion;
        }

        public function setConversion($conversion) {
            $this->conversion = $conversion;
        }
    }