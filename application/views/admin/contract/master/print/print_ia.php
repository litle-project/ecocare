<body style="font-size:14px;">
<br><br>
<table width="100%">
    <tr>
        <td style="width:30%;padding-right:30px;padding-left:30px;">
            <?php if($print == TRUE) { ?>
                <img src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/ecocare/media/config/logo.png';?>">
            <?php } else { ?>
                <img src="<?php echo base_url("media/config/logo.png");?>">
            <?php } ?>
            <br><br><br><br>
            <b><h3">INSTALATION<br>ACKNOWLEDGEMENT</h3></b>
        </td>
        <td style="width:70%;padding-right:30px;padding-left:30px;">
            <table style="font-size:12px;">
                <tr>
                    <td colspan="2">   
                        <h4 style="padding:0;margin:0;">PT. INDOCARE PACIFIC</h4>
                    </td>
                </tr>
                <tr>
                    <td style="width:50%;padding:0;">
                        Head Office:<br>
                        Telp. (021) 290 22266 Fax. (021) 290 22268<br>
                        Semaang<br>
                        Telp/Fax : (024) 747 9038<br>
                        Yogyakarta<br>
                        Telp/Fax : (0274) 586 591<br>
                        Bandung<br>
                        Telp/Fax : (022) 520 7596
                    </td>
                    <td style="width:50%;padding-left:30px;">
                        Surabaya<br>
                        Telp : (031) 841 3377 Fax : (031) 841 5566<br>
                        Medan<br>
                        Telp : (061) 452 7828 Fax : (061) 452 7563<br>
                        Bali<br>
                        Telp. (0361) 221 935<br>
                        Makassar<br>
                        Telp : (0411) 868 525
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<hr>
<table width="100%" style="">
    <tr>
        <td style="width:67%;padding-right:30px;padding-left:30px;">
            Name : <b><?php echo $data_customer[0]["customer_name"]?></b><br>
        </td>
        <td style="width:33%;padding-right:30px;padding-left:0px;">
            Contract Ref. No: <?php echo $data_customer[0]["contract_no"]?><br>
        </td>
    </tr>
    <tr>
        <td style="padding-right:30px;padding-left:30px;">
            Address : <b><?php echo $data_customer[0]["address"]?></b><br>
        </td>
        <td style="padding-right:30px;padding-left:0px;">
            Work Order No.  : <br>
        </td>
    </tr>
    <tr>
        <td style="padding-right:30px;padding-left:30px;">
            <hr style="border-bottom: dotted 1px;">
        </td>
        <td style="padding-right:30px;padding-left:0px;">
            Telp. No. : <?php echo $data_customer[0]["customer_phone"]?><br>
        </td>
    </tr>
    <tr>
        <td style="padding-right:30px;padding-left:30px;">
            <hr style="border-bottom: dotted 1px;">
        </td>
        <td style="padding-right:30px;padding-left:0px;">
            Contact Person : <?php echo $data_customer[0]["customer_pic"]?>
        </td>
    </tr>
</table>
<table style="width:80%;">
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
                if(!empty($row["category_name"])) echo $row["amount"]."  ".$row["category_name"];
                else echo $row["amount"];
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
               echo $row["product_package_qty"];
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
<table>
    <tr>
        <td style="padding-right:30px;padding-left:30px;"><br>As spesified in the contract bearing the above reference number. has been completed satisfactorily</td>
    </tr>
</table>
<table style="width:80%;">
    <tr>
        <td style="width:10%;padding-left:30px;">
            <p>Notes<br><br><br><br><br><br><br></p>
            
        </td>
        <td style="width:70%;">
            <hr style="border-bottom: dotted 1px;margin:20px 0;" />
            <hr style="border-bottom: dotted 1px;margin:20px 0;" />
            <hr style="border-bottom: dotted 1px;margin:20px 0;" />
            <hr style="border-bottom: dotted 1px;margin:20px 0;" /0>
            <hr style="border-bottom: dotted 1px;margin:20px 0;" />
            <hr style="border-bottom: dotted 1px;margin:20px 0;" />
            <hr style="border-bottom: dotted 1px;margin:20px 0;" />
        </td>
    </tr>
</table>
<table style="width:100%;">
    <tr>
        <td style="width:50%;padding-left:30px;padding-right:30px;" colspan="2">
            <hr style="border-bottom: dotted 1px;margin:6px 0;padding-left:30px;">Name
            <hr style="border-bottom: dotted 1px;margin:6px 0;padding-left:30px;">
        </td>
    </tr>
    <tr>
        <td style="width:50%;padding-left:30px;">
            Designation
        </td>
        <td style="width:50%;padding-right:30px;">
            Signature / Date
        </td>
    </tr>
    <tr>
        <td style="width:50%;padding-left:30px;padding-right:30px;text-align:center;" colspan="2">
            <hr style="border-bottom: dotted 1px;margin:6px 0;padding-left:30px;">
            <b>FOR OFFICE USE ONLY<b>
            <hr style="border-bottom: dotted 1px;margin:6px 0;padding-left:30px;">
        </td>
    </tr>
</table>
<br>
<table style="width:100%;">
    <tr>
        <td style="width:50%;padding-right:30px;padding-left:30px;text-align:center;">
            Installed by / date :
            <br><br><br><br>          
            <p style="text-decoration: overline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Technicians&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </td>
        <td style="width:50%;padding:0 30px;text-align:center;">
            Approved by / date :
            <br><br><br><br>
            <p style="text-decoration: overline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Operational Manager&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </td>
    </tr>
</table>
<?php if($print == FALSE) { ?>
<div class="form-actions fluid">
        <div class="col-md-12">
            <center>
                <form action="" method="post" class="form-horizontal" enctype='multipart/form-data'>
                    <input type="submit" name="pdf" value="Print PDF" class="btn blue" />
                    <!-- <button type="submit" name="pdf" class="btn blue"><b>Print PDF</b></button> -->
                    <button type="reset" class="btn black" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'" id="reset"><b>Back</b></button>
                </form>
            </center>
        </div>
    </div>
    <?php } ?>
</body>