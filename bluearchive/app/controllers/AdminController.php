<?php
class AdminController extends Controller {
    public function dashboard() {
        $user = new User();
        $users = $user->all();
        $this->view('dashboard_admin', ['users' => $users]);
    }
    public function addUser() {
        $user = new User();
        $user->create($_POST);
        header('Location: index.php?admin');
    }
    public function deleteUser($id) {
        $user = new User();
        $user->delete($id);
        header('Location: index.php?admin');
    }
}
?>