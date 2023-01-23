<style>
hr {
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: solid;
    border-width: 2px;
}
.center {
    margin: auto;
    width: 80%;
}
</style>
<h1><?php echo $title;?></h1>
<br/>
<div class="container">
    <b><h4>PT. INDOCARE PASIFIC</h4></b>
    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                
                Address :<br>
                Head Office :<br>
                Grand Slipi Tower<br>
                Suite AL, 36 Floor<br>
                Jl. S.Parman Kav.22-24<br>
                Slipi, Jakarta 11480<br>
                Phone:+62 21 290 22266<br>
                Fax:+62 21 290 22268<br>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                Branch Office:<br>
                Semarang    : Telp./Fax. (024) 747 9038<br>
                Yogyakarta  : Telp./Fax. (0274) 586 591<br>
                Bandung     : Telp./Fax. (022) 520 7695<br>
                Surabaya    : Telp. (031) 841 3377 Fax. (031) 841 5566<br>
                Medan       : Telp. (061) 452 7828 Fax. (061) 452 7563<br>
                Bali        : Telp. (0361) 221 935<br>
                Makassar    : Telp. (0411) 811 4210, (0411) 520 3339<br>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <img src="<?php echo base_url("media/config/logo.png");?>" style='border:2px solid transparent;'>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                Customer : <b><?php echo $data[0]["customer_name"];?></b><br>
                Address : <b><?php echo $data[0]["address"];?></b><br>
                NPWP :<b><?php echo $data[0]["customer_npwp"];?></b><br>
                Telp. :<b><?php echo $data[0]["customer_phone"];?></b><br>
                Email :<b><?php echo $data[0]["customer_email"];?></b><br>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
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
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 center">
            <CENTER><b><h4>CONTRACT/RENEWAL</h4></b></CENTER>
            <p>These recommendation are offered to enable you to maintain highest standarts of Hygiene in your Washroom areas. Our Sales Consultant will be pleased to provide further applications should you required. These inspections recommended in accordance with Spesification, Survey, Terms and Condition mentioned overleaf are itemized below :.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 center">
            <table style="width:100%;">
                <?php if(!empty($detail_product)){ ?>
                
                <h4 style="padding:0;">PRODUCT / PACKAGE</h4>

                <?php foreach ($detail_product as $row) { ?>
                <tr style="padding-right: 20px">
                    <td><b><?php echo $row["product_name"]?></b></td>
                    <td><?php echo $row["amount"]." x ".$row["category_name"]; ?> </td>
                    <td> X </td>
                    <td>Rp. </td>
                    <td><?php echo $row["price"];?> each per annum = </td>
                    <td>Rp. </td>
                    <td><?php 
                            $total_price_product = $row["amount"]*$row["price"];
                            echo $total_price_product;
                        ?>/year
                    </td>
                </tr>
                <?php }} ?>

                <?php if(!empty($detail_package)){ 
                    foreach ($detail_package as $key) { ?>
                <tr>
                    <td><b><?php echo $key["package_name"]?></b></td>
                    <td><?php echo $key["product_package_qty"]; ?></td>
                    <td> X </td>
                    <td>Rp. </td>
                    <td><?php echo $key["price"];?> each per annum = </td>
                    <td>Rp. </td>
                    <td>
                    <?php 
                        $total_price_package = $key["product_package_qty"]*$key["price"];
                        echo $total_price_package;
                    ?>/year
                    </td>
                </tr>
                <?php }} ?>
            </table>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-5" style="float: right;">
            <table style="width:80%;">
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
                <td>SUB TOTAL</td>
                <td>=</td>
                <td>Rp. </td>
                <td><?php echo $sub_total;?> </td>
                <td> /year</td>
              </tr>
              <tr>
                <td>PPN 10%</td>
                <td>=</td>
                <td>Rp. </td>
                <td style="border-bottom: 1px solid #000;"><?php $ppn = $sub_total * 0.1; echo $ppn;?></td>
                <td> /year</td>
              </tr>
            </table>
            <table style="width:80%;">
              <tr>
                <td>TOTAL</td>
                <td>=</td>
                <td>Rp. </td>
                <td><?php $total = $sub_total+$ppn; echo $total;?></td>
                <td> /year</td>
              </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" style="padding-left: 7%;">
            <!-- <div class="portlet box grey">
                <div class="portlet-body form"> -->
                        <?php 
                        $total3bln = $total/$data[0]["contract_payment"]; 
                        ?>
                        <b>TERM OF PAYMENT : <?php echo $data[0]["contract_payment"];?>x/year @ Rp. <?php echo $total3bln;?></b><br><br>
                        <p>We Understand fully the contract price as detailed in schedule. Specification. Terms and Conditions and confirm.</p>
                <!-- </div>
            </div> -->
        </div>
    </div>
    <BR>
    <div class="row">
        <div class="col-md-4" style="padding-left: 7%;">
            <!-- <div class="portlet box grey">
                <div class="portlet-body form"> -->
                        <b>PT INDOCARE PASIFIC</b><br><br><br>
                        HANDAYANI NUGROHO
                        <p style="text-decoration: overline;">signed for and on behalf of</p>
                <!-- </div>
            </div> -->
        </div>
        <div class="col-md-4" style=" float:right;">
            <!-- <div class="portlet box grey">
                <div class="portlet-body form"> -->
                        <br><br><br><br>
                        
                        <p style="text-decoration: overline;">signed for and on behalf of</p>
                <!-- </div>
            </div> -->
        </div>
    </div>
    <hr>

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
</div>