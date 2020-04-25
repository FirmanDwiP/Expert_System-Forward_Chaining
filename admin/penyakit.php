<?php include('headeradmin.php'); ?> 

        <div id="hem">
            <div id="hemdalam">
               
            <button class="btn"><a href="?page=penyakit&list" style=" text-decoration: none;color : #ffffff;">Daftar Penyakit</a></button>
            <button class="btn"><a href="?page=penyakit&add" style=" text-decoration: none;color : #ffffff;">Tambah Penyakit</a></button>
            

                <!-- menjelaskan pembuatan tabel yang dideklarasikan oleh inialisasi dimulai dari inialisasi no = 1, nah no akan bertambah terus kode,penyakit,edit dan hapus sebanyak array data -->

                <!-- 
                    CATATAN
                if isset - apakah data udah diuji atau belum

                mysql_num_rows()>0 - apakah jumlah barih lebih dari 0 maka eksekusi lanjut 

                mysql_fetch_assoc() - array di keluarkan 

                mysql_fetch_array() - menampilkan nama array

                Apabila ingin menggunakan komponen input type=’file’ dan berhubungan dengan gambar yang mau di upload, maka harus menggunakan enctype=’multipart/form-data’.
                -->

                <?php
                if(isset($_GET["edit"])){
                 $sql_edit = mysql_query("select * from tabel_penyakit where kode_penyakit = '".$_GET["edit"]."'");
                $r_edit = mysql_fetch_array($sql_edit);

                ?>
                <!-- ini adalah form untuk fungsi edit -->
                <form method="post" action="" id="" enctype="multipart/form-data">
                    <table class="table" style="width: 80%">
                        <tr>
                            <td>Kode Penyakit</td>
                            <td><input type="text" name="edit" class="input" value="<?=$r_edit['kode_penyakit']; ?>" size="2" disabled></td> <!-- ini adalah kode penyakit -->
                        </tr>
                        <input type="hidden" value="<?php echo $r_edit['kode_penyakit']; ?>" name="edit">
                        <tr>
                                <td>Nama Penyakit</td>
                                <td><textarea name="nama_penyakit" class="form-control" required='true' ><?php echo $r_edit['nama_penyakit']; ?></textarea></td>
                            </tr>
                            <tr>
                                <td>Definisi</td>
                                <td><textarea name="definisi" class="form-control" required='true' ><?php echo $r_edit['definisi']; ?></textarea></td>
                            </tr>
                            <tr>
                                <td>Pengobatan</td>
                                <td><textarea name="pengobatan" class="form-control" required='true' ><?php echo $r_edit['pengobatan']; ?></textarea></td>
                            </tr>
                            <tr>
                                <td>Pencegahan</td>
                                <td><textarea name="pencegahan" class="form-control" required='true' ><?php echo $r_edit['pencegahan']; ?></textarea></td>
                            </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Update" name="btn_add" class="btn btn-success"> <!-- tombol update penyakit -->
                                <input type="button" value="Batal" class="btn btn-danger" onclick="self.history.back()">
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                    if(isset($_POST["btn_add"])){ 
                        // jika di klik update penyakit
                        mysql_query("update tabel_penyakit set nama_penyakit = '".$_POST["nama_penyakit"]."',definisi = '".$_POST["definisi"]."',pengobatan = '".$_POST["pengobatan"]."',pencegahan = '".$_POST["pencegahan"]."' where kode_penyakit = '".$_POST["edit"]."'");
                        echo "<script>location.href='?page=penyakit'</script>";
                    }
                    } elseif(isset($_GET["hapus"])){
                    mysql_query("delete from tabel_penyakit where kode_penyakit = '".$_GET["hapus"]."'");
                    echo "<script>alert('Data berhasil dihapus')</script>";
                    echo "<script>location.href='?page=penyakit'</script>";   
                     } elseif(isset($_GET["add"])){
                    ?>
                    <form method="post" action="" id="geeky" enctype="multipart/form-data">
                        <table class="table" style="width: 80%">
                            <tr>
                                <td>Kode Penyakit</td>
                                <td><input type="text" name="kode_penyakit" class="input" value="<?php echo kd_auto("tabel_penyakit", "P"); ?>" size="5" disabled></td>
                            </tr>
                            <input type="hidden" value="<?php echo kd_auto("tabel_penyakit", "P"); ?>" name="kode_penyakit"> 
                            <tr>
                                <td>Nama Penyakit</td>
                                <td><textarea name="nama_penyakit" class="form-control" required='true'></textarea></td>
                            </tr>
                            <tr>
                                <td>Definisi</td>
                                <td><textarea name="definisi" class="form-control" required='true'></textarea></td>
                            </tr>
                            <tr>
                                <td>Pengobatan</td>
                                <td><textarea name="pengobatan" class="form-control" required='true'></textarea></td>
                            </tr>
                            <tr>
                                <td>Pencegahan</td>
                                <td><textarea name="pencegahan" style="white-space: pre-line" class="form-control"" required='true'></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Tambah" name="btn_add" class="btn btn-success">
                                    <input type="button" value="Batal" class="btn btn-danger" onclick="self.history.back()">
                                </td>
                            </tr>
                        </table>
                    </form>

                    <?php
                   
                    if(isset($_POST["btn_add"])){
                        mysql_query("insert into tabel_penyakit set kode_penyakit = '".$_POST["kode_penyakit"]."', nama_penyakit = '".$_POST["nama_penyakit"]."',definisi = '".$_POST["definisi"]."',pengobatan = '".$_POST["pengobatan"]."',pencegahan = '".$_POST["pencegahan"]."'");
                        echo "<script>alert('Data berhasil ditambah. Jangan lupa untuk menambah relasi penyakit dengan gejala di menu Relasi')</script>";
                        echo "<script>location.href='?page=penyakit'</script>";
                    }}
            // page     
            elseif(isset($_GET["detail"])){
                    $sql_detail = mysql_query("select * from tabel_penyakit    
                        where kode_penyakit = '".$_GET["detail"]."'");
                    $r_detail = mysql_fetch_array($sql_detail);
                    echo "<div id='detail'>";
                    // echo $r_detail['definisi'];

                    // echo "<td>".$r_detail['nama_penyakit']."</td>";
                    ?>
                    <table class="table" style="width:100%">
                      <tr>
                        <th>Nama Penyakit</th>
                        <th>Definisi</th> 
                        <th>Pengobatan</th>
                        <th>Pencegahan</th>
                      </tr>
                      <tr> 
                        <?php
                        echo "<td style='text-align:left'>".$r_detail['nama_penyakit']."</td>";
                        echo "<td style='text-align:left'>".$r_detail['definisi']."</td>";
                        echo "<td style='text-align:left'>".$r_detail['pengobatan']."</td>";
                        echo "<td style='white-space: pre-line; width:400px;text-align:left'>".$r_detail['pencegahan']."</td>";
                        ?>
                      </tr>
                    </table>
                    <?php
                    echo "</div>";
                    echo "<center><input type='button' class='btn btn-dark btn-sm' value='Kembali' onclick='self.history.back()'></center>";
              } else {
        ?>
        <form>
        <table style="width: 95%">
                    <tr>
                        <th>NO</th>
                        <th>Kode Penyakit</th>
                        <th>Penyakit</th> 
                        <th>Operasi</th>
                    </tr>
                    <?php
                    $no=1;
                    $sql_sol = mysql_query("select * from tabel_penyakit order by 1 asc");
                    while($r_sol = mysql_fetch_array($sql_sol)){
                    echo "<tr><td>".$no."</td><td>".$r_sol['kode_penyakit']."</td><td class='tabel_admin'><a href='?page=penyakit&detail=".$r_sol['kode_penyakit']."'.>".$r_sol['nama_penyakit']."</a></td>";
                    echo "<td class='tabel_admin'><a href='?page=penyakit&edit=".$r_sol['kode_penyakit']."'>Edit</a> | <a href='?page=penyakit&hapus=".$r_sol['kode_penyakit']."'>Hapus</a></tr>";
                    $no++;

                }
                echo "<div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Info!</strong> Untuk detail penyakit bisa di klik pada nama penyakit</div>";
                ?> 
                </table>
    </form>
    <?php
    } 
    ?>
            </div>
        </div>

<?php include('footeradmin.php'); ?>