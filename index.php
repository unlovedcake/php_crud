<?php
require_once 'controllers/StudentController.php';

session_start();

$action = isset($_GET['action']) ? $_GET['action'] : 'read';

$studentController = new StudentController();

switch ($action) {
    case 'create':
        $studentController->create();
        break;
    case 'read':
        $studentController->read();
        break;
    case 'update':
        $studentController->update();
        break;
    default:
        $studentController->delete();
}
