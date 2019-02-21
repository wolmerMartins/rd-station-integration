<?php
    class ConstantToken {
        private $refreshToken = "refresh_token";
        private $clientId = "client_id";
        private $clientSecret = "client_secret";

        public function getRefreshToken() {
            return $this->refreshToken;
        }

        private function setRefreshToken($refreshToken) {
            $this->refreshToken = $refreshToken;
        }

        public function getClientId() {
            return $this->clientId;
        }

        private function setClientId($clientId) {
            $this->clientId = $clientId;
        }

        public function getClientSecret() {
            return $this->clientSecret;
        }

        private function setClientSecret($clientSecret) {
            $this->clientSecret = $clientSecret;
        }
    }