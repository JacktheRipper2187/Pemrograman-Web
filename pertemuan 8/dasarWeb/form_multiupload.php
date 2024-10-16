<html>
<head>
    <title>Multi-upload Gambar</title>
</head>
<body>
    <h2>Unggah Gambar</h2>
    <form action="proses_upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="files[]" multiple accept=".jpg, .jpeg, .png, .gif">
        <input type="submit" value="Unggah">
    </form>   
</body>
</html>
