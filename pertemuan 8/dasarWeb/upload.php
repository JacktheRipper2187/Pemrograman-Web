<?php
if (isset($_POST["submit"])) {
    $targetDirectory = "documents/"; // Direktori tujuan untuk menyimpan dokumen
    $targetFile = $targetDirectory . basename($_FILES["documentToUpload"]["name"]);
    $documentFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedExtensions = array("txt", "pdf", "doc", "docx");
    $maxFileSize = 10 * 1024 * 1024; // Maksimal ukuran 10 MB

    // Cek apakah direktori tujuan ada, jika tidak buat direktori
    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    // Cek apakah file diunggah dengan benar
    if (isset($_FILES["documentToUpload"]) && $_FILES["documentToUpload"]["error"] == 0) {
        // Cek apakah jenis file dan ukuran sesuai
        if (in_array($documentFileType, $allowedExtensions) && $_FILES["documentToUpload"]["size"] <= $maxFileSize) {
            if (move_uploaded_file($_FILES["documentToUpload"]["tmp_name"], $targetFile)) {
                echo "Dokumen berhasil diunggah.";
            } else {
                echo "Gagal mengunggah dokumen.";
            }
        } else {
            echo "Jenis dokumen tidak valid atau melebihi ukuran maksimum yang diizinkan.";
        }
    } else {
        echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
    }
}
?>
