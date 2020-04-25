<?php include('headeradmin.php'); ?> 

        <div id="hem">
            <div id="hemdalam">
                
            <?php
            if(isset($_GET["edit"])){
            $sql_edit = mysql_query("select * from tabel_penyakit where kode_penyakit = '".$_GET["edit"]."'");
            $r_edit = mysql_fetch_array($sql_edit);
            ?>
            <form method="post" action="" id="geeky" >
            <input type="hidden" value="<?php echo $r_edit['kode_penyakit']; ?>" name="edit">
            <table>
            
            <tr><td>Penyakit</td></tr>
            <tr><td><input type="text" name="debug" value="<?php echo $r_edit['nama_penyakit']; ?>" class="input" /></td></tr>
            <tr><td>Gejala</td></tr>
            <?php

            $yang_mau_diedit = []; 
            $sql_rule = mysql_query("select * from rule where kode_penyakit = '".$_GET["edit"]."'");
            while($r_edit = mysql_fetch_array($sql_rule)){
                $yang_mau_diedit[] = $r_edit["kode_gejala"];
            }

            $sql_sol = mysql_query("select * from tabel_gejala order by 1 asc");
            while($r_sol = mysql_fetch_array($sql_sol)){
                $mac = NULL; // kotak

                for($i=0; $i<count($yang_mau_diedit); $i++){
                    $mac .= $r_sol['kode_gejala'] == $yang_mau_diedit[$i] ? "checked" : NULL;
                }
                echo "<tr><td style='text-align:left'><input type='checkbox' value='".$r_sol['kode_gejala']."' name='kode_gejala[]' ".$mac." class='input'>"."[ ".$r_sol['kode_gejala']." ] ".$r_sol['nama_gejala']."</td></tr>";
            }
            ?>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Update" class="btn btn-success" name="btn_update">
                    <input type="button" value="Batal" class="btn btn-danger" onClick="self.history.back()">
                </td>
            </tr>
            </table>
            </form>
            <?php
            if(isset($_POST["btn_update"])){ 

                $check_ada_di_rule = mysql_query("SELECT * FROM rule WHERE kode_penyakit = '".$_POST["edit"]."'");
                $ada_di_rule = null;    
                if($check_ada_di_rule) $ada_di_rule = mysql_fetch_array($check_ada_di_rule);

                $kumpulan_kode_gejala_yang_dicheck = $_POST["kode_gejala"];

                if($ada_di_rule == null){
                    for($i =0; $i<count($kumpulan_kode_gejala_yang_dicheck); $i++){
                        mysql_query("insert into rule set kode_penyakit = '".$_POST["edit"]."', kode_gejala = '".$kumpulan_kode_gejala_yang_dicheck[$i]."'");                        
                    }

                    echo "<script>location.href='?page=kerusakan&list'</script>";

                }else{
                    mysql_query("delete from rule where kode_penyakit = '".$_POST["edit"]."'");

                    for($i =0; $i<count($kumpulan_kode_gejala_yang_dicheck); $i++){
                        mysql_query("insert into rule set kode_penyakit = '".$_POST["edit"]."', kode_gejala = '".$kumpulan_kode_gejala_yang_dicheck[$i]."'");                        
                    }
                    echo "<script>location.href='?page=kerusakan&list'</script>";
                }
            }
        }else{
            ?>
            <h1 style="color: white">Basis Pengetahuan</h1>
            <table class="table" style="width: 40%">
            <tr><th>No</th><th>Penyakit</th><th>Operasi</th></tr>
            <?php
            $no=1;
            $sql_list = mysql_query("select * from tabel_penyakit order by 1 asc");
            while($r_list = mysql_fetch_array($sql_list)){
                echo "<tr><td>".$no."</td>";
                echo "<td>".$r_list['nama_penyakit']."</td>"; 
                echo "<td><a style=' text-decoration: none;color : #ffffff;' href='?page=relasi&edit=".$r_list['kode_penyakit']."'>Edit</a>";
                $no++;
            }
            ?>
            </table>
                    </div>
                </div>
        <?php } ?>


<?php include('footeradmin.php'); ?>