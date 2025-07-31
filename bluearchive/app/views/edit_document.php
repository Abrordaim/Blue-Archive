<form method="POST" enctype="multipart/form-data">
    <h2>Edit Dokumen</h2>

    <label>Judul Dokumen:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($document['title']) ?>" required><br><br>

    <label>Ganti File (Opsional):</label>
    <input type="file" name="file"><br><br>

    <button type="submit">Simpan Perubahan</button>
</form>
