<body style="font-size:14px;">
<br><br>
<table width="100%">
    <tr>
        <td style="min-width:50%;width:50%;padding-right:30px;padding-left:30px;">
            <?php if($print == TRUE) { ?>
                <img src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/ecocare/media/config/logo.png';?>">
            <?php } else { ?>
                <img src="<?php echo base_url("media/config/logo.png");?>">
            <?php } ?>
        </td>
        <td style="min-width:50%;width:50%;padding-right:30px;padding-left:30px;text-align:right;"><b><h3"><u>BERITA ACARA <?php
        if($data[0]["schedule_type"]=="1"){
            $type =  "INSTALL";           
            }
        elseif($data[0]["schedule_type"]=="2"){
            $type =  "SERVICE";           
            }
        elseif($data[0]["schedule_type"]=="3"){
            $type = "TERMINATION";           
            }
        elseif($data[0]["schedule_type"]=="4"){
            $type =  "COMPLAIN";           
            }
        elseif($data[0]["schedule_type"]=="5"){
            $type =  "SPECIAL REQUEST";           
            }
        echo $type; ?></u><br>(<?php echo $type; ?> REPORT)</h3></b></td>
    </tr>
    
</table>
<table width="100%" style="line-height:2;">
    <tr>
        <td style="width:30%;padding-left:30px;"></td>
        <td style="width:1%;"></td>
        <td style="width:42%;padding-right:30px;"></td>
        <td style="padding-left:30px;" colspan="3"><b><h4 style="padding-left:0;">No.</h4></b></td>
    </tr>
    <tr>
        <td style="width:30%;padding-left:30px;">PELANGGAN</td>
        <td style="width:1%;"> : </td>
        <td style="width:42%;padding-right:30px;"><?php echo $data[0]["customer_name"]?></td>
    </tr>
    <tr>
        <td style="width:30%;padding-left:30px;">ALAMAT PELANGGAN</td>
        <td style="width:1%;"> : </td>
        <td style="width:42%;padding-right:30px;" colspan="4"><?php echo $data[0]["address"]?></td>
    </tr>
</table>
<hr><br>
<table style="width:100%;">
    <tr>
        <td style="padding-right:30px;padding-left:30px;" colspan="3">
            <p>Dengan Hormat,<br>Bersama ini kami beritahukan bahwa kami telah melakukan <?php
        if($data[0]["schedule_type"]=="1"){
            $type =  "install";           
            }
        elseif($data[0]["schedule_type"]=="2"){
            $type =  "service";           
            }
        elseif($data[0]["schedule_type"]=="3"){
            $type = "termination";           
            }
        elseif($data[0]["schedule_type"]=="4"){
            $type =  "complain";           
            }
        elseif($data[0]["schedule_type"]=="5"){
            $type =  "special request";           
            }
        echo $type; ?> pada</p>
        </td>
    </tr>
    <tr style="line-height:2;">
        <td style="width:40%;padding-right:30px;padding-left:30px;">TGL : </td>
        <td style="width:30%;padding-right:30px;padding-left:30px;">JAM MASUK : </td>
        <td style="width:30%;padding-right:30px;padding-left:30px;">JAM KELUAR: </td>
    </tr>
</table>
<br>
<table style="width:50%;">
    <tr>
        <td style="padding-right:30px;padding-left:30px;" colspan="3">
            We Confirm that the installation of <br><br>
        </td>
    </tr>
    <?php 
        if(!empty($data_product)) {
            // print_r($data_detail);
            $sub_total = 0;
            foreach ($data_product as $row) {
    ?>
    <tr>
        <td style="width:40%;padding-right:30px;padding-left:30px;"><?php echo $row["product_name"]?></td>
        <td style="width:5%;padding-right:30px;padding-left:30px;">
            <?php 
                if(!empty($row["category_name"])) echo $row["product_qty"]."  ".$row["category_name"];
                else echo $row["product_qty"];
            ?>
        </td>
    </tr>
    <?php }}
            if(!empty($data_package)) {
                foreach ($data_package as $row) {  
    ?>
    <tr>
        <td style="width:40%;padding-right:30px;padding-left:30px;"><?php echo $row["package_name"]?></td>
        <td style="width:5%;padding-right:30px;padding-left:30px;">
            <?php 
               echo $row["package_qty"];
            ?>
        </td>
    </tr>
    <?php               
        }} else { 
    ?>
        <tr>
        <td style="padding-right:30px;padding-left:30px;">No product and Package</td>
    </tr>
    <?php } ?>
