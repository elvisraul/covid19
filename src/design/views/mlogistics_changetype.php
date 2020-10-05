<div class="modal fade" id="modal_form" data-backdrop="static" >
	<form id="formmodal" >
		<div class="modal-dialog" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">Nuevo Tipo de Cambio</h3>
				</div>
				<div class="modal-body">
					
				</div>
				<div class="modal-footer">
					<!--<button id="cancelData" type="button" class="btn btn-default btn-sm">Cerrar</button>-->
					<!--<button id="savedata" type="button" class="btn btn-primary btn-sm">Guardar</button> -->
				</div>
			</div>
		</div>
	</form>
</div>
<div class="formSep">
	<div class="w-box" id="w_sort01">
		<div class="w-box-header">
			TIPO DE CAMBIO
		</div>
		<div class="w-box-content cnt_a">
			<form id="formdata" >
			<div class="col-md-8 col-md-offset-2 formSep">
				<div class="col-sm-4 col-md-12" style="display:none" >
					<input id="id" name="id" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
				</div>
				<div class="col-sm-6 col-md-3">
					<label for="fmoney" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Moneda</label>
		            <select id="fmoney" name="fmoney"  data-placeholder=" " style="width: 800px;" class="chzn_a form-control" >
						<option value="0"></option>
					</select>
				</div>
				<div class="col-sm-6 col-md-3">
					<label for="ftarget" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Fecha</label>
					<input id="ftarget" name="ftarget"  class="form-control input-xs datepicker" min="0"  style="height: 26px;padding-left: 4px; color=#FFFFFF" >
				</div>
				<div class="col-sm-6 col-md-3">
					<label for="fshop" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Compra</label>
					<input id="fshop" name="fshop" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
				</div>
				<div class="col-sm-6 col-md-3">
					<label for="fsale" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Venta</label>
					<input id="fsale" name="fsale" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
				</div>
				<div class="col-sm-4 col-md-3" style="margin-top: 5px">	
					<button id="savedata" type="button" class="btn btn-primary btn-xs">Guardar</button>
				</div>
			</div>
		</form>

			<div class="row">
				<div class="col-sm-12 col-md-12">
					<table id="alldata"  class="table  table-bordered dTableR" >
						<thead>
							<tr>
								<th hidden="true">id</th>
								<th>Moneda</th>
								<th>Fecha</th>
								<th>Compra</th>
								<th>Venta</th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<div class="w-box-footer">
			<div class="text-center">
				
			</div>
		</div>
	</div>

</div>