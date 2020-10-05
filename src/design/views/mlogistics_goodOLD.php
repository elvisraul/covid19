<div class="modal fade" id="modal_form" data-backdrop="static" >
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
							<div class="col-sm-3 col-md-3">
								<label for="code" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Código</label>
								<input id="code" name="code"  class="form-control" type="number" min="0"  style="height: 24px;padding-left: 4px; color=#FFFFFF" >
							</div>
							<div class="col-sm-3 col-md-3">
								<label for="codecommodity" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Código Sunat</label>
								<input id="codecommodity" name="codecommodity"  class="form-control" type="number" min="0"  style="height: 24px;padding-left: 4px; color=#FFFFFF" >
							</div>
							<div class="col-sm-6 col-md-6">
								<label for="existence" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Tipo de Existencia</label>
								<select id="existence" name="existence"  data-placeholder=" " style="width: 500px;" class="chzn_a form-control" >
									<option value="0"></option>
								</select>
							</div>
							<div class="col-sm-6 col-md-6">
								<label for="name" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Nombre</label>
								<input id="name" name="name" class="form-control " type="text" style="height: 24px;padding-left: 4px">
							</div>
							<div class="col-sm-6 col-md-6">
								<label for="description" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Descripción</label>
								<input id="description" name="description" class="form-control " type="text" style="height: 24px;padding-left: 4px">
							</div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                <label for="priceshop" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Precio de Compra</label>
                                <input id="priceshop" name="priceshop" class="form-control " type="decimal" style="height: 24px;padding-left: 4px">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                <label for="pricesale" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Precio de Venta</label>
                                <input id="pricesale" name="pricesale" class="form-control " type="decimal" style="height: 24px;padding-left: 4px">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                <label for="priceofert" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Precio de Oferta</label>
                                <input id="priceofert" name="priceofert" class="form-control " type="decimal" style="height: 24px;padding-left: 4px">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <label for="minimalstock" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Stock minimo</label>
                                <input id="minimalstock" name="minimalstock" class="form-control "  type="number" style="height: 24px;padding-left: 4px">
                            </div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding-left: 0px;">		
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 0px;padding-right: 0px;">
				                                <label for="applied" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Tipo de Afectación</label>
				                                <select id="applied" name="applied"  data-placeholder=" " style="width: 500px;" class="chzn_a form-control" >
													<option value="0"></option>
												</select>
				                            </div>
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 0px;padding-right: 0px;" >
												<label for="restricted" class="text-muted small"   style="margin-bottom: 1px;margin-top: 7px;">Fiscalizado por Sunat</label>
												<input id="restricted" name="restricted" type="checkbox" class="bs-switch" data-size="mini" />
											</div>
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 0px;padding-right: 0px;">
												<label for="united" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Unidad</label>
												<select name="united" id="united" data-placeholder=" " style="width: 500px;" class="chzn_a form-control" >
													<option value="0"></option>
												</select>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 0px;padding-right: 0px;">
				                                <label for="line" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Linea</label>
				                                <select id="line" name="line"  data-placeholder=" " style="width: 500px;" class="chzn_a form-control" >
													<option value="0"></option>
												</select>
											</div>
				                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 0px;padding-right: 0px;">
				                                <label for="mark" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Marca</label>
				                                <select id="mark" name="mark"  data-placeholder=" " style="width: 500px;" class="chzn_a form-control" >
													<option value="0"></option>
												</select>
				                            </div> 
				                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 0px;padding-right: 0px;">
				                                <label for="model" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Modelo</label>
				                                <select id="model" name="model"  data-placeholder=" " style="width: 500px;" class="chzn_a form-control" >
													<option value="0"></option>
												</select>
				                            </div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<label for="restricted" class="text-muted small"   style="margin-bottom: 1px;margin-top: 7px;">Seleccione unidad para ventas</label>
											<select id="uniteds" name="uniteds" multiple="multiple"></select>
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