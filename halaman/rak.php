<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Overview</li>
        <li class="breadcrumb-item active">RAK</li>
    </ol>

    <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#data_tambah_rak">
        <i class="fas fa-plus-circle"></i>
        <span>Tambah Rak</span>
    </a>
    
    <!-- MODAL TAMBAH BARANG -->
    <!-- Modal -->
    <div class="modal fade" id="data_tambah_rak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="header_rak">Tambah Rak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-rak">
                   <div class="form-group">
                        <label for="exampleInputPassword1">Nama Rak</label>
                        <input type="text" id="rak_barang" name="rak" class="form-control" placeholder="Nama Rak" required>
                    </div>
                    <input type="hidden" name="barang_id_rak" id="barang_rak">
                    <input type="submit" class="btn btn-primary simpan" value="Submit" id="insert"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <!-- tabel data barang -->
    <div class="table-responsive">
        <table id="barang-rak" class="table table-striped">
            <thead>
                <tr>
                <th scope="col">NO</th>
                <th scope="col">NAMA RAK</th>
                <th scope="col">ACTION</th>
                <!-- <th scope="col">ACTION</th> -->
                </tr>
            </thead>
            <tbody>
                <!-- DATA BERASAL DARI DATABASE -->
                  <?php
                    include ('config/koneksi.php');
                    $sql_rak_barang = "SELECT * FROM rak";
                    $query_rak_barang = mysqli_query($db,$sql_rak_barang);
                    $no = 1;
                    while($row = mysqli_fetch_array($query_rak_barang)){
                        echo "<tr>";
                        echo "<td>".$no."</td>"; 
                        echo "<td>".$row['nama_rak']."</td>";?>
                        <td>
                            <a href='#' class='btn btn-warning text-light edit_rak' id="<?php echo $row['id_rak'];?>">
                                <i class='fas fa-edit'></i>
                                <span>Edit</span>
                            </a>
                            <a href="#" class="btn btn-danger delete_rak" id="<?php echo $row['id_rak'];?>">
                                <i class="fas fa-trash"></i>
                                <span>Hapus</span>
                            </a>
                        </td>
                        <?php
                        echo "</tr>";
                        $no++;
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#barang-rak').DataTable();

        $('#form-rak').on('submit', function(e){
            e.preventDefault();
            document.getElementById("header_rak").innerHTML = "Tambah Data Rak";
            var id = $("#data_tambah_rak").find("input[name='barang_id_rak']").val();
            $.ajax({
                url: 'halaman/aksi_tambah_rak_barang.php',
                type: 'POST',
                data : $('#form-rak').serialize(),
                success: function(data){
                  $('#data_tambah_rak').modal('hide');
                  $('#form-rak').trigger('reset');
                  if(id){
                    alert('Sukses update data rak');
                  }else{
                    alert('Sukses menambahkan data rak');
                  }
                  // chrome modal bug
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  $('#page-top #wrapper #rak').trigger('click');
                },
                error: function(error){
                    alert('Terjadi kesalahan saat menambahkan atau update data rak');
                }
            });
        });

        $(document).on('click', '.edit_rak', function(e){
            e.preventDefault();
            document.getElementById("header_rak").innerHTML = "Update Data Rak";
            var barang_jenis_rak = $(this).attr("id");
            $.ajax({
                url         : "halaman/edit_rak_barang.php",
                method      : "POST",
                data        : {barang_jenis_rak:barang_jenis_rak},
                dataType    : "json",
                success     : function(data){
                    $('#barang_rak').val(data.id_rak);
                    $('#rak_barang').val(data.nama_rak);
                    $('#insert').val("Update");
                    $('#data_tambah_rak').modal('show');
                },
                error: function(error){
                    alert('Terjadi kesalahan saat memuat data rak');
                }
            });
          
        });

        $(document).on('click', '.delete_rak', function(e){
            e.preventDefault();
            var hapus_rak_id = $(this).attr("id");
            $.ajax({
                url         : "halaman/hapus_barang_rak.php",
                method      : "POST",
                data        : {hapus_rak_id:hapus_rak_id},
                // dataType    : "json",
                beforeSend  : function(){
                    return confirm('Anda Yakin Menghapus ?');
                },  
                success     : function(data){
                    // alert('Sukses menghapus barang');
                    $('#page-top #wrapper #rak').trigger('click');
                },
                error: function(error){
                    alert('Terjadi kesalahan saat menghapus data rak');
                }
            });
          
        });

    });

</script>