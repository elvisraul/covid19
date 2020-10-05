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
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<select id="operation" name="operation"  data-placeholder=" " style="width: 1000px;" class="chzn_a form-control" >
							<option value="0">---Tipo de operación</option>
						</select>
					</div>
				
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<select id="voucher" name="voucher"  data-placeholder=" " style="width: 1000px;" class="chzn_a form-control" >
							<option value="0">---Comprobante</option>
						</select>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<select id="subject" name="subject"  data-placeholder=" " style="width: 1000px;" class="chzn_a form-control" >
							<option value="0">---Proveedor</option>
						</select>
					</div>						
					<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
						<label for="serie" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Serie</label>
						<input id="serie"  name="serie" type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" style="height: 26px;padding-left: 4px"/>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<label for="correlative" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Numero</label>
						<input id="correlative"  name="correlative" type="text" class="form-control" style="height: 26px;padding-left: 4px"/>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
						<label for="emitiondate" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Fecha</label>
						<input id="emitiondate"  name="emitiondate" type="text" class="form-control datepicker" placeholder="aaaa-mm-dd"  style="height: 26px;padding-left: 4px"/>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			            <label for="money" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Moneda</label>
			            <select id="money" name="money"  data-placeholder=" " style="width: 500px;" class="chzn_a form-control" >
							<option value="0"></option>
						</select>
			        </div>
					<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
						<label for="changetype" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">T. Cambio</label>
						<input id="changetype"  name="changetype" type="text" readonly="true" class="form-control" style="height: 26px;padding-left: 4px"/>
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
												<select id="good" name="goods"  data-placeholder=" " style="width: 1000px;" class="chzn_a form-control" >
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
											<div class="f_success col-xs-12 col-sm-6 col-md-3 col-lg-3">
												<label for="price" class="text-muted small"  style="margin-bottom: 1px;margin-top: 7px;">P. Unitario</label>
												<input id="price" name="price" type="number" min="0" class="form-control" style="height: 24px;padding-left: 4px"/>
											</div>
											<div class="f_success col-xs-12 col-sm-6 col-md-3 col-lg-3">
												<label for="valuetotal" class="text-muted small"  style="margin-bottom: 1px;margin-top: 7px;">Monto Total</label>
												<input id="valuetotal" name="valuetotal" type="number" min="0" class="form-control" style="height: 24px;padding-left: 4px"/>
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
							                                    <th>Precio</th>
							                                    <th>Total</th>
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
					<div class=" heading col-xs-12 col-sm-12 col-md-12 col-lg-12"/>
						<div class="f_success col-xs-6 col-sm-5 col-md-4 col-lg-4">
							<label for="subtotal" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Sub Total</label>
							<input id="subtotal"  name="subtotal" type="number" class="form-control" style="height: 26px;padding-left: 4px"/>
						</div>
						<div class="f_success col-xs-6 col-sm-5 col-md-4 col-lg-4">
							<label for="igv" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">IGV</label>
							<input id="igv"  name="igv" type="number" class="form-control" style="height: 26px;padding-left: 4px"/>
						</div>
						<div class="f_success col-xs-6 col-sm-5 col-md-4 col-lg-4">
							<label for="total" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Total</label>
							<input id="total"  name="total" type="number"  class="form-control" style="height: 26px;padding-left: 4px"/>
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


<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	<label for="warehouse" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Almacen</label>
	<select id="warehouse"  name="warehouse" data-placeholder=" " style="width: 500px;" class="chzn_a form-control" >
		<option value="0"></option>
	</select>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="w-box" id="w_sort01">
		<div class="w-box-header">
			INGRESO
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
                                    <th>Registro</th>
                                    <th>Referencia</th>
                                    <th>Importe</th>
                                    <th>Igv</th>
                                    <th>Total</th>
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
