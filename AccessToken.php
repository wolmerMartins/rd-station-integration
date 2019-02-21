<?php
    require_once "ConstantToken.php";
    require_once "AccessTokenDB.php";

    class AccessToken {
        private $json;
        private $accessTokenDB;
        private $constants;

        public function __construct($conversion) {
            $this->setConstants(new ConstantToken());
            $this->setAccessTokenDB(new AccessTokenDB($conversion));
        }

        public function generateAccessToken() {
            $array = array("refresh_token" => $this->getConstants()->getRefreshToken(), "client_id" => $this->getConstants()->getClientId(), "client_secret" => $this->getConstants()->getClientSecret());
            $this->setJson(json_encode($array));

            $ch = curl_init("https://api.rd.services/auth/token");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getJson());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));

            $result = curl_exec($ch);
            curl_close($ch);

            $array = json_decode(rtrim($result), true);

            $this->getAccessTokenDB()->updateAccessToken($array['access_token']);
        }

        public function getAccessToken() {
            return $this->getAccessTokenDB()->getAccessToken();
        }

        public function getJson() {
            return $this->json;
        }

        public function setJson($json) {
            $this->json = $json;
        }

        public function getAccessTokenDB() {
            return $this->accessTokenDB;
        }

        public function setAccessTokenDB($accessTokenDB) {
            $this->accessTokenDB = $accessTokenDB;
        }

        public function getConstants() {
            return $this->constants;
        }

        public function setConstants($constants) {
            $this->constants = $constants;
        }
    }