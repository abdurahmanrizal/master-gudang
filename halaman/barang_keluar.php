<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Overview</li>
        <li class="breadcrumb-item active">Data Barang Masuk</li>
    </ol>

    <!-- <a href="#" class="btn btn-success mb-3">
        <i class="fas fa-plus-circle"></i>
        <span>Tambah Barang</span>
    </a> -->
    <!-- tabel data barang -->
    <div class="table-responsive">
        <table id="barang" class="table table-striped">
            <thead>
                <tr>
                <th scope="col">NO</th>
                <th scope="col">KODE BARANG</th>
                <th scope="col">NAMA BARANG</th>
                <th scope="col">JENIS</th>
                <th scope="col">CREATE AT</th>
                <th scope="col">JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                <!-- DATA BERASAL DARI DATABASE -->
                <?php
                    include('config/koneksi.php');
                    $sql_tampil_barang = "SELECT * FROM history LEFT JOIN jenis_barang ON history.id_jenis = jenis_barang.id_jenis WHERE jenis_update= 1";
                    $query_tampil_barang = mysqli_query($db,$sql_tampil_barang);
                    $no = 1;
                    while($row = mysqli_fetch_array($query_tampil_barang)){
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$row['kode_barang']."</td>";
                        echo "<td>".$row['nama_barang']."</td>";
                        echo "<td>".$row['jenis_barang']."</td>";
                        echo "<td>".$row['create_at']."</td>";
                        echo "<td>".$row['stok']."</td>";
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
    });
</script>