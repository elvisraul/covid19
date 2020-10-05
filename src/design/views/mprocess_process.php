<div class="modal fade" id="modal_form" data-backdrop="static" >
	<form id="formdata" >
		<div class="modal-dialog modal-lg" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">Nuevo Proceso</h3>
				</div>
				<div class="modal-body">
						<div class="row">
							<div class="col-sm-4 col-md-12" style="display:none" >
								<input id="id" name="id" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-7">
								<select name="ftype" id="ftype" data-placeholder=" " style="width: 700px;" class="chzn_a form-control" >
									<option value="0">---Tipo de Proceso</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
								<select name="rorganization" id="rorganization" data-placeholder=" " style="width: 700px;" class="chzn_a form-control" >
									<option value="0">---Dueño del proceso</option>
								</select>
							</div>	
							<div class="col-sm-4 col-md-3">
								<label for="code" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Código</label>
								<input id="code" name="code" readonly="true" class="form-control input-xs" min="0"  style="height: 23px;padding-left: 4px; color=#FFFFFF" >
							</div>
							<div class="col-sm-8 col-md-9">
								<label for="name" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Nombre</label>
								<input id="name" name="name" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom: 1px;margin-top: 7px;padding-right:0px">
								<div class="panel-group">
									<div class="panel panel-primary">
										<div class="panel-heading">Asignar estados y roles</div>
										<div class="panel-body">
											<div class="hidden col-sm-6 col-md-6 col-lg-12">
												<input id="idsr" class="form-control input-xs" >
											</div>
											<div class="col-sm-6 col-md-6 col-lg-12">
												<select name="rstate" id="rstate" style="width: 500px;" class="chzn_a form-control" >
													<option value="0">---Estado</option>
												</select>
											</div>
											<div class="col-sm-6 col-md-6 col-lg-12">
												<select name="rrole" id="rrole" style="width: 700px;" class="chzn_a form-control" >
													<option value="0">---Rol que ejecuta el estado</option>
												</select>
											</div>
											<div class="form-group" >
												<div class="col-sm-6 col-md-6 col-lg-6 text-center" style="margin-bottom: 7px;">
													<button id="addrolestate" type="button" class="btn btn-primary btn-xs">agregar</button>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6 text-center" style="margin-bottom: 7px;">
													<button id="cancelrolestate" type="button" class="btn btn-danger btn-xs">cancelar</button>
												</div>
											</div>
											<div class="form-group" >
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									                <div class="table-responsive">
								                        <table id="rolestates" name="rolestates" class="table table-bordered dTableR" >
								                            <thead>
								                                <tr>
								                                    <th hidden="true">id</th>
								                                    <th>Order</th>
								                                    <th>Estado</th>
								                                    <th>Rol</th>
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
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom: 1px;margin-top: 7px;padding-right:0px">
								<div class="panel-group" style="margin-right: 15px">
									<div class="panel panel-primary">
										<div class="panel-heading">Productos</div>
										<div class="panel-body">
											<div class="hidden col-sm-6 col-md-6 col-lg-12">
												<input id="idg" class="form-control input-xs" >
											</div>
											<div class="f_success  col-sm-6 col-md-6 col-lg-12">
												<select name="rgood" id="rgood"  style="width: 700px;" class="chzn_a form-control" >
													<option value="0">---Producto</option>
												</select>
											</div>
											<div class="col-sm-6 col-md-6 col-lg-12">
												<select name="runited" id="runited"  style="width: 700px;" class="chzn_a form-control" >
													<option value="0">---Unidad de Medida</option>
												</select>
											</div>
											<div class="form-group" >
												<div class="col-sm-6 col-md-6 col-lg-6 text-center" style="margin-bottom: 7px;">
													<button id="addgood" type="button" class="btn btn-primary btn-xs">agregar</button>
												</div>
												<div class="col-sm-6 col-md-6 col-lg-6 text-center" style="margin-bottom: 7px;">
													<button id="cancelgood" type="button" class="btn btn-danger btn-xs">cancelar</button>
												</div>
											</div>
											<div class="form-group" >
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									                <div class="table-responsive">
								                        <table id="gooduniteds" name="gooduniteds" class="table table-bordered dTableR" >
								                            <thead>
								                                <tr>
								                                    <th hidden="true">id</th>
								                                    <th>Order</th>
								                                    <th>Producto</th>
								                                    <th>Unidad</th>
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
<div class="w-box" id="w_sort01">
	<div class="w-box-header">
		PROCESO
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
                                <th>Área Responsable</th>
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