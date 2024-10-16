<?php
if (isset($_POST["submit"])) {
    // Cek apakah file ada dan tidak ada error saat upload
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $targetDirectory = "uploads/";
        // Buat nama file yang aman
        $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
        
        // Pindahkan file yang diunggah ke folder target
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "File berhasil diunggah.";
        } else {
            echo "Gagal mengunggah file.";
        }
    }
}
?>
