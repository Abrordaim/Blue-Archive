<?php
// pastikan $documents sudah terdefinisi di atas halaman ini
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Blue Archive</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
  <a class="navbar-brand" href="#"><b>Blue Archive</b></a>
  <div class="ms-auto">
    <button class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload PDF</button>
    <a href="?logout=1" class="btn btn-outline-light">Logout</a>
  </div>
</nav>

<div class="container mt-4">
  <div class="row">
    <?php foreach ($documents as $doc): ?>
      <div class="col-md-4 mb-4">
        <div class="card shadow">
          <!-- Canvas Preview PDF -->
          <canvas id="pdf-preview-<?= $doc['id'] ?>" class="card-img-top" style="height: 300px; object-fit: contain;"></canvas>

          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($doc['title']) ?></h5>
            <a href="index.php?view_doc=<?= $doc['id'] ?>" target="_blank" class="btn btn-sm btn-primary">Lihat</a>
            <button 
              class="btn btn-sm btn-warning editBtn"
              data-id="<?= $doc['id'] ?>" 
              data-title="<?= htmlspecialchars($doc['title']) ?>"
              data-bs-toggle="modal" 
              data-bs-target="#editModal">
              Edit
            </button>
            <a href="uploads/<?= basename($doc['path']) ?>" class="btn btn-sm btn-success" download>Download</a>
            <a href="?delete_doc=<?= $doc['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus dokumen ini?')">Hapus</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>


<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" enctype="multipart/form-data" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadModalLabel">Upload PDF</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="title" class="form-label">Judul Dokumen</label>
          <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="file" class="form-label">Pilih File PDF</label>
          <input type="file" name="file" class="form-control" accept="application/pdf" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info text-white">Upload</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="index.php" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Judul Dokumen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="edit_id" id="editId">
        <div class="mb-3">
          <label for="editTitle" class="form-label">Judul Baru</label>
          <input type="text" name="edit_title" id="editTitle" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="edit_submit" class="btn btn-warning">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Isi data saat klik Edit
  document.querySelectorAll('.editBtn').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.getAttribute('data-id');
      const title = btn.getAttribute('data-title');
      document.getElementById('editId').value = id;
      document.getElementById('editTitle').value = title;
    });
  });

  // Load PDF preview
  pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';

  <?php foreach ($documents as $doc): 
    $pdfPath = 'uploads/' . basename($doc['path']); 
  ?>
    const url<?= $doc['id'] ?> = "<?= $pdfPath ?>";
    const canvas<?= $doc['id'] ?> = document.getElementById("pdf-preview-<?= $doc['id'] ?>");
    const ctx<?= $doc['id'] ?> = canvas<?= $doc['id'] ?>.getContext("2d");

    pdfjsLib.getDocument(url<?= $doc['id'] ?>).promise.then(pdf => {
      return pdf.getPage(1);
    }).then(page => {
      const scale = 1.5;
      const viewport = page.getViewport({ scale: scale });
      canvas<?= $doc['id'] ?>.height = viewport.height;
      canvas<?= $doc['id'] ?>.width = viewport.width;

      return page.render({
        canvasContext: ctx<?= $doc['id'] ?>,
        viewport: viewport
      }).promise;
    }).catch(err => {
      console.error("Gagal load PDF preview:", err);
    });
  <?php endforeach; ?>
</script>

</body>
</html>
