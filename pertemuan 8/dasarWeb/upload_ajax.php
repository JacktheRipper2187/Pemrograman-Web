<?php
if (isset($_FILES['images'])) {
    $errors = array();
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $totalFiles = count($_FILES['images']['name']);
    $uploadSuccess = false; // Menyimpan status jika ada file yang berhasil diunggah

    // Loop melalui semua file gambar yang diunggah
    for ($i = 0; $i < $totalFiles; $i++) {
        $file_name = $_FILES['images']['name'][$i];
        $file_size = $_FILES['images']['size'][$i];
        $file_tmp = $_FILES['images']['tmp_name'][$i];

        // Mendapatkan ekstensi file
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validasi ekstensi file
        if (!in_array($file_ext, $allowedExtensions)) {
            $errors[] = "Ekstensi file $file_name tidak diizinkan, hanya JPG, JPEG, PNG, GIF.";
            continue;
        }

        // Validasi ukuran file (maks 2MB)
        if ($file_size > 2097152) {
            $errors[] = "Ukuran file $file_name terlalu besar (maks 2MB).";
            continue;
        }

        // Jika tidak ada error, pindahkan file
        if (empty($errors)) {
            if (move_uploaded_file($file_tmp, "uploads/" . $file_name)) {
                echo "Gambar $file_name berhasil diunggah.<br>";
                $uploadSuccess = true; // Menandakan ada file yang berhasil diunggah
            } else {
                $errors[] = "Gambar $file_name gagal diunggah.";
            }
        }
    }

    // Tampilkan semua error jika ada
    if (!empty($errors)) {
        echo implode("<br>", $errors);
    }

    // Jika tidak ada file yang berhasil diunggah dan tidak ada error, tampilkan pesan ini
    if (!$uploadSuccess && empty($errors)) {
        echo "Tidak ada gambar yang diunggah.";
    }
}
?>
