$(document).ready(function() {
    $('#upload-form').submit(function(e) {
        e.preventDefault(); // Mencegah form dikirim secara default
        var formData = new FormData(this); // Mengambil data form, termasuk banyak file

        $.ajax({
            type: 'POST',
            url: 'upload_ajax.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#status').html(response); // Menampilkan respons server
            },
            error: function() {
                $('#status').html('Terjadi kesalahan saat mengunggah gambar.');
            }
        });
    });
});
