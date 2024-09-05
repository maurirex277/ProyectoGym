<?php include('db_connect.php');?>

<div class="container-fluid">
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}
</style>
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
						<b>Membresias Activas</b>
						<span class="">

							<button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_member">
					<i class="fa fa-plus"></i> Nueva</button>
				</span>
					</div>
					<div class="card-body">
						
						<table class="table table-bordered table-condensed table-hover">
							<colgroup>
								<col width="5%">
								<col width="15%">
								<col width="20%">
								<col width="20%">
								<col width="20%">
								<col width="10%">
							</colgroup>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">ID de membresia</th>
									<th class="">Nombre</th>
									<th class="">Plan</th>
									<th class="">Paquete</th>
									<th class="">Estado</th>
									<th class="text-center">Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$member =  $conn->query("SELECT r.*,p.plan,pp.package,concat(m.lastname,', ',m.firstname,' ',m.middlename) as name,m.member_id from registration_info r inner join members m on m.id = r.member_id inner join plans p on p.id = r.plan_id inner join packages pp on pp.id = r.package_id where r.status = 1 order by r.id asc");
								while($row=$member->fetch_assoc()):
								?>
								<tr>
									
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p><b><?php echo $row['member_id'] ?></b></p>
										 
									</td>
									<td class="">
										 <p><b><?php echo ucwords($row['name']) ?></b></p>
										 
									</td>
									<td class="">
										 <p><b><?php echo $row['plan']. ' Meses' ?></b></p>
									</td>
									<td class="">
										 <p><b><?php echo $row['package'] ?></b></p>
										 
									</td>
									<td class="text-center">
										<?php if(strtotime(date('Y-m-d')) <= strtotime($row['end_date'])): ?>
										<span class="badge badge-success">Activo</span>
										<?php else: ?>
										<span class="badge badge-danger">Expiro</span>
										<?php endif; ?>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary view_member" type="button" data-id="<?php echo $row['id'] ?>" >Ver</button>
										
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
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height:150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#new_member').click(function(){
		uni_modal("<i class='fa fa-plus'></i> Nuevo plan de membresía","manage_membership.php",'')
	})
	$('.view_member').click(function(){
		uni_modal("<i class='fa fa-address-card'></i> Detalles de membresia","view_pdetails.php?id="+$(this).attr('data-id'),'')
		
	})
	$('.edit_member').click(function(){
		uni_modal("<i class='fa fa-edit'></i> Administrar detalles de miembro","manage_member.php?id="+$(this).attr('data-id'),'mid-large')
		
	})
	$('.delete_member').click(function(){
		_conf("¿Estás segura de eliminar a esta miembro?","delete_member",[$(this).attr('data-id')],'mid-large')
	})

</script>