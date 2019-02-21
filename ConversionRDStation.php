<?php
    require_once "AccessToken.php";
    require_once "ConstantConversion.php";

    class ConversionRDStation {
        private $accessToken;
        private $constants;
        private $client;

        public function __construct($client) {
            $this->setAccessToken(new AccessToken(true));
            $this->setConstants(new ConstantConversion());
            $this->setClient($client);
        }

        public function convertToRDStation() {
            $data = array("event_type" => $this->getConstants()->getEventType(), "event_family" => $this->getConstants()->getEventFamily(), "payload" => $this->getClient());
            
            $ch = curl_init("https://api.rd.services/platform/events");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $this->getAccessToken()->getAccessToken()));

            $result = curl_exec($ch);
            curl_close($ch);
        }

        public function getAccessToken() {
            return $this->accessToken;
        }

        public function setAccessToken($accessToken) {
            $this->accessToken = $accessToken;
        }

        public function getConstants() {
            return $this->constants;
        }

        public function setConstants($constants) {
            $this->constants = $constants;
        }

        public function getClient() {
            return $this->client;
        }

        public function setClient($client) {
            $this->client = $client;
        }
    }