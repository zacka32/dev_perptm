

<!-- //modal media -->
<div class="modal fade" id="mediaModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <div class="modal-header">

                    <h4 class="modal-title">Media Library</h4>

                    <button class="btn btn-success btn-sm ml-3" data-toggle="modal" data-target="#uploadModal">
                        <i class="fa fa-plus"></i> Upload Baru
                    </button>


                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
            </div>

            <div class="modal-body">

                <div class="row">

                    <?php
$img = $db->query("SELECT * FROM multimedia ORDER BY id_auto DESC");
while($i = $img->fetch()):
?>

                    <div class="col-md-3 mb-3">
                        <img src="../assets/upload/<?= $i['gambar']?>"
                            style="width:100%;cursor:pointer;border:2px solid #eee" class="pilih-gambar"
                            data-file="<?= $i['gambar']?>">
                    </div>

                    <?php endwhile; ?>

                </div>

            </div>

        </div>
    </div>
</div>
<!-- //modal 2 -->
<div class="modal fade" id="uploadModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Upload Gambar</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <input type="file" id="upload_file" class="form-control">

                <br>

                <button class="btn btn-primary" id="btnUpload">Upload</button>

                <div id="uploadStatus" class="mt-2"></div>

            </div>

        </div>
    </div>
</div>

<script>
    $(document).on('click','.pilih-gambar',function(){
// $('.pilih-gambar').click(function() {

    var file = $(this).data('file');

    $('#gambar').val(file);
    $('#preview').attr('src', '../assets/upload/' + file);

    $('#mediaModal').modal('hide');

});
</script>
<script>
$('#btnUpload').click(function() {

    var file = $('#upload_file')[0].files[0];

    if (!file) {
        alert('Pilih file dulu');
        return;
    }

    var fd = new FormData();
    fd.append('file', file);

    $('#uploadStatus').html('Uploading...');

    $.ajax({
        url: 'upload_media.php',
        type: 'POST',
        data: fd,
        contentType: false,
        processData: false,
        success: function(res) {

            var r = JSON.parse(res);

            if (r.status == 1) {

                $('#uploadStatus').html('Berhasil');

                var img = `
<div class="col-md-3 mb-3">
<img src="../assets/upload/${r.file}"
style="width:100%;cursor:pointer;border:2px solid #eee"
class="pilih-gambar"
data-file="${r.file}">
</div>
`;

                $('#mediaModal .row').prepend(img);

                $('#uploadModal').modal('hide');

            } else {
                $('#uploadStatus').html(r.msg);
            }

        }

    });

});
</script>
<!-- //berakhir modal media -->