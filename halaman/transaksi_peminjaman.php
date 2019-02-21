<?php
    session_start();
?>
<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Overview</li>
        <li class="breadcrumb-item active">Transaksi Peminjaman</li>
    </ol>

    <!-- <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#data_tambah_jenis_barang">
        <i class="fas fa-plus-circle"></i>
        <span>Tambah jenis barang</span>
    </a> -->
    
    <!-- MODAL TAMBAH BARANG -->
    <!-- Modal -->
    <div class="modal fade" id="data-update-transaksi-peminjaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Transaksi Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-transaksi-barang">
                   <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" min="0" id="stok_transaksi" name="stok" class="form-control" required>
                    </div>
                    <input type="hidden" name="barang_id" id="barang_id">
                    <input type="hidden" name="barang_id_peminjaman" id="barang_id_peminjaman">
                    <input type="hidden" name="id_user" id="id_user_penginput">
                    <input type="hidden" name="tanggal_create" id="tanggal_create">
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
        <table id="transaksi-peminjaman" class="table table-striped">
            <thead>
                <tr>
                <th scope="col">NO</th>
                <th scope="col">KODE BARANG</th>
                <th scope="col">NO BARANG</th>
                <th scope="col">NAMA BARANG</th>
                <th scope="col">STOK</th>
                <th scope="col">JENIS BARANG</th>
                <th scope="col">TANGGAL PEMINJAMAN</th>
                <!-- <th scope="col">TANGGAL PENGEMBALIAN</th> -->
                <th scope="col">STATUS</th>
                <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <!-- DATA BERASAL DARI DATABASE -->
                  <?php
                    include ('config/koneksi.php');
                    $sql_peminjaman_barang = "SELECT * FROM peminjaman p LEFT JOIN barang b ON p.id_barang = b.id_barang LEFT JOIN jenis_barang jb ON b.id_jenis = jb.id_jenis";
                    $query_peminjaman_barang = mysqli_query($db,$sql_peminjaman_barang);
                    $no = 1;
                    while($row = mysqli_fetch_array($query_peminjaman_barang)){
                        if($row['status'] == 1){
                            echo "<tr>";
                            echo "<td>".$no."</td>"; 
                            echo "<td>".$row['kode_barang']."</td>";
                            echo "<td>".$row['no_barang']."</td>";
                            echo "<td>".$row['nama_barang']."</td>";
                            echo "<td>".$row['jumlah_peminjaman']."</td>";
                            echo "<td>".$row['jenis_barang']."</td>";
                            echo "<td>".$row['tanggal_peminjaman']."</td>";
                            // if($row['tanggal_pengembalian'] == NULL){
                            //     echo "<td>-</td>";
                            // }else{
                            //     echo "<td>".$row['tanggal_pengembalian']."</td>";
                            // }
                            if($row['status'] == 1){
                                echo "<td>".'Peminjaman'."</td>";
                            }else if($row['status'] == 0){
                                echo "<td>".'Pengembalian'."</td>";
                            }
                            ?>
                            <?php
                                if($row['status'] == 1){ ?>
                                    <td>
                                        <a href='#' class='btn btn-warning text-light edit_pengembalian mb-2' id="<?php echo $row['id_peminjaman'];?>">
                                            <i class='fas fa-edit'></i>
                                            <span>Edit</span>
                                        </a>
                                        <!-- <a href="#" class="btn btn-danger delete_transaksi" id="<?php echo $row['id_jenis'];?>">
                                            <i class="fas fa-trash"></i>
                                            <span>Hapus</span>
                                        </a> -->
                                    </td>
                                <?php }else{ ?>
                                     <td>
                                        ASU
                                    </td>
                                <?php } ?>
                            
                            <?php
                            echo "</tr>";
                            $no++;
                        }
                       
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#transaksi-peminjaman').DataTable();

        $('#form-transaksi-barang').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: 'halaman/aksi_update_transaksi_barang.php',
                type: 'POST',
                data : $('#form-transaksi-barang').serialize(),
                success: function(data){
                  $('#data-update-transaksi-peminjaman').modal('hide');
                  $('#form-transaksi-barang').trigger('reset');
                  alert('Sukses update transaksi peminjaman barang');
                  $('#page-top #wrapper #transaksi_peminjaman').trigger('click');
                }
            });
        });

        $(document).on('click', '.edit_pengembalian', function(e){
            e.preventDefault();
            var barang_transaksi_id = $(this).attr("id");
            $.ajax({
                url         : "halaman/edit_transaksi_barang.php",
                method      : "POST",
                data        : {barang_transaksi_id:barang_transaksi_id},
                dataType    : "json",
                success     : function(data){
                    $('#barang_id').val(data.id_barang);
                    $('#stok_transaksi').val(data.jumlah_peminjaman);
                    $('#barang_id_peminjaman').val(data.id_peminjaman);
                    $('#id_user_penginput').val(data.id_user);
                    $('#tanggal_create').val(data.tanggal_peminjaman);
                    $('#insert').val("Update");
                    $('#data-update-transaksi-peminjaman').modal('show');
                }
            });
          
        });

        // $(document).on('click', '.delete_jenis', function(e){
        //     e.preventDefault();
        //     var hapus_jenis_id = $(this).attr("id");
        //     $.ajax({
        //         url         : "halaman/hapus_barang_jenis.php",
        //         method      : "POST",
        //         data        : {hapus_jenis_id:hapus_jenis_id},
        //         // dataType    : "json",
        //         beforeSend  : function(){
        //             return confirm('Anda Yakin Menghapus ?');
        //         },  
        //         success     : function(data){
        //             // alert('Sukses menghapus barang');
        //             $('#page-top #wrapper #jenis_barang').trigger('click');
        //         }
        //     });
          
        // });

    });

</script>