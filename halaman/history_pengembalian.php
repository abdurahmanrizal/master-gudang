<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Overview</li>
        <li class="breadcrumb-item active">History Transaksi Pengembalian</li>
    </ol>

    <!-- <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#data_tambah_jenis_barang">
        <i class="fas fa-plus-circle"></i>
        <span>Tambah jenis barang</span>
    </a> -->
    
    <!-- MODAL TAMBAH BARANG -->
    <!-- Modal -->
    <!-- <div class="modal fade" id="data_tambah_jenis_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div> -->
    <!-- tabel data barang -->
    <div class="table-responsive">
        <table id="history-pengembalian" class="table table-striped">
            <thead>
                <tr>
                <th scope="col">NO</th>
                <th scope="col">KODE BARANG</th>
                <th scope="col">NO BARANG</th>
                <th scope="col">NAMA BARANG</th>
                <th scope="col">STOK</th>
                <th scope="col">JENIS BARANG</th>
                <th scope="col">TANGGAL PEMINJAMAN</th>
                <th scope="col">TANGGAL PENGEMBALIAN</th>
                <th scope="col">STATUS</th>
                <!-- <th scope="col">ACTION</th> -->
                </tr>
            </thead>
            <tbody>
                <!-- DATA BERASAL DARI DATABASE -->
                  <?php
                    include ('config/koneksi.php');
                    $sql_history_peminjaman_barang = "SELECT * FROM peminjaman p LEFT JOIN barang b ON p.id_barang = b.id_barang LEFT JOIN jenis_barang jb ON b.id_jenis = jb.id_jenis WHERE status = 0";
                    $query_history_peminjaman_barang = mysqli_query($db,$sql_history_peminjaman_barang);
                    $no = 1;
                    while($row = mysqli_fetch_array($query_history_peminjaman_barang)){
                        echo "<tr>";
                        echo "<td>".$no."</td>"; 
                        echo "<td>".$row['kode_barang']."</td>";
                        echo "<td>".$row['no_barang']."</td>";
                        echo "<td>".$row['nama_barang']."</td>";
                        echo "<td>".$row['temp_stok']."</td>";
                        echo "<td>".$row['jenis_barang']."</td>";
                        $oldDatetimePeminjaman = $row['tanggal_peminjaman'];
                        $newTimePeminjaman     = strtotime($oldDatetimePeminjaman);
                        $newDatePeminjaman     = date('Y-m-d',$newTimePeminjaman); 
                        echo "<td>".$newDatePeminjaman."</td>";
                        $oldDatetimePengembalian = $row['tanggal_pengembalian'];
                        $newTimePengembalian     = strtotime($oldDatetimePengembalian);
                        $newDatePengembalian     = date('Y-m-d',$newTimePengembalian); 
                        echo "<td>".$newDatePengembalian."</td>";
                        if($row['status'] == 0){
                            echo "<td>".'Pengembalian'."</td>";
                        }
                        ?>
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
        $('#history-pengembalian').DataTable();

       
    });

</script>