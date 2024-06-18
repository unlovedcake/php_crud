<?php
require_once 'models/StudentModel.php';

class StudentController
{
    private $studentModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
    }

    // public function create()
    // {


    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //         $name = $_POST['name'];
    //         $email = $_POST['email'];
    //         $this->studentModel->createStudent($name, $email);
    //         header("Location: index.php");
    //         exit();
    //     }
    //     include 'views/create_student.php';
    // }

    public function  create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $targetDirectory = 'uploads/'; // Directory where uploaded images will be stored
            $targetFile = $targetDirectory . basename($_FILES['image']['name']);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if (isset($_POST['submit'])) {
                $check = getimagesize($_FILES['image']['tmp_name']);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {

                    $uploadOk = 0;
                    $_SESSION['error_message'] = 'File is not an image.';
                    header('Location: index.php?action=create');
                    exit();
                }
            }

            // Check if file already exists
            if (file_exists($targetFile)) {

                $uploadOk = 0;
                $_SESSION['error_message']  = 'Sorry, file already exists.';
                header('Location: index.php?action=create');
                exit();
            }
            // Check file size
            if ($_FILES['image']['size'] > 500000) {
                echo 'Sorry, your file is too large.';
                $uploadOk = 0;
                $_SESSION['error_message'] = 'Sorry, your file is too large.';
                header('Location: index.php?action=create');
                exit();
            }

            // Allow certain file formats
            if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {

                $uploadOk = 0;

                $_SESSION['error_message'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
                header('Location: index.php?action=create');
                exit();
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {

                $uploadOk = 0;

                $_SESSION['error_message'] = 'Sorry, your file was not uploaded.';
                header('Location: index.php?action=create');
                exit();

                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {

                    $imagePath = $targetFile;
                }
            }

            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'image_path' =>  $imagePath,

            ];
            $this->studentModel->createStudent($data);
            header("Location: index.php");
            exit();
        }
        include 'views/create_student.php';
    }

    public function read()
    {
        $students = $this->studentModel->getAllStudents();
        include 'views/read_students.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'email' => $_POST['email'],

            ];

            if ($this->studentModel->updateStudent($id,  $data)) {
                header("Location: index.php");
                exit();
            } else {
                $error = "Failed to update student.";
            }
        } else {
            $id = $_GET['id'];
            $student = $this->studentModel->getStudentById($id);
            if (!$student) {
                $error = "Student not found.";
            }
        }
        include 'views/update_student.php';
    }

    // public function update()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $id = $_POST['id'];
    //         $name = $_POST['name'];
    //         $email = $_POST['email'];
    //         if ($this->studentModel->updateStudent($id, $name, $email)) {
    //             header("Location: index.php");
    //             exit();
    //         } else {
    //             $error = "Failed to update student.";
    //         }
    //     } else {
    //         $id = $_GET['id'];
    //         $student = $this->studentModel->getStudentById($id);
    //         if (!$student) {
    //             $error = "Student not found.";
    //         }
    //     }
    //     include 'views/update_student.php';
    // }

    public function delete()
    {
        $id = $_GET['id'];
        if ($this->studentModel->deleteStudent($id)) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Failed to delete student.";
        }
        include 'views/delete_student.php';
    }
}
