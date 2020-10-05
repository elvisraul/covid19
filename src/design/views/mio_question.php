<div class="modal fade" id="modal_form" data-backdrop="static" >
	<form id="formdata" >
		<div class="modal-dialog" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">Nueva Pregunta</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-4 col-md-12" style="display:none" >
							<input id="id" name="id" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-sm-4 col-md-4">
							<label for="code" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Código</label>
							<input id="code" name="code"  class="form-control input-xs" readonly="true"   style="height: 28px;padding-left: 4px; color=#FFFFFF" >
						</div>
						<div class="col-sm-12 col-md-12">
							<label for="precision" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Pregunta</label>
							<textarea id="precision" name="precision" class="form-control " type="text" style="padding-left: 4px"></textarea>
						</div>
						<div class="col-sm-6 col-md-6">
							<label for="optional" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Obligatorio?</label>
							<input id="optional" name="optional" type="checkbox" class="bs-switch" data-size="mini" />
						</div>						
					</div>
				</div>
				<div class="modal-footer">
					<!--<button id="cancelData" type="button" class="btn btn-default btn-sm">Cerrar</button>-->
					<button id="savedata" type="button" class="btn btn-primary btn-sm">Guardar</button> 
				</div>
			</div>
		</div>
	</form>
</div>
<div class="formSep">

	<div class="w-box" id="w_sort01">
		<div class="w-box-header">
			PREGUNTAS
			<div class="pull-right" ><a id="newdata" class="btn btn-success btn-xs">Nuevo</a> </div>
		</div>
		<div class="w-box-content cnt_a">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<table id="alldata"  class="table  table-bordered dTableR" >
						<thead>
							<tr>
								<th hidden="true">id</th>
								<th>Codigo</th>
								<th>Pregunta</th>
								<th>Obligatorio</th>
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