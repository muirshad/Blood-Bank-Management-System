<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>List of Requests</b>
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="new_request">
					<i class="fa fa-plus"></i> New Entry
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Date</th>
									<th class="">Referrence Code</th>
									<th class="">Patient Name</th>
									<th class="">Blood Group</th>
									<th class="">Information</th>
									<th class="">Status</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$requests = $conn->query("SELECT * FROM requests order by date(date_created) desc ");
								while($row=$requests->fetch_assoc()):
									
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td>
										<?php echo date('M d, Y',strtotime($row['date_created'])) ?>
									</td>
									<td class="">
										 <p> <b><?php echo $row['ref_code'] ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo ucwords($row['patient']) ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo $row['blood_group'] ?></b></p>
									</td>
									<td class="">
										 <p>Volume Needed: <b><?php echo  ($row['volume'] / 1000).' L' ?></b></p>
										 <p>Physician Name: <b><?php echo ucwords($row['physician_name']) ?></b></p>
									</td>
									<td class=" text-center">
										<?php if($row['status'] == 0): ?>
											<span class="badge badge-primary">Pending</span>
										<?php else: ?>
											<span class="badge badge-success">Approved</span>
										<?php endif; ?>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary edit_request" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
										<button class="btn btn-sm btn-outline-danger delete_request" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
		    @media screen and (min-width: 100px) and (max-width:1500px) {
  /* For mobile phones: */
  .container-fluid.col-md-12 {
  width: 100%;
  height: auto;
  display: block;
  display: flex;
  justify-content: space-between;
  display: grid;
  /*grid-template-columns: 1fr 3fr;*/
  }
}  
@media screen and (min-width: 100px) and (max-width:1500px) {
.container-fluid.card {
  width: 100%;
  height: auto;
  display: block;
  display: flex;
  justify-content: space-between;
  display: grid;
  /*grid-template-columns: 1fr 3fr;*/
  }
}
@media screen and (min-width: 100px) and (max-width:1500px) {
	table, thead, tbody, th, td, tr {
			display: block;
		}

		/* Hide table headers (but not display: none;, for accessibility) */
		thead tr {
			position: absolute;
			top: -9999px;
			left: -9999px;
		}

    tr {
      margin: 0 0 1rem 0;
    }
      
    tr:nth-child(odd) {
      background: #ccc;
    }
    
		td {
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee;
			position: relative;
			padding-left: 50%;
		}

		td:before {
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 0;
			left: 6px;
			width: 45%;
			padding-right: 10px;
			white-space: nowrap;
		}
}

</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	
	$('#new_request').click(function(){
		uni_modal("New request","manage_request.php","mid-large")
		
	})
	$('.edit_request').click(function(){
		uni_modal("Manage request Details","manage_request.php?id="+$(this).attr('data-id'),"mid-large")
		
	})
	$('.delete_request').click(function(){
		_conf("Are you sure to delete this request?","delete_request",[$(this).attr('data-id')])
	})
	
	function delete_request($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_request',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>