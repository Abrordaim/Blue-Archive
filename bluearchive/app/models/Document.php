<?php
class Document extends Model {

    public function all($userId = null) {
        $stmt = $this->db->prepare("SELECT * FROM documents WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function upload($file, $title, $userId) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            echo "Upload error: " . $file['error'];
            return false;
        }

        $filename = uniqid() . '-' . basename($file['name']);
        $targetFolder = realpath(__DIR__ . '/../../public/uploads/') . '/';
        $dbPath = 'uploads/' . $filename;
        $path = $targetFolder . $filename;

        if (!move_uploaded_file($file['tmp_name'], $path)) {
            echo "Gagal memindahkan file ke $path";
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO documents (title, path, user_id) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $dbPath, $userId]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("SELECT path FROM documents WHERE id = ?");
        $stmt->execute([$id]);
        $doc = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($doc && !empty($doc['path'])) {
            $fullPath = realpath(__DIR__ . '/../../public/' . $doc['path']);
            if ($fullPath && file_exists($fullPath)) {
                unlink($fullPath);
            }
        }

        return $this->db->prepare("DELETE FROM documents WHERE id = ?")->execute([$id]);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM documents WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateMetadata($id, $title) {
        $stmt = $this->db->prepare("UPDATE documents SET title = ? WHERE id = ?");
        return $stmt->execute([$title, $id]);
    }

    public function updateWithFile($id, $file, $title) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            echo "Upload error: " . $file['error'];
            return false;
        }

        $document = $this->find($id);

        if ($document && !empty($document['path'])) {
            $oldPath = realpath(__DIR__ . '/../../public/' . $document['path']);
            if ($oldPath && file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $filename = uniqid() . '-' . basename($file['name']);
        $relativePath = 'uploads/' . $filename;
        $targetFolder = realpath(__DIR__ . '/../../public/uploads/') . '/';
        $fullPath = $targetFolder . $filename;

        if (!move_uploaded_file($file['tmp_name'], $fullPath)) {
            echo "Gagal memindahkan file.";
            return false;
        }

        $stmt = $this->db->prepare("UPDATE documents SET title = ?, path = ? WHERE id = ?");
        return $stmt->execute([$title, $relativePath, $id]);
    }
}
?>
