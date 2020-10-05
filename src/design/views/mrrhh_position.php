<div class="modal fade" id="modal_form" data-backdrop="static" >
	<form id="formdata" >
		<div class="modal-dialog modal-lg" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">Nuevo Puesto</h3>
				</div>
				<div class="modal-body">
                	<div class="panel panel-default">
						<div class="panel-body">
                        	<div class="col-sm-4 col-md-12" style="display:none" >
								<input id="id" name="id" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
							</div>
							<div class="col-sm-12 col-md-12" style="margin-bottom: 7px" >
								<label for="organization" class="text-muted small" style="margin-bottom: 1px">Unidad orgánica</label>
								<select id="organization" name="organization" data-placeholder=" " style="width: 950px;" class="chzn_a form-control" >
									<option value="0" >---Unidad orgánica</option>
								</select>
							</div>
							<div class="col-sm-3 col-md-3">
								<label for="code" class="text-muted small" style="margin-bottom: 1px">Codigo</label>
								<input id="code" name="code"  readonly="true" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
							</div>
							<div class="col-sm-9 col-md-9">
								<label for="name" class="text-muted small" style="margin-bottom: 1px">Puesto</label>
								<input id="name" name="name" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
							</div>
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
			Puesto
			<div class="pull-right" ><a id="newdata" class="btn btn-success btn-xs">Nuevo</a> </div>
		</div>
		<div class="w-box-content cnt_a">
			<div class="row">
                <div class="col-sm-12 col-md-12 ">
                    <div class="table-responsive">
                        <table id="alldata"  class="table table-bordered dTableR" >
                            <thead>
                                <tr>
                                    <th hidden="true">id</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Unidad orgánica</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
			</div>
		</div>
		<div class="w-box-footer">
			<div class="text-center">
				
			</div>
		</div>
	</div>
</div>