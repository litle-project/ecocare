<style>

td, th {
    border: 1px solid black;
}

td{

    padding-left: 10px;
}


</style>

<body style="font-size:12px;">
<br><br>
    <div style="width: 100%">
        <div style="margin-left: 50px;">
            <?php if($print == TRUE) { ?>
                <img src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/ecocare2/media/config/logo.png';?>">
            <?php } else { ?>
                <img src="<?php echo base_url("media/config/logo.png");?>">
            <?php } ?>
        </div>
        <div style="margin-left: 100px; margin-top: -55px">
            <h3 align="center">UNIT/MATERIAL<br>RETURNED TO STORE</h3>
        </div>
    </div>
    <br>
    <?php if(!empty($rts_number[0]['last_id'])){
        
        $number_queue = sprintf('%06d',$rts_number[0]["last_id"]+1);
        // $number_queue = "001";

    }else{

        $number = 0;
        $number_queue = sprintf('%06d',$number+1);
   } ?>

    <?php if ($print == TRUE){ ?>
    <div>
        <b>To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Store keeper </b><br>
        <b>Customer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data[0]["customer_name"];?> </b><br>
        <b>No. UR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </b><br>
        <b>No. RTS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $number_queue; ?> </b><br>
        <b>Contract_no &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data[0]['contract_no']; ?> </b><br>
    </div>    
    <?php }else {?>
    <div style="margin-left: 60px;">
        <b>To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Store keeper </b><br>
        <b>Customer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data[0]["customer_name"];?> </b><br>
        <b>No. UR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </b><br>
        <b>No. RTS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $number_queue; ?> </b><br>
        <b>Contract_no &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data[0]['contract_no']; ?> </b><br>
    </div>
    <?php } ?>
    <br>
    <hr>
    <div style="margin-left: 60px">
        <b>Please Collect The Following Unit / Material</b>
    </div>
    <br>
    
    <table class="table table-striped table-bordered table-hover" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr class="tr">
                    
                    <th class="th">No</th>
                    <th class="th">UNIT</th>
                    <th class="th">TYPE</th>
                    <th class="th">QUANTITY</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no=1;
                    for($i=0; $i <count($data) ; $i++){
                ?>
                        <tr class="gradeX">
                            <td class="td"><?php echo $no;?></td>
                            <td class="td"><?php echo $data[0]["product_name"]; ?></td>
                            <td class="td"><?php echo $data[0]["category_name"]; ?></td>
                            <td class="td"><?php echo $data[0]["product_qty"]; ?></td>
                        </tr>
                <?php 
                    $no++;
                } 
                ?>
                <?php for ($i=1; $i<5; $i++){?>
                        <tr>
                            <td class="td">&nbsp;</td>
                            <td class="td">&nbsp;</td>
                            <td class="td">&nbsp;</td>
                            <td class="td">&nbsp;</td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
        <br>
        <?php if($print == TRUE){ ?>
        <table width="100%" border="0" align="center">
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Prepared by&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td style="padding-left: 30px">&nbsp;&nbsp;&nbsp;&nbsp;Checked by&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;Approved by&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;Booked by&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td style="height: 100px"> </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="text-decoration: overline;">&nbsp;&nbsp;&nbsp;&nbsp;Technician&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td style="padding-left: 30px; text-decoration: overline;">&nbsp;&nbsp;&nbsp;&nbsp;Store Keeper&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td align="right" style="text-decoration: overline;">&nbsp;&nbsp;&nbsp;&nbsp;Service Manager&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td align="center" style="padding-left: 30px; text-decoration: overline;">&nbsp;&nbsp;&nbsp;&nbsp;Adm Service&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
        </table>
        <?php }else{?>
        <div style="margin-left: 90px">
            &nbsp;&nbsp;&nbsp;&nbsp;Prepared by&nbsp;&nbsp;&nbsp;&nbsp; <br><br><br><br>
            <section style="text-decoration: overline;">&nbsp;&nbsp;&nbsp;&nbsp;Technican&nbsp;&nbsp;&nbsp;&nbsp;</section>
        </div>
        <div style="margin-left: 250px; margin-top: -85px">
            &nbsp;&nbsp;&nbsp;&nbsp;Checked by&nbsp;&nbsp;&nbsp;&nbsp; <br><br><br><br>
            <section style="text-decoration: overline;">&nbsp;&nbsp;&nbsp;&nbsp;Store Keeper&nbsp;&nbsp;&nbsp;&nbsp;</section>
        </div>
        <div style="margin-left: 700px; margin-top: -85px">
            &nbsp;&nbsp;&nbsp;&nbsp;Approved by&nbsp;&nbsp;&nbsp;&nbsp; <br><br><br><br>
            <section style="text-decoration: overline;">&nbsp;&nbsp;&nbsp;&nbsp;Service Manager&nbsp;&nbsp;&nbsp;&nbsp;</section>
        </div>
        <div style="margin-left: 900px; margin-top: -85px">
            &nbsp;&nbsp;&nbsp;&nbsp;Booked by&nbsp;&nbsp;&nbsp;&nbsp; <br><br><br><br>
            <section style="text-decoration: overline;">&nbsp;&nbsp;&nbsp;&nbsp;Adm Service&nbsp;&nbsp;&nbsp;&nbsp;</section>
        </div>
        <?php } ?>
        <?php if($print == FALSE) { ?>
            <div class="form-actions fluid">
                <div class="col-md-12">
                    <center>
                        <form action="<?php echo site_url($this->uri->segment(1)."/print_rts/".$data[0]['return_id']);?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
                            <input type="hidden" name="contract_schedule_id" value="<?php echo $data[0]["contract_schedule_id"];?>">
                            <input type="hidden" name="rts_number" value="<?php echo $number_queue;?>">
                            <input type="submit" name="pdf" value="Print PDF" class="btn blue" />
                            <button type="reset" class="btn black" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'" id="reset"><b>Back</b></button>
                        </form>
                    </center>
                </div>
            </div>
        <?php } ?>
</body>

