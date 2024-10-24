<?php
namespace Classes;

require_once __DIR__ . '/Database.class.php';
require_once __DIR__ . '/Sanitize.class.php';
require_once __DIR__ . '/SessionManager.class.php';

use Classes\Database;
use Classes\Sanitize;
use Classes\SessionManager;

session_start();

class FormSubmissionController extends Database {
    private $sanitize;
    private $session;

    public function __construct() {
        parent::__construct();
        $this->sanitize = new Sanitize();
        $this->session = new SessionManager();
    }

    private function create_services_table() {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS services (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                fullname VARCHAR(255) NOT NULL,
                contactno VARCHAR(30) NOT NULL,
                zipcode INT(8) NOT NULL,
                services VARCHAR(255) NOT NULL,
                date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                date_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL
            )";

            $this->conn->exec($sql);

        } catch (\Throwable $t) {
            $this->handleError($t);
        }
    }

    private function create_contacts_table() {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS contacts (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                fullname VARCHAR(255) NOT NULL,
                contactno VARCHAR(30) NOT NULL,
                email VARCHAR(255) NOT NULL,
                country VARCHAR(255) NOT NULL,
                message VARCHAR(255) NOT NULL,
                date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                date_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL
            )";

            $this->conn->exec($sql);

        } catch (\Throwable $t) {
            $this->handleError($t);
        }
    }

    private function insertDataToServicesTable($fullname, $contactno, $zipcode, $services) {
        $this->create_services_table();

        try {
            // Check if the user already exists
            // $this->checkUserExists($email, $username);

            $stmt = $this->conn->prepare("INSERT INTO services (fullname, contactno, zipcode, services) VALUES (:fullname, :contactno, :zipcode, :services)");
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':contactno', $contactno);
            $stmt->bindParam(':zipcode', $zipcode);
            $stmt->bindParam(':services', $services);

            if (!$stmt->execute()) {
                throw new Exception("Error inserting data.");
            }

            return true;
        } catch (\Throwable $t) {
            $this->handleError($t);
        }
    }

    private function insertDataToContactsTable($fullname, $contactno, $email, $country, $message) {
        $this->create_contacts_table();

        try {
            // Check if the user already exists
            // $this->checkUserExists($email, $username);

            $stmt = $this->conn->prepare("INSERT INTO contacts (fullname, contactno, email, country, message) VALUES (:fullname, :contactno, :email, :country, :message)");
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':contactno', $contactno);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':message', $message);

            if (!$stmt->execute()) {
                throw new Exception("Error inserting data.");
            }

            return true;
        } catch (\Throwable $t) {
            $this->handleError($t);
        }
    }

    public function get_services() {
        try {

            $data = json_decode(file_get_contents('php://input'), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(422);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid JSON input.'
                ]);
                exit;
            }

            $csrfToken = $data['csrf_token'] ?? '';
            if (!$this->session->validateCsrfToken($csrfToken)) {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid CSRF token.'
                ]);
                exit;
            }

            $fullname = $data['fullname'] ?? '';
            $contactno = $data['contactno'] ?? '';
            $zipcode = $data['zipcode'] ?? '';
            $services = $data['services'] ?? '';

            $sanitizeFullname = $this->sanitize->sanitize_name_string($fullname);
            $sanitizeContactno = $this->sanitize->sanitize_number($contactno);
            $sanitizeZipcode = $this->sanitize->sanitize_number($zipcode);
            $sanitizeServices = $this->sanitize->sanitize_name_string($services);

            $result = $this->insertDataToServicesTable($sanitizeFullname, $sanitizeContactno, $sanitizeZipcode, $sanitizeServices);

            if ($result) {
                http_response_code(201);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data inserted successfully.'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to insert data.'
                ]);
            }
            exit;

        } catch (\Throwable $t) {
            $this->handleError($t);
        }
    }

    public function get_contacts() {
        try {
            $this->create_contacts_table();

            $data = json_decode(file_get_contents('php://input'), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(422);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid JSON input.'
                ]);
                exit;
            }

            $csrfToken = $data['csrf_token'] ?? '';
            if (!$this->session->validateCsrfToken($csrfToken)) {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid CSRF token.'
                ]);
                exit;
            }

            $fullname = $data['fullname'] ?? '';
            $contactno = $data['contactno'] ?? '';
            $email = $data['email'] ?? '';
            $country = $data['country'] ?? '';
            $message = $data['message'] ?? '';

            $sanitizeFullname = $this->sanitize->sanitize_name_string($fullname);
            $sanitizeContactno = $this->sanitize->sanitize_number($contactno);
            $sanitizeEmail= $this->sanitize->sanitize_email_string($email);
            $sanitizeCountry = $this->sanitize->sanitize_country($country);
            $sanitizeMessage = $this->sanitize->sanitize_name_string($message);

            $result = $this->insertDataToContactsTable($sanitizeFullname, $sanitizeContactno, $sanitizeEmail, $sanitizeCountry, $sanitizeMessage);

            if ($result) {
                http_response_code(201);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data inserted successfully.'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to insert data.'
                ]);
            }
            exit;

        } catch (\Throwable $t) {
            $this->handleError($t);
        }
    }

    private function handleError(\Throwable $t) {
        $logPath = dirname(__DIR__, 1) . '/error.log';
        
        error_log("[Error]: " . $t->getMessage() . PHP_EOL, 3, $logPath);
        error_log("[Trace]: " . $t->getTraceAsString() . PHP_EOL, 3, $logPath);
    
        http_response_code(500);
        die('An error occurred. Please contact support.');
    }
    
}