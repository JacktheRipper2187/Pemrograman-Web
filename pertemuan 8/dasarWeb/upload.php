<?php
if (isset($_POST["submit"])) {
    $targetDirectory = "uploads/"; // Direktori tujuan untuk menyimpan file
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $maxFileSize = 5 * 1024 * 1024;

    // Cek apakah direktori tujuan ada, jika tidak buat direktori
    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    // Cek apakah file sudah ada di direktori tujuan
    if (file_exists($targetFile)) {
        echo "File sudah ada di direktori tujuan.";
        exit;
    }

    if (in_array($fileType, $allowedExtensions) && $_FILES["fileToUpload"]["size"] <= $maxFileSize) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "File berhasil diunggah.";

            // Membuat thumbnail dengan lebar 200 px
            createThumbnail($targetFile, $fileType);
        } else {
            echo "Gagal mengunggah file.";
        }
    } else {
        if (!in_array($fileType, $allowedExtensions)) {
            echo "Ekstensi file tidak diizinkan. Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
        } elseif ($_FILES["fileToUpload"]["size"] > $maxFileSize) {
            echo "Ukuran file terlalu besar. Maksimal 5 MB.";
        } else {
            echo "File tidak valid atau melebihi ukuran maksimum yang diizinkan.";
        }
    }
}

function createThumbnail($filePath, $fileType) {
    $thumbnailWidth = 200;
    list($originalWidth, $originalHeight) = getimagesize($filePath);
    $thumbnailHeight = intval(($thumbnailWidth / $originalWidth) * $originalHeight);

    $thumbnailImage = imagecreatetruecolor(intval($thumbnailWidth), $thumbnailHeight);

    switch ($fileType) {
        case "jpg":
        case "jpeg":
            $sourceImage = imagecreatefromjpeg($filePath);
            break;
        case "png":
            $sourceImage = imagecreatefrompng($filePath);
            break;
        case "gif":
            $sourceImage = imagecreatefromgif($filePath);
            break;
        default:
            echo "Format gambar tidak didukung untuk pembuatan thumbnail.";
            return;
    }

    imagecopyresampled(
        $thumbnailImage,
        $sourceImage,
        0, 0, 0, 0,
        intval($thumbnailWidth), $thumbnailHeight,
        $originalWidth, $originalHeight
    );

    // Menyimpan thumbnail ke direktori "uploads/" dengan prefix "thumb_"
    $thumbnailPath = "uploads/thumb_" . basename($filePath);

    switch ($fileType) {
        case "jpg":
        case "jpeg":
            imagejpeg($thumbnailImage, $thumbnailPath);
            break;
        case "png":
            imagepng($thumbnailImage, $thumbnailPath);
            break;
        case "gif":
            imagegif($thumbnailImage, $thumbnailPath);
            break;
    }

    echo " Thumbnail berhasil dibuat dengan ukuran lebar 200 px.";
    imagedestroy($thumbnailImage);
    imagedestroy($sourceImage);
}
?>
