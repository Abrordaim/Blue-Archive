<?php

session_start();
require_once __DIR__ . '/../app/init.php';

$auth = new AuthController();
$admin = new AdminController();
$doc = new DocumentController();

// Logout
if (isset($_GET['logout'])) {
    $auth->logout();
    exit;
}

// Register (jika ada)
if (isset($_GET['register'])) {
    $auth->register();
    exit;
}

// Belum login
if (!isset($_SESSION['user'])) {
    $auth->login();
    exit;
}

// View dokumen konten langsung
if (isset($_GET['view_doc'])) {
    $doc->viewPdfContent($_GET['view_doc']);
    exit;
}

// Routing berdasarkan role
if ($_SESSION['user']['role'] == 'admin') {
    if (isset($_POST['add_user'])) $admin->addUser();
    elseif (isset($_GET['delete_user'])) $admin->deleteUser($_GET['delete_user']);
    else $admin->dashboard();
} else {
    if (isset($_GET['delete_doc'])) $doc->delete($_GET['delete_doc']);
    elseif (isset($_POST['edit_submit'])) $doc->edit(); // edit dokumen
    elseif ($_SERVER['REQUEST_METHOD'] === 'POST') $doc->upload(); // upload dokumen
    else $doc->dashboard(); // tampilkan hanya dokumen user login
}




?>
