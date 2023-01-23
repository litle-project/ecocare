<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="col-lg-7 col-md-7 col-sm-7">
            <h1><?php echo $title;?></h1>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5">
            <ul class="breadcrumb pull-right">
                <li>
                    <a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Customer</a>
                </li>
                <li>
                    <span><?php echo $title;?></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <br/>
        <div class="portlet box grey">
            <div class="portlet-body form">
            <br/>
            
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-4 col-sm-3 control-label"><b>Customer Name (Brand) : </b></label>
                    <label class="control-label"><?php echo $data[0]['customer_name'];?></label>
                </div>
                <div class="form-group">
                    <label class="col-md-4 col-sm-3 control-label"><b>Customer NPWP : </b></label>
                    <label class="control-label"><?php echo $data[0]['customer_npwp'];?></label>
                </div>
                <div class="form-group">
                    <label class="col-md-4 col-sm-3 control-label"><b>Cutomer Phone : </b></label>
                    <label class="control-label"><?php echo $data[0]['customer_phone'];?></label>
                </div>
                <div class="form-group">
                    <label class="col-md-4 col-sm-3 control-label"><b>Cutomer Email : </b></label>
                    <label class="control-label"><?php echo $data[0]['customer_email'];?></label>
                </div>
                <div class="form-group">
                    <label class="col-md-4 col-sm-3 control-label"><b>Cutomer PIC : </b></label>
                    <label class="control-label"><?php echo $data[0]['customer_pic'];?></label>
                </div>
                <div class="form-group">
                    <label class="col-md-4 col-sm-3 control-label"><b>Customer Address : </b></label>
                    <?php if (!empty($address)) {
                        $no = 1;
                        foreach ($address as $key) {
                    ?>
                        <label class="control-label">Address <?php echo $no; ?></label>
                        <label class="control-label"><?php echo $key['address'];?></label>
                    <?php }}else{ ?>
                        <label class="control-label">Please Create Address For This Customer!</label>
                    <?php } ?>
                </div>
            <div class="form-actions fluid">
                <div class="col-md-12">
                    <center>
                        <button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"><b>Back</b></button>
                    </center>
                </div>
            </div>
            </form>

            </div>
        </div>
    </div>
</div>