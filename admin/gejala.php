<?php include('headeradmin.php'); ?> 

        <div id="hem">
            <div id="hemdalam">
               
            <button class="btn"><a href="?page=gejala&list" style=" text-decoration: none;color : #ffffff;">Daftar Gejala</a></button>
            <button class="btn"><a href="?page=gejala&add" style=" text-decoration: none;color : #ffffff;">Tambah Gejala</a></button>
            
                
                <!-- menjelaskan pembuatan tabel yang dideklarasikan oleh inialisasi dimulai dari inialisasi no = 1, nah no akan bertambah terus kode,gejala,edit dan hapus sebanyak array data -->

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
                 $sql_edit = mysql_query("select * from tabel_gejala where kode_gejala = '".$_GET["edit"]."'");
                $r_edit = mysql_fetch_array($sql_edit);
                $ya = $r_edit['kode_induk_ya'];
                $tidak = $r_edit['kode_induk_tidak'];
                ?>
                <!-- ini adalah form untuk fungsi edit -->
                <form method="post">
                    <table class="table" style="width: 80%">
                        <tr>
                            <td>Kode Gejala</td>
                            <td><input type="text" name="edit" class="input" value="<?php echo $r_edit['kode_gejala']; ?>" size="6" disabled></td> <!-- ini adalah kode gejala -->
                        </tr>
                        <input type="hidden" value="<?php echo $r_edit['kode_gejala']; ?>" name="edit">
                        <tr>
                            <td>Gejala</td>
                            <td><textarea name="nama_gejala" class="form-control" required='true'><?php echo $r_edit['nama_gejala']; ?></textarea></td>
                        </tr>
                        <tr>
                        <td style="font-size: 20;" colspan="2">Gejala Ini Muncul Setelah</td>
                      </tr>
                       <tr>
                      <td class="subtitle">Jawaban YA pada</td>
                        <td><select name="kode_induk_ya" id="kode_induk_ya">
                                      <?php
                                       if ($ya=='') echo "<option value=''>- TIDAK ADA -</option>";
                                       else{ 
                                        echo "<option value='$ya'>[$ya] $nama_gejala_ya</option>";
                                       echo "<option value=''>- TIDAK ADA -</option>";
                                       }               
                                    $qryp = mysql_query("SELECT * FROM tabel_gejala where kode_gejala!='$ya'");
                                    while($datap = mysql_fetch_array($qryp)){
                                        echo "<option value='$datap[kode_gejala]'>[$datap[kode_gejala]] $datap[nama_gejala]</option>";
                                    }         
                                    ?>
                                    </select>
                            </td>
                      </tr>
                      <tr>
                        <td class="subtitle">Jawaban TIDAK pada</td>
                        <td><select name="kode_induk_tidak" id="kode_induk_tidak">
                                      <?php
                                       if ($tidak=='') echo "<option value=''>- TIDAK ADA -</option>";
                                       else{ echo "<option value='$tidak'>[$tidak] $nama_gejala_tidak</option>";
                                       echo "<option value=''>- TIDAK ADA -</option>";
                                       }
                                      
                                    $qryp = mysql_query("SELECT * FROM tabel_gejala where kode_gejala!='$tidak'");
                                    while($datap = mysql_fetch_array($qryp)){
                                        echo "<option value='$datap[kode_gejala]'>[$datap[kode_gejala]] $datap[nama_gejala]</option>";
                                    }
                                    ?>
                                    </select>
                            </td>
                      </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Update" name="btn_add" class="btn btn-success"> <!-- tombol update gejala -->
                                <input type="button" value="Batal" class="btn btn-danger" onclick="self.history.back()">
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                    if(isset($_POST["btn_add"])){ 
                        // jika di klik update gejala
                        mysql_query("update tabel_gejala set nama_gejala = '".$_POST["nama_gejala"]."', kode_induk_ya = '".$_POST["kode_induk_ya"]."', kode_induk_tidak = '".$_POST["kode_induk_tidak"]."' where kode_gejala = '".$_POST["edit"]."'");
                        echo "<script>location.href='?page=gejala'</script>";
                    }
                    } elseif(isset($_GET["hapus"])){
                    mysql_query("delete from tabel_gejala where kode_gejala = '".$_GET["hapus"]."'");
                    echo "<script>alert('Data berhasil dihapus')</script>"; 
                    echo "<script>location.href='?page=gejala'</script>";  
                     } elseif(isset($_GET["add"])){
                    ?>
                    <form method="post">
                        <table class="table" style="width: 80%">
                            <tr>
                                <td>Kode Gejala</td>
                                <td><input type="text" name="kode_gejala" class="input" value="<?php echo kd_auto("tabel_gejala", "G"); ?>" size="6" disabled></td>
                            </tr>
                            <input type="hidden" value="<?php echo kd_auto("tabel_gejala", "G"); ?>" name="kode_gejala"> 
                            <tr>
                                <td>Gejala</td>
                                <td><textarea name="nama_gejala" class="form-control" required='true'></textarea></td>
                            </tr>
                            <tr>
                                <tr>
                        <td style="font-size: 20;" colspan="2">Gejala Ini Muncul Setelah</td>
                      </tr>
                        <td class="subtitle">Jawaban YA pada</td>
                        <td><select name="kode_induk_ya" id="kode_induk_ya">
                                      <?php
                                       if ($ya=='') echo "<option value=''>- TIDAK ADA -</option>";
                                       else{ echo "<option value='$ya'>[$ya] $nama_gejala_ya</option>";
                                       echo "<option value=''>- TIDAK ADA -</option>";
                                       }               
                                    $qryp = mysql_query("SELECT * FROM tabel_gejala where kode_gejala!='$ya'");
                                    while($datap = mysql_fetch_array($qryp)){
                                        echo "<option value='$datap[kode_gejala]'>[$datap[kode_gejala]] $datap[nama_gejala]</option>";
                                    }         
                                    ?>
                                    </select>
                            </td>
                      </tr>
                      <tr>
                        <td class="subtitle">Jawaban TIDAK pada</td>
                        <td><select name="kode_induk_tidak" id="kode_induk_tidak">
                                      <?php
                                       if ($tidak=='') echo "<option value=''>- TIDAK ADA -</option>";
                                       else{ echo "<option value='$tidak'>[$tidak] $nama_gejala_tidak</option>";
                                       echo "<option value=''>- TIDAK ADA -</option>";
                                       }
                                      
                                    $qryp = mysql_query("SELECT * FROM tabel_gejala where kode_gejala!='$tidak'");
                                    while($datap = mysql_fetch_array($qryp)){
                                        echo "<option value='$datap[kode_gejala]'>[$datap[kode_gejala]] $datap[nama_gejala]</option>";
                                    }
                                    ?>
                                    </select>
                            </td>
                      </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Tambah" name="btn_add" class="btn btn-success">
                            <input type="button" value="Batal" class="btn btn-danger" onclick="self.history.back()">
                        </td>

                    </tr>
                        </table>
                    </form>
                    <?php
                    // Fungsi Menambah Pneyakit
                    if(isset($_POST["btn_add"])){
                        mysql_query("insert into tabel_gejala set kode_gejala = '".$_POST["kode_gejala"]."', nama_gejala = '".$_POST["nama_gejala"]."',kode_induk_ya = '".$_POST["kode_induk_ya"]."',kode_induk_tidak = '".$_POST["kode_induk_tidak"]."'");
                        echo "<script>location.href='?page=gejala'</script>";
                    }
                }
                else{ ?>

                 <table style="width: 90%;">
                    <tr>
                        <th>NO</th>
                        <th>Kode Gejala</th>
                        <th>Gejala</th> 
                        <th width="15%">Operasi</th>
                    </tr>
                    <?php
                    $no=1;
                    $sql_sol = mysql_query("select * from tabel_gejala order by 1 asc");
                    while($r_sol = mysql_fetch_array($sql_sol)){
                    echo "<tr><td>".$no."</td><td>".$r_sol['kode_gejala']."</td><td class='gejala'>".$r_sol['nama_gejala']."</td>";
                    echo "<td class='tabel_admin'><a href='?page=gejala&edit=".$r_sol['kode_gejala']."'>Edit</a> | <a href='?page=gejala&hapus=".$r_sol['kode_gejala']."'>Hapus</a></td></tr>";
                    $no++;
                }
                ?> 
                </table>
                <?php }
                 ?>

            </div>
        </div>

<?php include('footeradmin.php'); ?>