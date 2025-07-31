<?php
class User extends Model {
    public function all($filter = null) {
        return $this->db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($username, $password, $role) {
        
        if ($this->findByUsername($username)) {
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $password, $role]);
    }
    public function delete($id) {
        return $this->db->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
    }
    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}

?>