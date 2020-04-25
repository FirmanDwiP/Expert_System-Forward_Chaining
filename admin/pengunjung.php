<?php include('headeradmin.php'); ?> 

        <div id="hem">
            <div id="hemdalam">
               <?php
              if(isset($_GET["hapus"])){
                mysql_query("delete from tabel_pengunjung where kode_pengunjung = '".$_GET["hapus"]."'");
                echo "<script>alert('Data berhasil dihapus')</script>";
                echo "<script>location.href='?page=pengunjung'</script>";
              }elseif(isset($_GET["k"])){

                $kode_pengunjung = $_GET["k"];
                $query_pengunjung = mysql_query("SELECT * 
                  FROM tabel_pengunjung
                  WHERE kode_pengunjung = '$kode_pengunjung'
                  ");

                $hasil_query = mysql_fetch_array($query_pengunjung); ?>

                <table class="table" style="width:100%">
                      <tr>
                        <th>Nama Pengunjung</th>
                        <th>NO HP</th> 
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                      </tr>
                      <tr> 
                        <?php
                        echo "<td style='text-align:left'>".$hasil_query['nama_pengunjung']."</td>";
                        echo "<td style='text-align:left'>".$hasil_query['nohp_pengunjung']."</td>";
                        echo "<td style='text-align:left'>".$hasil_query['ttl_pengunjung']."</td>";
                        echo "<td style='white-space: pre-line; width:400px;text-align:left'>".$hasil_query['alamat_pengunjung']."</td>";
                        ?>
                      </tr>
                    </table>
                <center><input type='button' class='btn btn-dark btn-sm' value='Kembali' onclick='self.history.back()'></center>
              <?php }

              elseif (isset($_GET["g"])) {
                $kode_penyakit = $_GET["g"];
                $query_penyakit = mysql_query("SELECT * 
                  FROM tabel_penyakit
                  WHERE kode_penyakit = '$kode_penyakit'
                  ");

                $hasil_query = mysql_fetch_array($query_penyakit); ?>
                <table class="table" style="width:100%">
                      <tr>
                        <th>Nama Penyakit</th>
                        <th>Definisi</th> 
                        <th>Pengobatan</th>
                        <th>Pencegahan</th>
                      </tr>
                      <tr> 
                        <?php
                        echo "<td style='text-align:left'>".$hasil_query['nama_penyakit']."</td>";
                        echo "<td style='text-align:left'>".$hasil_query['definisi']."</td>";
                        echo "<td style='text-align:left'>".$hasil_query['pengobatan']."</td>";
                        echo "<td style='white-space: pre-line; width:400px;text-align:left'>".$hasil_query['pencegahan']."</td>";
                        ?>
                      </tr>
                    </table>
                <center><input type='button' class='btn btn-dark btn-sm' value='Kembali' onclick='self.history.back()'></center>
        <?php }else {
                ?>
                <form>
                  <table class="table" style="width: 80%">
                    <tr>
                      <th>No</th>
                      <th>Nama Pengunjung</th>
                      <th>Penyakit</th>
                      <th>Waktu Diagnosa</th>
                      <th>Operasi</th>
                    </tr>
                    <?php
                    $no=1;
                    $sql_sol = mysql_query("SELECT a.nama_pengunjung, a.kode_pengunjung,
                              c.nama_penyakit, c.kode_penyakit,
                              b.tgl_rekammedis
                              FROM tabel_pengunjung a 
                              JOIN rekammedis b
                                ON a.kode_pengunjung = b.kode_pengunjung
                              JOIN tabel_penyakit c
                                ON b.kode_penyakit = c.kode_penyakit
                                ORDER BY b.tgl_rekammedis ASC
                      ");

                    while($r_sol = mysql_fetch_array($sql_sol)){ ?>
                      <tr><td><?=$no?></td>
                      <td class='tabel_admin'><a href="?page=pengunjung&k=<?=$r_sol['kode_pengunjung']?>"> <?=$r_sol['nama_pengunjung']?> </a></td>
                      <td class='tabel_admin'><a href="?page=pengunjung&g=<?=$r_sol['kode_penyakit']?>"> <?=$r_sol['nama_penyakit']?> </a></td>
                      <td> <?=$r_sol["tgl_rekammedis"]?> </td>
                      <td class='tabel_admin'><a href="?page=pengunjung&hapus=<?=$r_sol['kode_pengunjung']?>">Hapus</a></td></tr>
                      <?php $no++;  
                     }
                    ?>
                  </table>

                  <!-- <?php
                    $sql_tampilkan_statistic = mysql_query("SELECT c.nama_penyakit, b.tgl_rekammedis, COUNT(c.nama_penyakit) as jumlah_penyakit FROM tabel_pengunjung a
                  JOIN rekammedis b
                  on a.kode_pengunjung = b.kode_pengunjung
                  JOIN tabel_penyakit c
                  on b.kode_penyakit = c.kode_penyakit
                  GROUP by c.nama_penyakit
                  ");

                  while($r_statistic = mysql_fetch_array($sql_tampilkan_statistic)){ ?>
                    <p> <?=$r_statistic["nama_penyakit"] ?> </p>
                    <p> <?=$r_statistic["jumlah_penyakit"] ?> </p>

                  <?php } ?> -->
                </form>

              <?php
              } 
              ?>
            </div>
        </div>
<?php include('footeradmin.php'); ?>