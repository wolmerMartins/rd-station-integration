<?php
    class ConstantConversion {
        private $event_type = "CONVERSION";
        private $event_family = "CDP";

        public function getEventType() {
            return $this->event_type;
        }

        private function setEventType($event_type) {
            $this->event_type = $event_type;
        }

        public function getEventFamily() {
            return $this->event_family;
        }

        private function setEventFamily($event_family) {
            $this->event_family = $event_family;
        }
    }