<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Overview</li>
        <li class="breadcrumb-item active">Jenis Barang</li>
    </ol>

    <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#data_tambah_jenis_barang">
        <i class="fas fa-plus-circle"></i>
        <span>Tambah jenis barang</span>
    </a>
    
    <!-- MODAL TAMBAH BARANG -->
    <!-- Modal -->
    <div class="modal fade" id="data_tambah_jenis_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-barang">
                   <div class="form-group">
                        <label for="exampleInputPassword1">Jenis Barang</label>
                        <input type="text" id="jenis_barang_nama" name="jenis_barang_nama" class="form-control" placeholder="Jenis Barang" required>
                    </div>
                    <input type="hidden" name="barang_id_jenis" id="barang_id_jenis">
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
        <table id="barang_jenis" class="table table-striped">
            <thead>
                <tr>
                <th scope="col">NO</th>
                <th scope="col">JENIS BARANG</th>
                <th scope="col">ACTION</th>
                <!-- <th scope="col">ACTION</th> -->
                </tr>
            </thead>
            <tbody>
                <!-- DATA BERASAL DARI DATABASE -->
                  <?php
                    include ('config/koneksi.php');
                    $sql_jenis_barang = "SELECT * FROM jenis_barang";
                    $query_jenis_barang = mysqli_query($db,$sql_jenis_barang);
                    $no = 1;
                    while($row = mysqli_fetch_array($query_jenis_barang)){
                        echo "<tr>";
                        echo "<td>".$no."</td>"; 
                        echo "<td>".$row['jenis_barang']."</td>";?>
                        <td>
                            <a href='#' class='btn btn-warning text-light edit_jenis' id="<?php echo $row['id_jenis'];?>">
                                <i class='fas fa-edit'></i>
                                <span>Edit</span>
                            </a>
                            <a href="#" class="btn btn-danger delete_jenis" id="<?php echo $row['id_jenis'];?>">
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
        $('#barang_jenis').DataTable();

        $('#form-barang').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: 'halaman/aksi_tambah_jenis_barang.php',
                type: 'POST',
                data : $('#form-barang').serialize(),
                success: function(data){
                  $('#data_tambah_jenis_barang').modal('hide');
                  $('#form-barang').trigger('reset');
                  alert('Sukses menambahkan barang');
                  $('#page-top #wrapper #jenis_barang').trigger('click');
                }
            });
        });

        $(document).on('click', '.edit_jenis', function(e){
            e.preventDefault();
            var barang_jenis_id = $(this).attr("id");
            $.ajax({
                url         : "halaman/edit_jenis_barang.php",
                method      : "POST",
                data        : {barang_jenis_id:barang_jenis_id},
                dataType    : "json",
                success     : function(data){
                    $('#barang_id_jenis').val(data.id_jenis);
                    $('#jenis_barang_nama').val(data.jenis_barang);
                    $('#insert').val("Update");
                    $('#data_tambah_jenis_barang').modal('show');
                }
            });
          
        });

        $(document).on('click', '.delete_jenis', function(e){
            e.preventDefault();
            var hapus_jenis_id = $(this).attr("id");
            $.ajax({
                url         : "halaman/hapus_barang_jenis.php",
                method      : "POST",
                data        : {hapus_jenis_id:hapus_jenis_id},
                // dataType    : "json",
                beforeSend  : function(){
                    return confirm('Anda Yakin Menghapus ?');
                },  
                success     : function(data){
                    // alert('Sukses menghapus barang');
                    $('#page-top #wrapper #jenis_barang').trigger('click');
                }
            });
          
        });

    });

</script>