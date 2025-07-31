<?php
class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $users = $user->all();
            foreach ($users as $u) {
                if ($u['username'] == $_POST['username'] && password_verify($_POST['password'], $u['password'])) {
                    $_SESSION['user'] = $u;
                    header('Location: index.php');
                    return;
                }
            }
        }
        $this->view('login');
    }
     public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = 'user'; // default role

            $user = new User();
            $success = $user->create($username, $password, $role);

            if ($success) {
                header("Location: index.php"); // langsung login atau redirect ke login page
            } else {
                $this->view('register', ['error' => 'Username sudah digunakan']);
            }
        } else {
            $this->view('register');
        }
    }
    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
?>