$(document).ready(function() {
    $('#file').change(function() {
        // Cek apakah ada file yang dipilih
        if ($(this).get(0).files.length > 0) {
            $('#upload-button').prop('disabled', false).css('opacity', 1);
        } else {
            $('#upload-button').prop('disabled', true).css('opacity', 0.5);
        }
    });

    $('#upload-form').submit(function(e) {
        e.preventDefault(); // Mencegah form dari pengiriman default

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'upload.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#status').html(response);
            },
            error: function() {
                $('#status').html('Terjadi kesalahan saat mengunggah file.');
            }
        });
    });
});
