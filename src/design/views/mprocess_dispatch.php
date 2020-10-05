<div class="modal fade" id="modal_form" data-backdrop="static" >
	<form id="formdata" >
		<div class="modal-dialog modal-lg" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">Despacho</h3>
				</div>
				<div class="modal-body">
						<div class="row">
							<div class="col-sm-4 col-md-12" style="display:none" >
								<input id="id" name="id" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
							</div>
							<div class="col-sm-8 col-md-8">
								<label for="rgood" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Producto</label>
								<select name="rgood" id="rgood" data-placeholder=" " style="width: 700px;" class="chzn_a form-control" >
									<option value="0">---Producto</option>
								</select>
							</div>
							<div class="col-sm-4 col-md-4">
								<label for="runited" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Unidad de Medida</label>
								<select name="runited" id="runited" data-placeholder=" " style="width: 700px;" class="chzn_a form-control" >
									<option value="0">---Unidad de Medida</option>
								</select>
							</div>	
							<div class="col-xs-6 col-sm-8 col-md-8 col-lg-8">
								<select name="ftype" id="ftype" data-placeholder=" " style="width: 700px;" class="chzn_a form-control" >
									<option value="0">---Almacen</option>
								</select>
							</div>
							<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
								<select name="rorganization" id="rorganization" data-placeholder=" " style="width: 700px;" class="chzn_a form-control" >
									<option value="0">---Causal</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<label for="freferente" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Referente de Causal</label>
								<input id="freferente" name="freferente" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
							</div>
							<div class="col-xs-7 col-sm-8 col-md-8 col-lg-8">
								<label for="fexistence" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Existencia</label>
								<select name="fexistence" id="fexistence" data-placeholder=" " style="width: 700px;" class="chzn_a form-control" >
									<option value="0">---Existencia</option>
								</select>
							</div>
							<div class="col-xs-5 col-sm-4 col-md-4 col-lg-4">
								<label id="labelquantity" for="fquantity" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Cantidad</label>
								<input id="fquantity" name="fquantity" class="form-control input-xs " type="number" style="height: 23px;padding-left: 4px; color=#FFFFFF">
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


<div class="modal fade" id="modal_state" data-backdrop="static" >
	<form id="formdatastates" >
		<div class="modal-dialog modal-lg" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">Estados de la ejecución</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-4 col-md-12" style="display:none" >
							<input id="fmidexecution" name="fmidexecution" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
							<input id="fmiddetail" name="fmiddetail" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<label for="fmprocess" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Parte Diario</label>
							<input id="fmprocess" name="fmprocess" class="form-control input-xs" disabled="true" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
							<label for="fmreference" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Cantidad Liberada</label>
							<input id="fmreference" name="fmreference" class="form-control input-xs" disabled="true" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
							<label for="fmreception" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Cantidad Disponible</label>
							<input id="fmreception" name="fmreception" disabled="true" class="form-control" style="height: 24px;padding-left: 4px; color=#FFFFFF" >
						</div>
						<div class="col-xs-12 col-sm-12">
							<div class="panel-group">
								<div class="panel panel-primary">
									<div class="panel-body">
										<div class="col-sm-12 col-md-12 col-lg-12">
											<label for="freceptor" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Responsable de retiro</label>
											<select name="freceptor" id="freceptor" style="width: 850px;"  class="chzn_a form-control" >
											</select>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-6">
											<label for="freferent" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Documento (Referente)</label>
											<input id="freferent" name="freferent" class="form-control datepicker" type="text" style="height: 24px;padding-left: 4px">
										</div>
										<div class="col-sm-3 col-md-3 col-lg-3">
											<label for="fquantity" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Cantidad</label>
											<input id="fquantity" name="fquantity" class="form-control datepicker" type="text" style="height: 24px;padding-left: 4px">
										</div>
										<div class="col-sm-3 col-md-3 col-lg-3 text-center" style="margin-bottom: 1px;margin-top: 7px;">
											<label for="adddispatch" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;"></label>
											<button id="adddispatch" type="button" class="btn btn-primary btn-sm">agregar</button>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 1px;margin-top: 7px;" >
							                <div class="table-responsive">
						                        <table id="dispatchout" name="dispatchout" class="table table-bordered dTableR" >
						                            <thead>
						                                <tr>
						                                    <th hidden="true">id</th>
															<th>Antendido</th>
															<th>Referente</th>
															<th>Cantidad</th>
															<th></th>
						                                </tr>
						                            </thead>
						                        </table>
						                    </div>
								        </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>


<div class="w-box" id="w_sort01">
	<div class="w-box-header">
		DESPACHO
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
                                <th>Producto</th>
                                <th>Cantidad (Cajas)</th>
                                <th>Referente</th>
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