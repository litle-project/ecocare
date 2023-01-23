<body style="font-size:12px;">
<br><br>
<table width="100%">
    <tr>
        <td style="min-width:50%;width:50%;padding-right:30px;padding-left:30px;text-align:left;"><b><h3"><u>BERITA ACARA <?php $type = "KEHILANGAN UNIT"; echo $type; ?></u><br>(<?php echo $type; ?> REPORT)</h3></b></td>
        <td style="min-width:50%;width:50%;padding-right:30px;padding-left:30px;">
            <?php if($print == TRUE) { ?>
                <img src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/ecocare/media/config/logo.png';?>">
            <?php } else { ?>
                <img src="<?php echo base_url("media/config/logo.png");?>">
            <?php } ?>
        </td>
    </tr>
    
</table>
<table width="100%" style="line-height:2;">
    <tr>
        <td style="width:30%;padding-left:30px;">Pekerjaaan</td>
        <td style="width:1%;"> : </td>
        <td style="width:42%;padding-right:30px;">Pengadaan Sewa Kontrak Jasa Hygiene Service</td>
    </tr>
    <tr>
        <td style="width:30%;padding-left:30px;">Pelaksana</td>
        <td style="width:1%;"> : </td>
        <td style="width:42%;padding-right:30px;" colspan="4">PT Indocare Pacific</td>
    </tr>
</table>
<hr><br>
<table style="width:100%;">
    <tr>
        <td style="padding-right:30px;padding-left:30px;" colspan="3">
            <p>Kami yang bertanda tangan di bawah ini: </p>
        </td>
    </tr>
    <tr style="line-height:2;">
        <td width="150px" style="padding-left: 30px;">Pelanggan : </td>
        <td><?php echo $data[0]["customer_name"];?></td>
    </tr>
    <tr style="line-height:2;">
        <td style="padding-left: 30px;">Nama : </td>
        <td><?php echo $data[0]["customer_pic"];?></td>
    </tr>
    <tr style="line-height:2;">
        <td style="padding-left: 30px;">Jabatan : </td>
        <td></td>
    </tr>
    <tr style="line-height:2;">
        <td style="padding-left: 30px;">Alamat : </td>
        <td><?php echo $data[0]["address"];?></td>
    </tr>
</table>
<br>
<table style="width:100%;">
    <tr>
        <td style="padding-right:30px;padding-left:30px;" colspan="3">
            <p>Dalam hal ini mewakili Pelanggan, yang selanjutnya disebut sebagai <b>PIHAK KESATU</b></p>
        </td>
    </tr>
    <tr style="line-height:2;">
        <td width="150px" style="padding-left: 30px;">Nama : </td>
        <td><?php echo $teknisi[0]["teknisi_name"];?></td>
    </tr>
    <tr style="line-height:2;">
        <td style="padding-left: 30px;">Jabatan : </td>
        <td>Teknisi</td>
    </tr>
    <tr style="line-height:2;">
        <td style="padding-left: 30px;">Alamat : </td>
        <td><?php echo $teknisi[0]["teknisi_address"];?></td>
    </tr>
</table>

<table style="width:100%;line-height:2;">
    <tr>
        <td style="padding-right:30px;padding-left:30px;">
            <p style="text-align: justify;">Dalam hal ini mewakili <b>PT INDOCARE PACIFIC</b> yang selanjutnya disebut sebagai <b>PIHAK KEDUA</b></b></p>
            <p style="text-align: justify;">Menyatakan bahwa kedua belah pihak telah melakukan pemeriksaan pekerjaan dan pengecekan ulang unit <b>ECOCARE</b> dalam perjanjian kerjasama pengadaan Jasa Hygiene Service. Dan ditemukan adanya <b>KEHILANGAN UNIT </b>:</p>
        </td>
    </tr>
    <tr>
        <td style="padding-right:30px;padding-left:30px;">
            <ul>
            <?php foreach ($product as $key) { ?>
                <li><?php echo $key["lost_qty"];?> (Unit) <?php echo $key["product_name"];?> </li>
            <?php } ?>
            </ul>
        </td>
    </tr>
    <tr>
        <td style="padding-right:30px;padding-left:30px;"> 
            <p>Demikian <b>BERITA ACARA KEHILANGAN</b> ini dibuat, dan agar menjadi perhatian dan tanggung jawab bagi semua pihak yang bersangkutan. Atas perhatian dan kerjasamanya saya ucapkan terima kasih.</p>
        </td>
    </tr>
</table>


<table style="width:100%;">
    <tr>
        <td style="width:50%;padding-right:30px;padding-left:30px;text-align:center;">
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PIHAK KESATU&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <br><br><br>
            <p style="text-decoration: overline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </td>
        <td style="width:50%;padding-right:30px;padding-left:30px;text-align:center;">
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PIHAK KEDUA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>PT. INDOCARE PACIFIC</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <br><br><br>
            <p style="text-decoration: overline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pimpinan Cabang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </td>
    </tr>
</table>

<?php if($print == FALSE) { ?>
<div class="form-actions fluid">
        <div class="col-md-12">
            <center>
                <form action="<?php echo site_url('contract_lost/print_ba/'.$data[0]['contract_id'].'');?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
                    <input type="submit" name="pdf" value="Print PDF" class="btn blue" />
                    <!-- <button type="submit" name="pdf" class="btn blue"><b>Print PDF</b></button> -->
                    <button type="reset" class="btn black" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'" id="reset"><b>Back</b></button>
                </form>
            </center>
        </div>
    </div>
    <?php } ?>
</body>