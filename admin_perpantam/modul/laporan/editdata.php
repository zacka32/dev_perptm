<?php   
  session_start();
  include "../../config/koneksi.php";
  $userid=$_SESSION['userid'];  
  $folder="modul/order"; 
  $id=$_POST['id'];
    ?>

      
      <form action="#" enctype="multipart/form-data" method="POST" class="formC" autocomplete="off"> 
        <div class="modal-body">
  <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>" required="required"> 


          <div class="form-group">
                  <label for="">Edit Pembayaran</label>
                  <select name="pembayaran" class="form-control select2" required="required" id='pembayaran'>
             
                 <option value="paid">paid</option>
                <option value="pending">pending</option>
                
              
                <option value="cancelled">cancelled</option>
              </select>
                

        </div>  
    </div>  
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
          <a type="submit" class="btn btn-primary " id="simpan">Simpan</a>
        </div>
      </form>
        <!-- /.modal-content -->

<script type="text/javascript"> 
  $(document).ready(function(){
    $('.select2').select2();
    //reset form    

  });  //document ready 
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#simpan").click(function(){   
    var pembayaran = $("#pembayaran").val();
     var id = $("#id").val();

    if(pembayaran=='') {
      alert("Masih Ada Field yang kosong"); 
      // document.getElementById("c_matcode").focus();
    }    
    else
    { 
         if(confirm("Apakah Anda Yakin ganti pembayaran ini?")) {
            $.ajax({
                type: 'POST',
                url: "modul/order/aksi_order.php?module=order&act=editpem",
                data: {pembayaran:pembayaran, id:id},
                beforeSend: function()
                {
                    // $("#wait").css("display", "block");
                    $("#save").attr("disabled", true);
                    $(':button').prop('disabled', true);
                    return true; 
                },
                success: function(data) { 
                    $('#Modalbuat').addClass('out');
                    $('#Modalbuat').removeClass('modal-active');
                    $('#Modalbuat').modal('toggle');
                    $('#tabeldetail').DataTable().draw();
                
                    a = data.length;
                    console.log(a);
                    if (a < 12) {
                        $.bootstrapGrowl('berhasil ditambahkan.',{
                        type: 'success',
                        delay: 2000,
                        offset: {from: 'top', amount: 50},
                        align: 'right', // ('left', 'right', or 'center')
                        width: 350,
                        allow_dismiss: true,
                        ele: 'body',
                        // stackup_spacing: 10,
                        });
                        } else {
                                $.bootstrapGrowl('gagal ditambahkan.',{
                        type: 'danger',
                        delay: 2000,
                        offset: {from: 'top', amount: 50},
                        align: 'right', // ('left', 'right', or 'center')
                        width: 250,
                        allow_dismiss: true,
                        ele: 'body',
                        // stackup_spacing: 10,
                        });
                                }

                    $(':button').prop('disabled', false);
                    
                    return true; 
                     
                },
                error: function()
                {
                    alert("Gagal disimpan");  
                $(':button').prop('disabled', false); 
                return true; 
                }
            });
            location.reload(); // reload halaman setelah OK
         }
    } //if validasi     
    });


  });
</script>

           


