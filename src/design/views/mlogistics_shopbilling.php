<div class="modal modal-full fade" id="modal_form" data-backdrop="static" >
	<form id="formdata" >
		<div class="modal-dialog modal-lg" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">Nuevo Producto</h3>
				</div>
				<div class="modal-body">
						<div class="row">
							<div class="col-sm-4 col-md-12" style="display:none" >
								<input id="id" name="id" class="form-control" type="number" style="height: 23px;padding-left: 4px">
							</div>
							<div class="formSep">
								<div class="row">
									<div class="col-sm-8 col-md-8 col-lg-8">
										<select name="united" id="united" data-placeholder=" " style="width: 700px;" class="chzn_a form-control" >
											<option value="0">---Proveedor</option>
										</select>
									</div>
									<div class="col-sm-4 col-md-4 col-lg-4">
										<select id="existence" name="existence"  data-placeholder=" " style="width: 700px;" class="chzn_a form-control" >
											<option value="0">---Tipo Documento</option>
										</select>
									</div>
								</div>
							
								<div class="row">
									<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
										<input class="form-control mask_date" type="text" style="height: 24px;padding-left: 4px" placeholder="Fecha emision">
									</div>
									<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
		                                <select id="money" name="money"  data-placeholder=" " style="width: 500px;" class="chzn_a form-control-sm" >
											<option value="0">---Moneda</option>
										</select>
		                            </div>
									
									<div class="col-sm-3 col-md-2">
										<input id="name" name="name" class="form-control " type="text" style="height: 24px;padding-left: 4px" placeholder="valor de TC">
									</div>
									<div class="col-md-2">
									</div>
									<div class="col-sm-3 col-md-2">
										<input id="serie" name="serie" class="form-control " type="text" style="height: 24px;padding-left: 4px" placeholder="N° serie"/>
									</div>
									<div class="col-sm-3 col-md-2">
										<input id="correlative" name="correlative" class="form-control " type="text" style="height: 24px;padding-left: 4px" placeholder="Correlativo"/>
									</div>
								</div>
							</div>
							<div class="formSep">
								<div class="row">
		                        	<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8" >
		                                <select id="line" name="line"  data-placeholder=" " style="width: 700px;" class="chzn_a form-control" >
											<option value="0">---Artículo</option>
										</select>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
										<select id="mark" name="mark"  data-placeholder=" " style="width: 700px;" class="chzn_a form-control" >
											<option value="0">---Unidad de Medida</option>
										</select>
									</div>
		                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		                                <select id="applied" name="applied"  data-placeholder=" " style="width: 700px;" class="chzn_a form-control" >
											<option value="0">---Tipo Afectación</option>
										</select>
		                            </div>									
									<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
											<input id="priceshop" name="priceshop" class="form-control " type="decimal" style="height: 24px;padding-left: 4px" placeholder="Precio">
									</div>
									<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
											<input id="priceshop" name="priceshop" class="form-control " type="decimal" style="height: 24px;padding-left: 4px" placeholder="Cantidad">
									</div>
									<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
										<button id="addunited" type="button" class="btn btn-primary btn-xs">AGREGAR</button>
									</div>																	
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="panel-group">
												<div class="panel panel-primary">
													<div class="panel-body">
														<div class="form-group" >
														<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											                <div class="table-responsive">
										                        <table id="gooduniteds" name="gooduniteds" class="table table-bordered dTableR" >
										                            <thead>
										                                <tr>
										                                    <th hidden="true">id</th>
										                                    <th>Artículo</th>
										                                    <th>U.M.</th>
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
			PRODUCTO
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
                                    <th>Código Sunat</th>
                                    <th>Tipo</th>
                                    <th>Nombre</th>
                                    <th>Unid. Med.</th>
                                    <th>Fiscalizado?</th>
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