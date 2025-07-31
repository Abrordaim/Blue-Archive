<?php
class DocumentController extends Controller {
    public function dashboard() {
        $doc = new Document();
        $docs = $doc->all($_SESSION['user']['id']);
        $this->view('dashboard_user', ['documents' => $docs]);
    }
    public function upload() {
        $doc = new Document();
        $doc->upload($_FILES['file'], $_POST['title'], $_SESSION['user']['id']);
        header('Location: index.php');
    }
    public function delete($id) {
        $doc = new Document();
        $doc->delete($id);
        header('Location: index.php');
    }
    public function viewPdf($id) {
        $doc = new Document();

        
        $document = $doc->find($id);

        
        $relativePath = $document['path']; 

        
        $fullPath = realpath(__DIR__ . '/../../public/' . $relativePath);

     
        if ($document && $fullPath && file_exists($fullPath)) {
            $this->view('pdf_viewer', ['document' => $document]);
        } else {
            echo "Dokumen tidak ditemukan. Full path dicek: $fullPath";
        }
    }

    public function viewPdfContent($id) {
        $doc = new Document();
        $document = $doc->find($id);

        $relativePath = $document['path']; 
        $fullPath = realpath(__DIR__ . '/../../public/' . $relativePath);

        if ($document && $fullPath && file_exists($fullPath)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($fullPath) . '"');
            header('Content-Length: ' . filesize($fullPath));
            readfile($fullPath);
            exit;
        } else {
            echo "Dokumen tidak ditemukan.";
        }
    }
    public function edit() {
        $doc = new Document();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['edit_id'];
            $title = $_POST['edit_title'];

            // Jika ada file baru yang diupload
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $doc->updateWithFile($id, $_FILES['file'], $title);
            } else {
                $doc->updateMetadata($id, $title); // Hanya update judul
            }

            header('Location: index.php');
            exit;
        } else {
            echo "Edit hanya bisa dilakukan lewat POST.";
        }
    }





}



?>