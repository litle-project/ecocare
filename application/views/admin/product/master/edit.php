<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Product</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-12 col-sm-9">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">
				<br/>

				<form action="<?php echo base_url('product_master/edit/'.$data[0]['product_id'])?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Product Name</label>
						<div class="col-md-8 col-sm-8">
							<input type="text" name="product_name" class="form-control" value="<?php echo $data[0]['product_name'];?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Product Code</label>
						<div class="col-md-8 col-sm-8">
							<input type="text" readonly name="product_code" class="form-control" value="<?php echo $data[0]['product_code']?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Product Image</label>
						<div class="col-md-8 col-sm-8">
							<input type="file" name="product_image" id="photos" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-actions fluid">
					<div class="col-md-12">
						<center>
							<button type="submit" class="btn green"><b>Submit</b></button>
							<button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
						</center>
					</div>
				</div>
				</form>

			</div>
		</div>
	</div>
</div>

<!-- show and hide product aroma -->
<script>
	$(document).ready(function(){
        $('#category').on('change', function() {
          if ( this.value == '2')
          {
            $("#aroma").show();

          }
          else
          {
            $("#aroma").hide();
          }
        });
    });

    $(document).ready(function(){
        $('#product_aroma').on('change', function() {
          if ( this.value == '1')
          {
            $("#aroma_name").show();
            $("#addRow2-1").show();
          }
          else
          {
            $("#aroma_name").hide();
            $("#addRow2-1").hide();
          }
        });
    });
</script>

<!-- end -->