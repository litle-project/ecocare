<body style="font-size:12px;">
<table>
    <tr>
        <td style="width:100%;padding-right:15px;padding-left:15px;"><b><h4>PT. INDOCARE PASIFIC</h4></b></td>
    </tr>
</table>
<table>
    <tr>
        <td style="width:40%;padding-right:50px;padding-left:15px;">
            Address :<br>
            Head Office :<br>
            Grand Slipi Tower<br>
            Suite AL, 36 Floor<br>
            Jl. S.Parman Kav.22-24<br>
            Slipi, Jakarta 11480<br>
            Phone:+62 21 290 22266<br>
            Fax:+62 21 290 22268<br>
        </td>
        <td style="width:40%;padding-right:15px;padding-left:15px;">
            Branch Office:<br>
            Semarang    : Telp./Fax. (024) 747 9038<br>
            Yogyakarta  : Telp./Fax. (0274) 586 591<br>
            Bandung     : Telp./Fax. (022) 520 7695<br>
            Surabaya    : Telp. (031) 841 3377 Fax. (031) 841 5566<br>
            Medan       : Telp. (061) 452 7828 Fax. (061) 452 7563<br>
            Bali        : Telp. (0361) 221 935<br>
            Makassar    : Telp. (0411) 811 4210, (0411) 520 3339<br>
        </td>
        <td style="width:20%;padding-right:15px;padding-left:15px;">
            <img src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/ecocare/media/config/logo.png';?>" width="200px">
        </td>
    </tr>
</table>
<hr><br>
<table>
    <tr>
        <td style="width:62.66666666666666%;padding-right:80px;padding-left:15px;">
            Customer : <b><?php echo $data[0]["customer_name"];?></b><br>
            Address : <b><?php echo $data[0]["address"];?></b><br>
            NPWP :<b><?php echo $data[0]["customer_npwp"];?></b><br>
            Telp. :<b><?php echo $data[0]["customer_phone"];?></b><br>
            Email :<b><?php echo $data[0]["customer_email"];?></b><br>
        </td>
        <td style="width:20%;padding-right:15px;padding-left:15px;">
            <?php
                $contract_period = $data[0]["contract_period"];
                $install_date = DateTime::createFromFormat('Y-m-d', $data[0]["install_date"]);
                $contract_date = DateTime::createFromFormat('Y-m-d', $data[0]["contract_date"]);
                $start_date = date('d/m/Y', strtotime("+1 months", strtotime($data[0]["install_date"])));
                $end_date = date('d/m/Y', strtotime("+".$data[0]["contract_period"]." months", strtotime($data[0]["install_date"])));
            ?>
            Contract Tenor: <?php echo $data[0]["contract_period"];?> Months<br>
            Ref. No.  : <?php echo $data[0]["contract_no"];?><br>
            Date : <?php echo date_format($contract_date,"d M Y");?><br>
            Period : <?php echo "Period ".$contract_period." Months (".$start_date." TO ".$end_date.")";?><br>
        </td>
    </tr>
</table>
<table>
    <tr>
        <td style="width:100%;padding-right:15px;padding-left:15px;"><CENTER><b><h4>CONTRACT/RENEWAL</h4></b></CENTER></td>
    </tr>
    <tr>
        <td style="width:100%;padding-right:15px;padding-left:15px;">
            <p>These recommendation are offered to enable you to maintain highest standarts of Hygiene in your Washroom areas. Our Sales Consultant will be pleased to provide further applications should you required. These inspections recommended in accordance with Spesification, Survey, Terms and Condition mentioned overleaf are itemized below :</p>
        </td>
    </tr>
