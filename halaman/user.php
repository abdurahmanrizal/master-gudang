<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Overview</li>
        <li class="breadcrumb-item active">Manajemen User</li>
    </ol>

    <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#tambah_user">
        <i class="fas fa-plus-circle"></i>
        <span>Tambah User</span>
    </a>
    <!-- MODAL TAMBAH BARANG -->
    <!-- Modal -->
    <div class="modal fade test" id="tambah_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-user">
                    <div class="form-group">
                        <label for="exampleInputEmail1">NAMA USER</label>
                        <input type="text" id="nama_user" name="nama_user" class="form-control" placeholder="nama user" required>
                       
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">USERNAME</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="username" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">PASSWORD</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="password" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">LEVEL</label>
                        <select class="form-control" name="level" id="level">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <input type="hidden" name="user_id" id="user_id">
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
                <th scope="col">NAMA USER</th>
                <th scope="col">USERNAME</th>
                <th scope="col">LEVEL</th>
                <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <!-- DATA BERASAL DARI DATABASE -->
                <?php
                    include ('config/koneksi.php');
                    $sql_tampil_user = "SELECT * FROM users";
                    $query_tampil_user = mysqli_query($db,$sql_tampil_user);
                    $no = 1;
                    while($row = mysqli_fetch_array($query_tampil_user)){
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$row['nama_user']."</td>";
                        echo "<td>".$row['username']."</td>";
                        echo "<td>".$row['level']."</td>";?>
                         <td>
                            <a href='#' class='btn btn-warning text-light edit_user' id="<?php echo $row['id_user'];?>">
                                <i class='fas fa-edit'></i>
                                <span>Edit</span>
                            </a>
                            <a href="#" class="btn btn-danger delete_user" id="<?php echo $row['id_user'];?>">
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
        $('#barang').DataTable();
       
        $('#form-user').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: 'halaman/aksi_tambah_user.php',
                type: 'POST',
                data : $('#form-user').serialize(),
                success: function(data){
                  $('#data_tambah_user').modal('hide');
                  $('#form-user').trigger('reset');
                  alert('Sukses menambahkan user');
                  location.reload();
                }
            });
        
        });

        $(document).on('click', '.edit_user', function(e){
            e.preventDefault();
            var edit_user_id = $(this).attr("id");
            $.ajax({
                url         : "halaman/edit_user.php",
                method      : "POST",
                data        : {edit_user_id:edit_user_id},
                dataType    : "json",
                success     : function(data){
                    $('#user_id').val(data.id_user);
                    $('#nama_user').val(data.nama_user);
                    $('#username').val(data.username);
                    $('#password').val(data.password);
                    $('#level').val(data.level);
                    $('#insert').val("Update");
                    $('#tambah_user').modal('show');
                }
            });
            // var aa = confirm('test');
          
        });

        $(document).on('click', '.delete_user', function(e){
            e.preventDefault();
            var hapus_user = $(this).attr("id");
            $.ajax({
                url         : "halaman/hapus_user.php",
                method      : "POST",
                data        : {hapus_user:hapus_user},
                // dataType    : "json",
                beforeSend  : function(){
                    return confirm('Anda Yakin Menghapus ?');
                },  
                success     : function(data){
                    // alert('Sukses menghapus barang');
                    $('#page-top #wrapper #user').trigger('click');
                }
            });
          
        });
    });
</script>