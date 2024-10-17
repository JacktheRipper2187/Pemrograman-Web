<html>
<head>
    <title>Unggah Gambar</title>
</head>
<body>
    <h2>Unggah Beberapa Gambar</h2>
    <form id="upload-form" action="upload_ajax.php" method="post" enctype="multipart/form-data">
        <input type="file" name="images[]" id="file" multiple accept=".jpg, .jpeg, .png, .gif">
        <input type="submit" name="submit" value="Unggah">
    </form>
    <div id="status"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="upload.js"></script>
</body>
</html>