</table>
<br><br>
<table style="width:100%;line-height:1.7;">
    <tr>
        <td style="padding-right:30px;padding-left:30px;">
            <b>PELAKSANAAN SERVICE : </b><br>
            <hr style="border-bottom: dotted 1px;margin:30px 0;" />
            <hr style="border-bottom: dotted 1px;margin:30px 0;" />
            <hr style="border-bottom: dotted 1px;margin:30px 0;" />
            <hr style="border-bottom: dotted 1px;margin:20px 0;" />
        </td>
    </tr>
    <tr>
        <td style="padding-right:30px;padding-left:30px;">
            <p>Info Tambahan : </p>
            <hr style="border-bottom: dotted 1px;margin:30px 0;" />
            <hr style="border-bottom: dotted 1px;margin:30px 0;" />
            <hr style="border-bottom: dotted 1px;margin:20px 0;" />
        </td>
    </tr>
    <tr>
        <td style="padding-right:30px;padding-left:6px;"> 
            <ul>
                <li>Berita acara ini merupakan lampiran untuk melakukan penagihan (kwitansi)</li>
                <li>Jika anda memerlukan informasi tambahan, silahkan menghubungi Service Controller kami.</li>
            </ul>
        </td>
    </tr>
</table>
<table style="width:100%;">
    <tr>
        <td style="width:50%;padding-right:30px;padding-left:30px;text-align:center;">
            <br><br><br><br>
            <p style="padding:20px;text-decoration: overline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PELANGGAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </td>
        <td style="width:50%;padding-right:30px;padding-left:30px;text-align:center;">
            <br><br><br><br>
            <p style="text-decoration: overline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TEKNISI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </td>
    </tr>
</table>
<br><br><br>
<table style="width:100%;line-height:1.6;word-spacing:4px;">
    <tr>
        <td style="width:50%;padding-right:30px;padding-left:30px;;text-align:center;">
            <p><b>PT.Indocare Pacific</b><br>Grand Slipi Tower Suite AL 36<sup>th</sup> Floor Jl. S. Parman Kav. 22 Slipi, Jakarta 11480 Telp. +62 21 29022266 Fax. +62 21 29022268, Jakarta : (021) 8370 5887, Semarang : (024) 747 9038, Yogyakarta : (0274) 586 591, Bandung : (022) 520 7596, Surabaya : (031) 847 0022, Medan : (061) 452 7828, Makassar : (0411) 868 525<br>Email : carepacific@cbn.net.id Website : www.ecocare.co.id<br><br>Putih : Tagihan Merah : Palnggan Kuning : File</b></p>
        </td>
    </tr>
</table>
</hr>
<?php if($print == FALSE) { ?>
<div class="form-actions fluid">
        <div class="col-md-12">
            <center>
                <form action="" method="post" class="form-horizontal" enctype='multipart/form-data'>
                    <input type="hidden" name="contract_schedule_id" value="<?php echo $data[0]['contract_schedule_id']?>">
                    <input type="submit" name="pdf" value="Print PDF" class="btn blue" />
                    <!-- <button type="submit" name="pdf" class="btn blue"><b>Print PDF</b></button> -->
                    <button type="reset" class="btn black" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'" id="reset"><b>Back</b></button>
                </form>
            </center>
        </div>
    </div>
    <?php } ?>
</body>