</table>
<table>
    <?php if(!empty($detail_product)) { ?>
    <tr>
        <td style="padding-right:15px;padding-left:15px;" colspan="8"><b><!-- PRODUCT --></b></td>
    </tr>
    <h4 style="padding-left:5%;">PRODUCT / PACKAGE</h4>
    <?php foreach ($detail_product as $row) { ?>
    <tr style="padding-right: 20px">
        <td style="width:40%;padding-left:55px;"><b><?php echo $row["product_name"];?></b></td>
        <td style="width:10%">
            <?php 
                echo $row["amount"]." x ".$row["category_name"];
            ?> 
        </td>
        <td style="width:1%"> X </td>
        <td style="width:2%">Rp. </td>
        <td style="width:40%"><?php echo $row["price"];?> each per annum = </td>
        <td style="width:2%">Rp. </td>
        <td style="width:30%">
            <?php 
                $total_price_product = $row["amount"]*$row["price"];
                echo $total_price_product;
            ?>/year
        </td>
    </tr>

     <?php }} if(!empty($detail_package)){ ?>
    <tr>
        <td style="padding-right:15px;padding-left:15px;" colspan="8"><b><!-- PACKAGE --></b></td>
    </tr>
    <?php foreach ($detail_package as $key) { ?>
    <tr>
        <td style="width:40%;padding-left:55px;"><b><?php echo $key["package_name"]?></b></td>
        <td style="width:5%"><?php echo $key["product_package_qty"]; ?></td>
        <td style="width:1%"> X </td>
        <td style="width:2%">Rp. </td>
        <td style="width:40%"><?php echo $key["price"];?> each per annum = </td>
        <td style="width:2%">Rp. </td>
        <td style="width:30%">
            <?php 
                $total_price_package = $key["product_package_qty"]*$key["price"];
                echo $total_price_package;
            ?>/year
        </td>
    </tr>
    <?php }} ?>
    <br>
    <?php
        if (!empty($detail_product) && !empty($detail_package)) {
            $sub_total = $total_price_product+$total_price_package; 
        }elseif(!empty($detail_product)){
            $sub_total = $total_price_product;
        }elseif(!empty($detail_package)){
            $sub_total = $total_price_package;
        }else{
            $sub_total = 0;
        }
    ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>SUB TOTAL =</td>
        <td>Rp. </td>
        <td><?php echo $sub_total;?> / year</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="width:20%;">PPN 10% =</td>
        <td>Rp. </td>
        <td style="border-bottom: 1px solid #000; width:10%; "><?php $ppn = $sub_total * 0.1; echo $ppn;?> / year</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>TOTAL =</td>
        <td>Rp. </td>
        <td><?php $total = $sub_total+$ppn; echo $total;?> / year </td>
        <td></td>
    </tr>
    <!-- <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>TOTAL / Month =</td>
        <td>Rp. </td>
        <td>
            <?php $total_bulanan = $total/12; 
            echo $total_bulanan;?> / month 
        </td>
        <td></td>
    </tr> -->
</table>
<br><br>
<table>
    <tr>
        <?php $total3bln = $total/$data[0]["contract_payment"]; ?>
        <td style="padding-left:15px;"><b>TERM OF PAYMENT : <?php echo $data[0]["contract_payment"];?>x/year @ Rp. <?php echo $total3bln;?></b><br></td>
    </tr>
    <tr>
        <td style="padding-left:15px;">
            <p>We Understand fully the contract price as detailed in schedule. Specification. Terms and Conditions and confirm.</p><br><br>
        </td>
    </tr>
</table>

<table>
    <tr>
        <td style="min-width:50%;width:50%;padding-right:150px;padding-left:15px;">
            <b>PT INDOCARE PASIFIC</b><br><br><br><br><br>
            HANDAYANI NUGROHO
            <p style="text-decoration: overline;">signed for and on behalf of</p>
        </td>
        <td style="min-width:50%;width:50%;padding-right:15px;padding-left:150px;text-align:right;">
            <br><br><br><br><br><br>
            <p style="text-decoration: overline;">signed for and on behalf of</p>
        </td>
    </tr>
</table>
</hr>
</body>