<?php
    include('config/koneksi.php');
    session_start();
    $queryKode = "SELECT max(kode_barang) as maxKode FROM barang";
    $hasil     = mysqli_query($db,$queryKode);
    $data      = mysqli_fetch_array($hasil);
    $kodeBarang = $data['maxKode'];

    $noUrut    = (int) substr($kodeBarang, 3, 3);

    $noUrut++;

    $char = "BRG";
    $kodeBarang = $char . sprintf("%03s", $noUrut);
?>
<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Overview</li>
        <li class="breadcrumb-item active">Data Barang</li>
    </ol>

    <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#data_tambah_barang" id="add">
        <i class="fas fa-plus-circle"></i>
        <span>Tambah Barang</span>
    </a>
    <!-- MODAL TAMBAH BARANG -->
    <!-- Modal -->
    <div class="modal fade" id="data_tambah_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="header_modal_form">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-data-barang">
                    <div class="form-group">
                        <label for="exampleInputEmail1">KODE BARANG</label>
                        <input type="text" id="kode_barang" name="kode_barang" class="form-control" value="<?php echo $kodeBarang;?>" readonly required>
                       
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">NAMA BARANG</label>
                        <input type="text" id="nama_barang" name="nama_barang" class="form-control" placeholder="Nama Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">NO BARANG</label>
                        <input type="text" id="no_barang" name="no_barang" class="form-control" placeholder="No Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" id="stok-bagus-label">STOK BARANG BAGUS</label>
                        <input type="number" min="0" id="stok" name="stok" class="form-control" placeholder="Stok barang bagus" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" id="stok-sedang-label">STOK BARANG SEDANG</label>
                        <input type="number" min="0" id="stok_sedang" name="stok_sedang" class="form-control" placeholder="Stok barang sedang" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" id="stok-rusak-label">STOK BARANG RUSAK</label>
                        <input type="number" min="0" id="stok_rusak" name="stok_rusak" class="form-control" placeholder="Stok barang sedang" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">RAK</label>
                        <select class="form-control" name="rak" id="rak_barang" required>
                            <option value="0">Pilih Rak barang...</option>
                                <?php
                                $sql_rak_barang   = "SELECT * FROM rak";
                                $query_rak_barang = mysqli_query($db,$sql_rak_barang);

                                while($row_rak_barang = mysqli_fetch_array($query_rak_barang)){ ?>
                                    <option value="<?php echo $row_rak_barang['id_rak'];?>"><?php echo $row_rak_barang['nama_rak'];?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">JENIS BARANG</label>
                        <select class="form-control" name="nama_jenis_barang" id="nama_jenis_barang" required>
                            <option value="0">Pilih Jenis barang...</option>
                                <?php
                                $sql_jenis_barang   = "SELECT * FROM jenis_barang";
                                $query_jenis_barang = mysqli_query($db,$sql_jenis_barang);

                                while($row_jenis_barang = mysqli_fetch_array($query_jenis_barang)){ ?>
                                    <option value="<?php echo $row_jenis_barang['id_jenis'];?>"><?php echo $row_jenis_barang['jenis_barang'];?></option>
                                <?php } ?>
                        </select>
                        <!-- <input type="text" id="nama_jenis_barang" name="nama_jenis_barang" class="form-control" placeholder="Stok" required> -->
                    </div>
                    <input type="hidden" name="barang_id" id="barang_id">
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
        <table id="barang" class="table table-striped">
            <thead>
                <tr>
                <th scope="col">NO</th>
                <th scope="col">KODE BARANG</th>
                <th scope="col">NO BARANG</th>
                <th scope="col">NAMA BARANG</th>
                <th scope="col">STOK BARANG BAGUS</th>
                <th scope="col">STOK BARANG SEDANG</th>
                <th scope="col">STOK BARANG RUSAK</th>
                <th scope="col">RAK</th>
                <th scope="col">JENIS BARANG</th>
                <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <!-- DATA BERASAL DARI DATABASE -->
                <?php
                    $sql_tampil_barang = "SELECT * FROM barang LEFT JOIN jenis_barang ON barang.id_jenis = jenis_barang.id_jenis LEFT JOIN rak ON barang.rak = rak.id_rak";
                    $query_tampil_barang = mysqli_query($db,$sql_tampil_barang);
                    $no = 1;
                    while($row = mysqli_fetch_array($query_tampil_barang)){
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$row['kode_barang']."</td>";
                        if($row['no_barang'] == ""){
                            echo "<td>-</td>";
                        }else{
                            echo "<td>".$row['no_barang']."</td>";
                        }
                        echo "<td>".$row['nama_barang']."</td>";
                        echo "<td>".$row['stok']."</td>";
                        echo "<td>".$row['stok_sedang']."</td>";
                        echo "<td>".$row['stok_rusak']."</td>";
                        if($row['rak'] == ""){
                            echo "<td>-</td>";
                        }else{
                            echo "<td>".$row['nama_rak']."</td>";
                        }
                        echo "<td>".$row['jenis_barang']."</td>";?>
                        <td>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <a href='#' class='btn btn-warning text-light edit_barang mb-2' id="<?php echo $row['id_barang'];?>">
                                        <i class='fas fa-edit'></i>
                                        <span>Edit</span>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <a href="#" class="btn btn-danger delete_barang mb-2" id="<?php echo $row['id_barang'];?>">
                                        <i class="fas fa-trash"></i>
                                        <span>Hapus</span>
                                    </a>
                                </div>
                            </div>
                            <?php
                                if($row['stok'] > 0){
                            ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <a href="#" class="btn btn-info peminjaman" id="<?php echo $row['id_barang'];?>" data-toggle="modal" data-target="#peminjaman_barang" disabled>
                                        <i class="fas fa-book"></i>
                                        <span>Peminjaman</span>
                                    </a>
                                </div>
                            </div>
                            <?php } else if($row['stok'] == NULL) {?>
                                <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <a href="#" class="btn btn-info peminjaman handling" id="handling">
                                        <i class="fas fa-book"></i>
                                        <span>Peminjaman</span>
                                    </a>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- modal peminjaman -->
                            <div class="modal fade" id="peminjaman_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Peminjaman Barang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" id="form-peminjaman">
                                            <div class="form-group">
                                                <label for="stok_peminjaman">STOK</label>
                                                <input type="number" id="stok_peminjaman" name="stok" class="form-control" placeholder="Stok" required>
                                            </div>
                                            <input type="hidden" name="barang_id" id="barang_id_peminjaman">
                                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['username'];?>">
                                            <input type="submit" class="btn btn-primary simpan" value="Submit">
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
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
        $('#barang').DataTable();
        $('#add').click(function(){
            $('#insert').val("Submit");
            document.getElementById("header_modal_form").innerHTML = "Tambah Barang";
            document.getElementById("stok-bagus-label").innerHTML = "JUMLAH STOK BARANG BAGUS YANG INGIN DI SIMPAN";
            document.getElementById("stok-sedang-label").innerHTML = "JUMLAH STOK BARANG SEDANG INGIN DI SIMPAN";
            document.getElementById("stok-rusak-label").innerHTML = "JUMLAH STOK BARANG RUSAK INGIN DI SIMPAN";
            $('#form-data-barang')[0].reset();
            $('input#stok').bind('keypress', function (e) {
                return !(e.which != 8 && e.which != 0 &&
                        (e.which < 48 || e.which > 57) && e.which != 46);
            });
        });
        $('#handling').click(function(){
            alert("MAAF STOK BARANG HABIS");
        });
        $('#form-data-barang').on('submit', function(e){
            e.preventDefault();
           
            var id = $("#data_tambah_barang").find("input[name='barang_id']").val();
            $.ajax({
                url: 'halaman/aksi_tambah_barang.php',
                type: 'POST',
                data : $('#form-data-barang').serialize(),
                success: function(){
                  $('#data_tambah_barang').modal('hide');
                  $('#form-user').trigger('reset');
                //   if(response === 'test'){
                //     // alert('test');
                //     console.log('test');
                //   }else if(id && !status == 'Wrong input'){
                //     alert('Sukses update data barang');
                //   }else{
                //     alert('Sukses menambahkan data barang');
                //   }
                  if(id){
                    alert('Sukses update data barang');  
                  }else{
                    alert('Sukses menambahkan data barang');
                  }
                  // chrome bug modal
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  $('#page-top #wrapper #data_barang').trigger('click');
                },
                error: function(error){
                    alert('Terjadi kesalahan saat menambahkan atau update data barang');
                }
                // tambah handling error
            });
        });
        $(document).on('click', '.edit_barang', function(e){
            e.preventDefault();
            document.getElementById("header_modal_form").innerHTML = "Update Barang";
            document.getElementById("stok-bagus-label").innerHTML = "JUMLAH STOK BARANG BAGUS YANG INGIN DI EDIT";
            document.getElementById("stok-sedang-label").innerHTML = "JUMLAH STOK BARANG SEDANG INGIN DI EDIT";
            document.getElementById("stok-rusak-label").innerHTML = "JUMLAH STOK BARANG RUSAK INGIN DI EDIT";
            var barang_id = $(this).attr("id");
            $.ajax({
                url         : "halaman/edit_barang.php",
                method      : "POST",
                data        : {barang_id:barang_id},
                dataType    : "json",
                success     : function(data){
                    $('#kode_barang').val(data.kode_barang);
                    $('#nama_barang').val(data.nama_barang);
                    $('#no_barang').val(data.no_barang);
                    $('#stok').val(data.stok);
                    $('#stok_sedang').val(data.stok_sedang);
                    $('#stok_rusak').val(data.stok_rusak);
                    $('#rak_barang').val(data.rak);
                    $('#nama_jenis_barang').val(data.id_jenis);
                    $('#barang_id').val(data.id_barang);
                    $('#insert').val("Update");
                    $('#data_tambah_barang').modal('show');
                },
                error       : function(error){
                    alert('Terjadi kesalahan saat memuat data barang');
                }
            });
          
        });

        $(document).on('click', '.delete_barang', function(e){
            e.preventDefault();
            var hapus_barang_id = $(this).attr("id");
            $.ajax({
                url         : "halaman/hapus_barang.php",
                method      : "POST",
                data        : {hapus_barang_id:hapus_barang_id},
                // dataType    : "json",
                beforeSend  : function(){
                    return confirm('Anda Yakin Menghapus ?');
                },  
                success     : function(data){
                    // alert('Sukses menghapus barang');
                    $('#page-top #wrapper #data_barang').trigger('click');
                },
                error       : function(error){
                    alert('Terjadi kesalahan saat menghapus data barang');
                }
            });
          
        });
        // peminjaman
        $(document).on('click', '.peminjaman', function(e){
            e.preventDefault();
            var barang_id = $(this).attr("id");
            $.ajax({
                url         : "halaman/edit_barang.php",
                method      : "POST",
                data        : {barang_id:barang_id},
                dataType    : "json",
                success     : function(data){
                    // $('#kode_barang').val(data.kode_barang);
                    // $('#nama_barang').val(data.nama_barang);
                    // $('#no_barang').val(data.no_barang);
                    $('#stok_peminjaman').val(data.stok);
                    // $('#rak').val(data.rak);
                    // $('#nama_jenis_barang').val(data.id_jenis);
                    $('#barang_id_peminjaman').val(data.id_barang);
                    
                    // $('#insert').val("Update");
                    $('#peminjaman_barang').modal('show');
                },
                error       : function(error){
                    alert('Terjadi kesalahan saat memuat data barang');
                }
            });
          
        });
        // menyimpan data peminjaman
        $('#form-peminjaman').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: 'halaman/aksi_tambah_peminjaman_barang.php',
                type: 'POST',
                data : $('#form-peminjaman').serialize(),
                success: function(){
                  $('#peminjaman_barang').modal('hide');
                  $('#form-peminjaman').trigger('reset');
                //   if(response === 'test'){
                //     // alert('test');
                //     console.log('test');
                //   }else if(id && !status == 'Wrong input'){
                //     alert('Sukses update data barang');
                //   }else{
                //     alert('Sukses menambahkan data barang');
                //   }
                //   if(id){
                //     alert('Sukses update data barang');  
                //   }else{
                //     alert('Sukses menambahkan data barang');
                //   }
                  alert('Sukses menambah data peminjaman');
                  // chrome bug modal
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  $('#page-top #wrapper #data_barang').trigger('click');
                },
                error: function(error){
                    alert('Terjadi kesalahan saat menambahkan atau update data barang');
                }
                // tambah handling error
            });
        });

    });
</script>