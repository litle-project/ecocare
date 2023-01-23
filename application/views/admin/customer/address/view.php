<h1><?php echo $title;?></h1>
<br/>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box grey">		
            <div class="portlet-body">
                <div class="table-toolbar">
                    <button class="btn green" onclick="window.location.href='<?php echo site_url($this->uri->segment(1)."/add");?>'"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp;<b>Add New</b></button>
                </div>
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
    				<thead>
    				<tr>
                        <th>No</th>
    					<th>Cust Address ID</th>
    					<th>Customer Name (Brand)</th>
                        <th>Address</th>
    					<th>Action</th>
    				</tr>
    				</thead>
				    <tbody>
    					<?php
    						$no=1;
    						for($i=0; $i <count($data); $i++){
    					?>
    						<tr class="gradeX">
    								<td><?php echo $no;?></td>								
                                    <td><?php echo $data[$i]["address_id"];?></td>
                                    <td><?php echo $data[$i]["customer_name"];?></td>
                                    <td><?php echo substr($data[$i]["address"], 0, 50);?></td>
    								<td>
    								<a href="<?php echo site_url("customer_address/detail/".$data[$i]["address_id"]."");?>" class="btn btn-sm default">Detail</a>
                                    <a href="<?php echo site_url("customer_address/edit/".$data[$i]["address_id"]."");?>" class="btn btn-sm blue">Edit</a>
                                    <a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["address_id"]."");?>" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete <?php echo $data[$i]["customer_name"];?> from product table? It Will Delete Contract That Have Relation With This Costumer!')"><b>Delete</b></a>
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

