<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<div class="table-toolbar">
					<button class="btn green" id="generate_btn" onclick="get_form(this)"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp;<b>Generate for Specific Month</b></button>
					<a class="btn blue" onclick="window.location.href='<?php echo base_url("calendar_master/detail");?>'"><i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;&nbsp;<b>How To Use?</b></a>
				</div>
				<form hidden id="form" class="form-horizontal" role="form" method="post" action="<?php echo base_url("calendar_master/generate")?>" enctype="multipart/form-data">
					<div class="form-group">
	                    <label for="inputEmail3" class="col-sm-2 control-label">Month</label>
	                    <div class="col-sm-5">
	                        <input  type="number" class="form-control" min="1" max="12" name="month" value="<?php echo set_value("month")?>" placeholder="Ex: 05" required/><br>
	                        <input  type="text" class="form-control" name="year" value="<?php echo set_value("year")?>" placeholder="Ex: 2017" required/><br>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <div class="col-sm-offset-2 col-sm-5">
	                        <input type="submit" name="submit" value="Generate" class="btn btn-success" />
	                        <a href="<?php echo base_url($this->uri->segment(1));?>" class="btn btn-default">Back</a>
	                    </div>
	                </div>
	            </form>
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Working Day</th>
							<th>Month</th>
							<th>Year</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["working_day"];?></td>
							<td><?php echo $data[$i]["calendar_month"];?></td>
							<td><?php echo $data[$i]["calendar_year"];?></td>
							<td><?php echo $data[$i]["calendar_date"];?></td>
							<td>
							<!--<a href="<?php echo site_url($this->uri->segment(1)."/edit/".$data[$i]["calendar_id"]."");?>" class="btn btn-sm blue"><b>Edit</b></a>-->
							<a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["calendar_id"]."");?>" class="btn btn-sm red"><b>Delete</b></a>
							</td>
						</tr>
					<?php
							$no++;
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	function get_form(obj) {
		// alert(obj.id);
		$("#"+obj.id).hide();
		$("#form").show();
	}
</script>