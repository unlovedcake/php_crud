<?php
require_once 'config.php';

class StudentModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // public function createStudent($name, $email)
    // {
    //     $sql = "INSERT INTO students (name, email) VALUES ('$name', '$email')";
    //     return $this->conn->query($sql);
    // }

    public function  register($data)
    {


        $sql = "INSERT INTO users (username, password) VALUES ( ?,?)";
        $stmt = $this->conn->prepare($sql);
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $stmt->bind_param("ss",  $data['username'], $password);
        $stmt->execute();
        unset($_SESSION['form_data']);
        return $stmt->affected_rows;
    }



    public function  login($data)
    {

        $username = $data['username'];
        $password = $data['password'];

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $row['username'];
                unset($_SESSION['form_data']);
                echo "Login successful! Welcome, " . $_SESSION['username'];
                header('Location: index.php?action=read&status=success');
            } else {


                $_SESSION['error_message'] = 'Invalid password.';
                header('Location: index.php?action=login&status=failed');
            }
        } else {

            $_SESSION['error_message'] = 'No user found with this user name.';
            header('Location: index.php?action=login&status=failed');
        }
    }

    public function createStudent($data)
    {




        $sql = "INSERT INTO students (name, email, image_path) VALUES ( ?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss",  $data['name'], $data['email'], $data['image_path']);
        $stmt->execute();
        return $stmt->affected_rows;
    }
    private $table = 'students';

    public function getStudents($limit, $offset)
    {

        $sql = "SELECT * FROM students  LIMIT $limit OFFSET $offset";
        $result = $this->conn->query($sql);
        $students = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
        }
        return $students;
    }

    public function getTotalStudents()
    {
        $query = "SELECT COUNT(*)  FROM " . $this->table;
        $result = $this->conn->query($query);

        return $result->fetch_column();
    }

    public function getAllStudents()
    {
        $sql = "SELECT * FROM students";
        $result = $this->conn->query($sql);
        $students = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
        }
        return $students;
    }

    public function getStudentById($id)
    {
        $id = $this->conn->real_escape_string($id);
        $sql = "SELECT * FROM students WHERE id='$id'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function updateStudent($id, $data)
    {
        $sql = "UPDATE students SET name=?, email=?, image_path=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("sssi", $data['name'], $data['email'], $data['image_path'], $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    // public function updateStudent($id, $name, $email)
    // {
    //     $id = $this->conn->real_escape_string($id);
    //     $name = $this->conn->real_escape_string($name);
    //     $email = $this->conn->real_escape_string($email);
    //     $sql = "UPDATE students SET name='$name', email='$email' WHERE id='$id'";
    //     return $this->conn->query($sql);
    // }

    public function deleteStudent($id)
    {
        $id = $this->conn->real_escape_string($id);
        $sql = "DELETE FROM students WHERE id='$id'";
        return $this->conn->query($sql);
    }
}
