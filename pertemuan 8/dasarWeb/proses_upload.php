<?php
// Lokasi penyimpanan file yang diunggah
$targetDirectory = "documents/";

// Periksa apakah direktori penyimpanan ada, jika tidak maka buat
if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

// Cek apakah ada file yang diunggah
if (isset($_FILES['files']) && !empty($_FILES['files']['name'][0])) {
    $totalFiles = count($_FILES['files']['name']);

    // Loop melalui semua file yang diunggah
    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = basename($_FILES['files']['name'][$i]); // Menyimpan nama file aman
        $targetFile = $targetDirectory . $fileName;

        // Validasi file berdasarkan ekstensi
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedExtensions = array("pdf", "doc", "docx");

        if (in_array($fileType, $allowedExtensions)) {
            // Pindahkan file yang diunggah ke direktori penyimpanan
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetFile)) {
                echo "File $fileName berhasil diunggah.<br>";
            } else {
                echo "Gagal mengunggah file $fileName.<br>";
            }
        } else {
            echo "Ekstensi file $fileName tidak diizinkan.<br>";
        }
    }
} else {
    echo "Tidak ada file yang diunggah.";
}
?>
