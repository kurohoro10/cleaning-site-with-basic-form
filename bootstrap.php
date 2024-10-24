<?php
spl_autoload_register(function ($classname) {
    $paths = [''];
    $extension = '.class.php';

    foreach ($paths as $path) {
        $fullPath = $path . str_replace('\\', '/', $classname) . $extension;
        if (file_exists($fullPath)) {
            require_once $fullPath;
            return;
        }
    }

    echo $fullPath;

    return false;
});

use Classes\FormSubmissionController;

$formSubmission = new FormSubmissionController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = json_decode(file_get_contents('php://input'), true);

    if (isset($postData['type'])) {
        switch ($postData['type']) {
            case 'services':
                $data = $formSubmission->get_services();
                break;

            case 'contact':
                $data = $formSubmission->get_contacts();
                break;

            default:
                $data = ['error' => 'Invalid type specified.'];
                break;
        }
    } else {
        $data = ['error' => 'No type specified in the request.'];
    }
}
?>
