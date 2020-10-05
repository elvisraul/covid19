<div class="modal fade" id="modal_form" data-backdrop="static" >
	<form id="formdata" >
		<div class="modal-dialog modal-lg" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">Nuevo Ingreso</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-4 col-md-12" style="display:none" >
							<input id="id" name="id" class="form-control" type="number" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
							<label for="registration" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Fecha</label>
							<input id="registration" name="registration" class="form-control text-center" readonly="true" style="height: 24px;padding-left: 4px">
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label for="causal" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Causal de salida</label>
							<select id="causal" name="causal"  data-placeholder=" " style="width: 1000px;" class="chzn_a form-control" >
								<option value="0"></option>
							</select>
						</div>
						<div class="f_warning col-xs-6 col-sm-6 col-md-3 col-lg-3">
							<label for="request" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Pedido</label>
							<input id="request" name="request" class="form-control" type="text" style="height: 24px;padding-left: 4px">
						</div>							

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<label for="subject" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Receptor</label>
							<select id="subject" name="subject"  data-placeholder=" " style="width: 1000px;" class="chzn_a form-control" >
								<option value="0"></option>
							</select>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label for="production" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Unidad de producción</label>
							<select id="production" name="production"  data-placeholder=" " style="width: 1000px;" class="chzn_a form-control" >
								<option value="0"></option>
							</select>
						</div>						
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label for="costcenter" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Centro de Costo</label>
							<select id="costcenter" name="costcenter"  data-placeholder=" " style="width: 1000px;" class="chzn_a form-control" >
								<option value="0"></option>
							</select>
						</div>							

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<label for="motive" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Detallar en que tareas / actividad se empleará el material</label>
							<textarea name="motive" id="motive" cols="1" rows="2" class="sepH_a form-control"></textarea>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 1px;margin-top: 7px;padding-right:0px;padding-left:0px;">
								<div class="panel-group">
									<div class="panel panel-primary">
										<div class="panel-heading">DETALLE</div>
										<div class="panel-body">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
												<div class="col-sm-4 col-md-12" style="display:none" >
													<input id="iddetail" name="iddetail" class="form-control" type="number" style="height: 23px;padding-left: 4px">
												</div>
												<div class="col-xs-6 col-sm-7 col-md-8 col-lg-9">
													<label for="good" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Producto</label>
													<select id="good" name="good"  data-placeholder=" " style="width: 1000px;" class="chzn_a form-control" >
														<option value="0"></option>
													</select>
												</div>
												<div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
													<label for="uniteddefault" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Unidad de Medida</label>
													<input id="uniteddefault"  name="uniteddefault" type="text" readonly="true" class="form-control" style="height: 26px;padding-left: 4px"/>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
												<div class="f_success col-xs-5 col-sm-5 col-md-3 col-lg-3">
													<label for="quantity"  class="text-muted small"  style="margin-bottom: 1px;margin-top: 7px;" >Cantidad :</label>
													<input id="quantity" name="quantity" class="form-control" min="0" type="number" style="height: 24px;padding-left: 4px">
												</div>
												<div class="col-sm-2 col-md-2 col-lg-2" style="margin-bottom: 7px;margin-top: 24px;">
													<button id="adddetail" type="button" class="btn btn-primary btn-xs">agregar</button>
												</div>
											</div>
											<div class="form-group" >
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									                <div class="table-responsive">
								                        <table id="gooduniteds" name="gooduniteds" class="table table-bordered dTableR" >
								                            <thead>
								                                <tr>
								                                    <th hidden="true">id</th>
								                                    <th>Producto / Servicio</th>
								                                    <th>Unidad</th>
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

<div >
	<div class="w-box" id="w_sort01">
		<div class="w-box-header">
			SALIDA
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
                                    <th>Tipo Precio</th>
                                    <th>Moneda</th>
                                    <th>Unid. Medida</th>
                                    <th>Valor</th>
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