<div class="modal fade" id="modal_form" data-backdrop="static" >
	<form id="formdata" >
		<div class="modal-dialog modal-lg" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">Nuevo Requerimiento</h3>
				</div>
				<div class="modal-body">
						<div class="row">
							<div class="col-sm-4 col-md-12" style="display:none" >
								<input id="id" name="id" class="form-control" type="number" style="height: 23px;padding-left: 4px">
							</div>
							<div class="col-sm-3 col-md-3">
								<label for="registration" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Fecha</label>
								<input id="registration" name="registration"  class="form-control" readonly="true" style="height: 24px;padding-left: 4px; color=#FFFFFF" >
							</div>
							<div class="col-sm-3 col-md-3">
								<label for="code" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Numero</label>
								<input id="code" name="code"  class="form-control" readonly="true"  style="height: 24px;padding-left: 4px; color=#FFFFFF" >
							</div>
							<div class="col-sm-6 col-md-6">
								<label for="requestor" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Solicitante</label>
								<input id="requestor" name="requestor"  class="form-control" readonly="true" style="height: 24px;padding-left: 4px; color=#FFFFFF" >
							</div>
							<div class="col-sm-3 col-md-3">
								<label for="type" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Tipo</label>
								<select id="type" name="type"  data-placeholder=" " style="width: 500px;" class="chzn_a form-control" >
									<option value="0"></option>
								</select>
							</div>
							<div class="col-sm-6 col-md-6">
								<label for="unitedcore" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Unidad de Producción</label>
								<select id="unitedcore" name="unitedcore"  data-placeholder=" " style="width: 500px;" class="chzn_a form-control" >
									<option value="0"></option>
								</select>
							</div>
							<div class="col-sm-3 col-md-3">
								<label for="use" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Uso</label>
								<input id="use" name="use" class="form-control " type="text" style="height: 24px;padding-left: 4px">
							</div>
							<div class="col-sm-6 col-md-6">
								<label for="description" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Observación 1</label>
								<textarea id="description" name="description" class="form-control " type="text" style="padding-left: 4px"></textarea> 
							</div>
							<div class="col-sm-6 col-md-6">
								<label for="note" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Observación 2</label>
								<textarea  id="note" name="note" class="form-control " type="text" style="padding-left: 4px"></textarea> 
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 1px;margin-top: 7px;padding-right:0px;padding-left:0px;">
									<div class="panel-group">
										<div class="panel panel-primary">
											<div class="panel-heading">DETALLE</div>
											<div class="panel-body">
												<div class="col-sm-4 col-md-12" style="display:none" >
													<input id="iddetail" name="iddetail" class="form-control" type="number" style="height: 23px;padding-left: 4px">
												</div>
												<div class="col-sm-8 col-md-8 col-lg-8">
													<label for="good" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Producto / Servicio</label>
													<select name="good" id="good" data-placeholder=" " style="padding-left: 4px;width: 500px" class="chzn_a form-control" >
														<option value="0"></option>
													</select>
												</div>
												<div class="col-sm-4 col-md-4 col-lg-4">
													<label for="uniteds" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Unidad</label>
													<select name="uniteds" id="uniteds" data-placeholder=" " style="padding-left: 4px;width: 500px" class="chzn_a form-control" >
														<option value="0"></option>
													</select>
												</div>
												<div class="col-sm-5 col-md-5 col-lg-5">
													<label for="quantity" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Cantidad :</label>
													<input id="quantity" name="quantity" class="form-control " type="number" style="height: 24px;padding-left: 4px">
												</div>
												<div class="col-sm-2 col-md-2 col-lg-2" style="margin-bottom: 7px;margin-top: 24px;">
													<button id="addunited" type="button" class="btn btn-primary btn-xs">agregar</button>
												</div>
												<div class="form-group" >
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										                <div class="table-responsive">
									                        <table id="gooduniteds" name="gooduniteds" class="table table-bordered dTableR" >
									                            <thead>
									                                <tr>
									                                    <th hidden="true">id</th>
									                                    <th>Producto / Servicio</th>
									                                    <th>Unidad de Medida</th>
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
			REQUERIMIENTOS
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
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Solicitante</th>
                                    <th>Descripción</th>
                                    <th>Nota</th>
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