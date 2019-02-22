<?php
    include('config/koneksi.php');

    $kode_barang       = $_POST['kode_barang'];
    $nama_barang       = $_POST['nama_barang'];
    $no_barang         = $_POST['no_barang'];
    $stok_barang_bagus = $_POST['stok'];
    $stok_barang_sedang= $_POST['stok_sedang'];
    $stok_barang_rusak = $_POST['stok_rusak'];
    $rak               = $_POST['rak'];
    $jenis_barang      = $_POST['nama_jenis_barang'];
    $bagus             = 'BAGUS';
    $sedang            = 'SEDANG';
    $rusak             = 'RUSAK';
    if($_POST['barang_id'] != ''){
        $id_barang     = $_POST['barang_id'];
        $sql_id_barang = "SELECT * FROM barang WHERE id_barang=$id_barang";
        $query_barang  = mysqli_query($db,$sql_id_barang);
        $row_hasil     = mysqli_fetch_assoc($query_barang);
        // $temp_stok     = $row_hasil['stok'];
        $temp_stok_barang_bagus     = $row_hasil['stok'];
        $temp_stok_barang_sedang    = $row_hasil['stok_sedang'];
        $temp_stok_barang_rusak     = $row_hasil['stok_rusak'];
        // KONDISI STOK BARANG BAGUS KURANG DARI STOK BARANG BAGUS DATABASE
        if($stok_barang_bagus < $temp_stok_barang_bagus){
            if($stok_barang_sedang < $temp_stok_barang_sedang){
                if($stok_barang_rusak < $temp_stok_barang_rusak){
                    $jenis_update = 1;
                    $update_stok_barang_bagus       = $temp_stok_barang_bagus - $stok_barang_bagus;
                    $update_stok_barang_sedang      = $temp_stok_barang_sedang - $stok_barang_sedang;
                    $update_stok_barang_rusak       = $temp_stok_barang_rusak - $stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok='$update_stok_barang_bagus',stok_sedang='$update_stok_barang_sedang'
                                          , stok_rusak='$update_stok_barang_rusak' WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update')";
                    mysqli_query($db,$insert_history_barang_sedang);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update')";
                    mysqli_query($db,$insert_history_barang_rusak);

                }else if($stok_barang_rusak > $temp_stok_barang_rusak){
                    $jenis_update_keluar = 1; // untuk transaksi keluar
                    $jenis_update_masuk  = 2; // untuk transaksi masuk
                    $update_stok_barang_bagus       = $temp_stok_barang_bagus - $stok_barang_bagus;
                    $update_stok_barang_sedang      = $temp_stok_barang_sedang - $stok_barang_sedang;
                    $update_stok_barang_rusak       = $stok_barang_rusak - $temp_stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok='$update_stok_barang_bagus',stok_sedang='$update_stok_barang_sedang'
                                        ,stok_rusak='$stok_barang_rusak' WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_sedang);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else{
                    $jenis_update_keluar = 1; // untuk transaksi keluar
                    $update_stok_barang_bagus       = $temp_stok_barang_bagus - $stok_barang_bagus;
                    $update_stok_barang_sedang      = $temp_stok_barang_sedang - $stok_barang_sedang;
                    $stok_update_barang = "UPDATE barang SET stok='$update_stok_barang_bagus',stok_sedang='$update_stok_barang_sedang'
                                            WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_sedang);

                }
            }else if($stok_barang_sedang > $temp_stok_barang_sedang){
                if($stok_barang_rusak < $temp_stok_barang_rusak){
                    $jenis_update_keluar = 1;
                    $jenis_update_masuk  = 2;
                    $update_stok_barang_bagus       = $temp_stok_barang_bagus - $stok_barang_bagus;
                    $update_stok_barang_sedang      = $stok_barang_sedang - $temp_stok_barang_sedang;
                    $update_stok_barang_rusak       = $temp_stok_barang_rusak - $stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok='$update_stok_barang_bagus',stok_sedang='$stok_barang_sedang'
                                        ,stok_rusak='$update_stok_barang_rusak' WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_sedang);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else if($stok_barang_rusak > $temp_stok_barang_rusak){
                    $jenis_update_keluar = 1;
                    $jenis_update_masuk  = 2;
                    $update_stok_barang_bagus       = $temp_stok_barang_bagus - $stok_barang_bagus;
                    $update_stok_barang_sedang      = $stok_barang_sedang - $temp_stok_barang_sedang;
                    $update_stok_barang_rusak       = $stok_barang_rusak - $temp_stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok='$update_stok_barang_bagus',stok_sedang='$stok_barang_sedang'
                                        ,stok_rusak='$stok_barang_rusak' WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_sedang);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else{
                    $jenis_update_keluar = 1;
                    $jenis_update_masuk  = 2;
                    $update_stok_barang_bagus       = $temp_stok_barang_bagus - $stok_barang_bagus;
                    $update_stok_barang_sedang      = $stok_barang_sedang - $temp_stok_barang_sedang;
                    $stok_update_barang = "UPDATE barang SET stok='$update_stok_barang_bagus',stok_sedang='$stok_barang_sedang'
                                           WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_sedang);
                }
            }else{
                if($stok_barang_rusak < $temp_stok_barang_rusak){
                    $jenis_update_keluar = 1;
                    $update_stok_barang_bagus      = $temp_stok_barang_bagus - $stok_barang_bagus;
                    $update_stok_barang_rusak      = $temp_stok_barang_sedang - $stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok='$update_stok_barang_bagus',stok_rusak='$update_stok_barang_rusak'
                                           WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else if($stok_barang_rusak > $temp_stok_barang_rusak){
                    $jenis_update_keluar = 1;
                    $jenis_update_masuk  = 2;
                    $update_stok_barang_bagus      = $temp_stok_barang_bagus - $stok_barang_bagus;
                    $update_stok_barang_rusak      = $stok_barang_rusak - $temp_stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok='$update_stok_barang_bagus',stok_rusak='$stok_barang_rusak'
                                           WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else{
                    $jenis_update_keluar = 1;
                    $update_stok_barang_bagus      = $temp_stok_barang_bagus - $stok_barang_bagus;
                    $stok_update_barang = "UPDATE barang SET stok='$update_stok_barang_bagus'
                                           WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_bagus);
                }
            }
        }
        // AKHIR STOK BARANG BAGUS KURANG DARI STOK BARANG BAGUS DATABASE

        // AWALAN KONDISI STOK BARANG BAGUS LEBIH DARI STOK BARANG BAGUS DATABASE
        else if($stok_barang_bagus > $temp_stok_barang_bagus){
            if($stok_barang_sedang < $temp_stok_barang_sedang){
                if($stok_barang_rusak < $temp_stok_barang_rusak){
                    $jenis_update_keluar = 1;
                    $jenis_update_masuk  = 2;
                    $update_stok_barang_bagus      = $stok_barang_bagus - $temp_stok_barang_bagus;
                    $update_stok_barang_sedang     = $temp_stok_barang_sedang - $stok_barang_sedang;
                    $update_stok_barang_rusak      = $temp_stok_barang_rusak - $stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok='$stok_barang_bagus',
                                           stok_sedang='$update_stok_barang_sedang', stok_rusak='$update_stok_barang_rusak' WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_sedang);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else if($stok_barang_rusak > $temp_stok_barang_rusak){
                    $jenis_update_keluar = 1;
                    $jenis_update_masuk  = 2;
                    $update_stok_barang_bagus      = $stok_barang_bagus - $temp_stok_barang_bagus;
                    $update_stok_barang_sedang     = $temp_stok_barang_sedang - $stok_barang_sedang;
                    $update_stok_barang_rusak      = $stok_barang_rusak - $temp_stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok='$stok_barang_bagus',
                                           stok_sedang='$update_stok_barang_sedang', stok_rusak='$stok_barang_rusak' WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_sedang);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else{
                    $jenis_update_keluar = 1;
                    $jenis_update_masuk  = 2;
                    $update_stok_barang_bagus      = $stok_barang_bagus - $temp_stok_barang_bagus;
                    $update_stok_barang_sedang     = $temp_stok_barang_sedang - $stok_barang_sedang;
                    $stok_update_barang = "UPDATE barang SET stok='$stok_barang_bagus',
                                           stok_sedang='$update_stok_barang_sedang' WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_sedang);
                }
            }else if($stok_barang_sedang > $temp_stok_barang_sedang){
                if($stok_barang_rusak < $temp_stok_barang_rusak){
                    $jenis_update_keluar = 1;
                    $jenis_update_masuk  = 2;
                    $update_stok_barang_bagus      = $stok_barang_bagus - $temp_stok_barang_bagus;
                    $update_stok_barang_sedang     = $stok_barang_sedang - $temp_stok_barang_sedang;
                    $update_stok_barang_rusak      = $temp_stok_barang_rusak - $stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok='$stok_barang_bagus',
                                           stok_sedang='$stok_barang_sedang', stok_rusak='$update_stok_barang_rusak' WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_sedang);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else if($stok_barang_rusak > $temp_stok_barang_rusak){
                    $jenis_update_masuk  = 2;
                    $update_stok_barang_bagus      = $stok_barang_bagus - $temp_stok_barang_bagus;
                    $update_stok_barang_sedang     = $stok_barang_sedang - $temp_stok_barang_sedang;
                    $update_stok_barang_rusak      = $stok_barang_rusak - $temp_stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok='$stok_barang_bagus',
                                           stok_sedang='$stok_barang_sedang', stok_rusak='$stok_barang_rusak' WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_sedang);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else{
                    $jenis_update_masuk  = 2;
                    $update_stok_barang_bagus      = $stok_barang_bagus - $temp_stok_barang_bagus;
                    $update_stok_barang_sedang     = $stok_barang_sedang - $temp_stok_barang_sedang;
                    $stok_update_barang = "UPDATE barang SET stok='$stok_barang_bagus',
                                           stok_sedang='$stok_barang_sedang' WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_sedang);
                }
            }else{
                if($stok_barang_rusak < $temp_stok_barang_rusak ){
                    $jenis_update_keluar = 1;
                    $jenis_update_masuk  = 2;
                    $update_stok_barang_bagus      = $stok_barang_bagus - $temp_stok_barang_bagus;
                    $update_stok_barang_rusak      = $temp_stok_barang_rusak - $stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok='$stok_barang_bagus',
                                           stok_rusak='$update_stok_barang_rusak' WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else if($stok_barang_rusak > $temp_stok_barang_rusak){
                    $jenis_update_masuk  = 2;
                    $update_stok_barang_bagus      = $stok_barang_bagus - $temp_stok_barang_bagus;
                    $update_stok_barang_rusak      = $stok_barang_rusak - $temp_stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok='$stok_barang_bagus',
                                           stok_rusak='$stok_barang_rusak' WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_bagus);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else{
                    $jenis_update_masuk  = 2;
                    $update_stok_barang_bagus      = $stok_barang_bagus - $temp_stok_barang_bagus;
                    $stok_update_barang = "UPDATE barang SET stok='$stok_barang_bagus'
                                           WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_bagus = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_bagus','$bagus','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_bagus);
                }
            }
        }
        // AKHIRAN KONDISI STOK BARANG BAGUS LEBIH DARI STOK BARANG BAGUS DATABASE

        // AWALAN KONDISI STOK BARANG BAGUS SAMA DENGAN DARI STOK BARANG BAGUS DATABASE
        else{
            if($stok_barang_sedang < $temp_stok_barang_sedang){
                if($stok_barang_rusak < $temp_stok_barang_rusak){
                    $jenis_update_keluar = 1;
                    $update_stok_barang_sedang      = $temp_stok_barang_sedang - $stok_barang_sedang;
                    $update_stok_barang_rusak       = $temp_stok_barang_rusak - $stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok_sedang='$update_stok_barang_sedang',stok_rusak ='$update_stok_barang_rusak'
                                           WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_sedang);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else if($stok_barang_rusak > $temp_stok_barang_rusak){
                    $jenis_update_keluar = 1;
                    $jenis_update_masuk  = 2;
                    $update_stok_barang_sedang      = $temp_stok_barang_sedang - $stok_barang_sedang;
                    $update_stok_barang_rusak       = $stok_barang_rusak - $temp_stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok_sedang='$update_stok_barang_sedang',stok_rusak ='$stok_barang_rusak'
                                           WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_sedang);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else{
                    $jenis_update_keluar = 1;
                    $update_stok_barang_sedang      = $temp_stok_barang_sedang - $stok_barang_sedang;
                    $stok_update_barang = "UPDATE barang SET stok_sedang='$update_stok_barang_sedang'
                                           WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_sedang);
                }
            }else if($stok_barang_sedang > $temp_stok_barang_sedang){
                if($stok_barang_rusak < $temp_stok_barang_rusak){
                    $jenis_update_keluar = 1;
                    $jenis_update_masuk = 2;
                    $update_stok_barang_sedang      = $stok_barang_sedang - $temp_stok_barang_sedang;
                    $update_stok_barang_rusak       = $temp_stok_barang_rusak - $stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok_sedang='$stok_barang_sedang', stok_rusak='$update_stok_barang_rusak'
                                           WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_sedang);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else if($stok_barang_rusak > $temp_stok_barang_rusak){
                    $jenis_update_masuk = 2;
                    $update_stok_barang_sedang      = $stok_barang_sedang - $temp_stok_barang_sedang;
                    $update_stok_barang_rusak       = $stok_barang_rusak  - $temp_stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok_sedang='$stok_barang_sedang', stok_rusak='$stok_barang_rusak'
                                           WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_sedang);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else{
                    $jenis_update_masuk = 2;
                    $update_stok_barang_sedang      = $stok_barang_sedang - $temp_stok_barang_sedang;
                    $stok_update_barang = "UPDATE barang SET stok_sedang='$stok_barang_sedang'
                                           WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_sedang = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_sedang','$sedang','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_sedang);
                }
            }else{
                if($stok_barang_rusak < $temp_stok_barang_rusak){
                    $jenis_update_keluar = 1;
                    $update_stok_barang_rusak      = $temp_stok_barang_rusak - $stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok_rusak='$update_stok_barang_rusak'
                                           WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_keluar')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else if($stok_barang_rusak > $temp_stok_barang_rusak){
                    $jenis_update_masuk = 2;
                    $update_stok_barang_rusak      = $stok_barang_rusak - $temp_stok_barang_rusak;
                    $stok_update_barang = "UPDATE barang SET stok_rusak='$stok_barang_rusak'
                                           WHERE id_barang='$id_barang'";
                    mysqli_query($db,$stok_update_barang);
                    $insert_history_barang_rusak = "INSERT INTO history(kode_barang,no_barang_nama_barang,stok,kondisi,rak,id_jenis,jenis_update)
                                                    VALUES('$kode_barang','$no_barang','$nama_barang','$update_stok_barang_rusak','$rusak','$rak','$jenis_barang','$jenis_update_masuk')";
                    mysqli_query($db,$insert_history_barang_rusak);
                }else{
                   
                }
            }
        }
        // AKHIRAN KONDISI STOK BARANG BAGUS SAMA DENGAN DARI STOK BARANG BAGUS DATABASE
    }else{
        mysqli_query($db,"INSERT INTO barang(kode_barang,no_barang,nama_barang,stok,stok_sedang,stok_rusak,rak,id_jenis) VALUES
        ('$kode_barang','$no_barang','$nama_barang', '$stok_barang_bagus','$stok_barang_sedang','$stok_barang_rusak',$rak,'$jenis_barang')");
        $jenis_update = 2; // transaksi masuk 
        $sql_barang_bagus    = "INSERT INTO history(kode_barang,no_barang,nama_barang,stok,kondisi,rak,id_jenis,jenis_update) 
                                 VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_bagus','BAGUS','$rak','$jenis_barang', '$jenis_update')";
        mysqli_query($db,$sql_barang_bagus);
        $sql_barang_bagus    = "INSERT INTO history(id_baran,kode_barang,no_barang,nama_barang,stok,kondisi,rak,id_jenis,jenis_update) 
                                 VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_bagus','SEDANG','$rak','$jenis_barang', '$jenis_update')";
        mysqli_query($db,$sql_barang_sedang);
        $sql_barang_sedang    = "INSERT INTO history(id_barang,kode_barang,no_barang,nama_barang,stok,kondisi,rak,id_jenis,jenis_update) 
                                 VALUES('$kode_barang','$no_barang','$nama_barang','$stok_barang_sedang','RUSAK','$rak','$jenis_barang', '$jenis_update')";
        mysqli_query($db,$sql_barang_rusak);
    }
?>