<?php
namespace Classes;

class Sanitize {
    public function sanitize_name_string($name) {
        if (empty($name)) {
            $this->respond('Username or fullname cannot be empty.');
        }

        if (preg_match('/[!@#$%^&*(),?":{}|<>]/', $name) || $this->contains_html($name)) {
            $this->respond('Username or fullname cannot contain any special characters or HTML tags.');
        }
        return $this->clean_input($name);
    }

    public function sanitize_email_string($email) {
        if (empty($email)) {
            $this->respond('Email cannot be empty.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->respond('Invalid email format.');
        }
        return $this->clean_input($email);
    }

    public function sanitize_number($number) {
        if (empty($number)) {
            $this->respond('Number cannot be empty.');
        }

        if (!preg_match('/^[0-9]+$/', $number)) {
            $this->respond('Invalid number format.');
        }
        return $this->clean_input($number);
    }

    public function sanitize_country($country) {
        $validCountries = ['Australia', 'New Zealand', 'other'];
        
        if (empty($country)) {
            $this->respond('Country cannot be empty.');
        }
        
        if (!in_array($country, $validCountries)) {
            $this->respond('Please select a valid country.');
        }
        return $this->clean_input($country);
    }

    private function contains_html($string) {
        return $string !== strip_tags($string);
    }

    private function clean_input($input) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    private function respond($message, $status = 422) {
        http_response_code($status);
        echo json_encode(['status' => 'error', 'message' => $message]);
        exit;
    }
}
