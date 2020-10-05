<div class="modal fade" id="modal_form" data-backdrop="static" >
	<form id="formdata" >
		<div class="modal-dialog modal-lg" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">Nuevo Usuario</h3>
				</div>
				<div class="modal-body">
						<div class="row">
					        <div class="col-sm-12 col-md-12 dd_column">
					            <div class="w-box" id="w_sort07">
					                <div class="w-box-header">
					                    Información
					                </div>
					                <div class="w-box-content">
					                    <div class="tabbable clearfix">
					                        <ul class="nav nav-tabs">
					                            <li class="active"><a href="#tab1" data-toggle="tab">Laboral</a></li>
					                            <li><a href="#tab2" data-toggle="tab">Rol</a></li>
					                        </ul>
					                        <div class="tab-content">
					                            <div class="tab-pane active" id="tab1">
					                            	<div class="panel panel-default">
														<div class="panel-body">
							                            	<div class="col-sm-4 col-md-12" style="display:none" >
																<input id="id" name="id" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
															</div>
															<div class="col-sm-12 col-md-12" style="margin-bottom: 7px" >
																<input id="lname" name="lname" disabled="true"  class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
															</div>
															<div class="col-sm-3 col-md-3">
																<label for="lxcode" class="text-muted small" style="margin-bottom: 1px">codigo</label>
																<input id="lxcode" name="lxcode" disabled="true"  class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
															</div>
															<div class="col-sm-4 col-md-4">
																<label for="lxalias" class="text-muted small" style="margin-bottom: 1px">alias</label>
																<input id="lxalias" name="lxalias" disabled="true"  class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
															</div>
															<div class="col-sm-5 col-md-5">
																<label for="lxusername" class="text-muted small" style="margin-bottom: 1px">usuario</label>
																<input id="lxusername" name="lxusername" disabled="true"  class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
															</div>
														</div>

									                    
													</div>

						                            <div class="col-sm-12 col-md-12" style="margin-bottom: 5px">
							                            <div class="w-box" id="w_sort01">
											                <div class="w-box-header">
											                    PUESTOS
											                    <div class="pull-right"></div>
											                </div>
											                <div class="w-box-content cnt_a">
											                	<div class="panel-body">
																	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														                <div class="table-responsive">
													                        <table id="tableposition" name="tableposition" class="table table-bordered dTableR" >
													                            <thead>
													                                <tr>
													                                    <th hidden="true">id</th>
													                                    <th>Inicio</th>
													                                    <th>Termino</th>
													                                    <th>Puesto</th>
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
					                            <div class="tab-pane" id="tab2">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														<select id="position" name="position" disabled="true" data-placeholder=" " style="width: 950px;" class="chzn_a form-control" >
														</select>
													</div>
						                            <div class="col-sm-12 col-md-12" style="margin-bottom: 5px">
							                            <div class="w-box" id="w_sort01">
											                <div class="w-box-header">
											                    ROLES ASIGNADOS
											                    <div class="pull-right"></div>
											                </div>
											                <div class="w-box-content cnt_a">
											                	<div class="panel-body">
											                		<div class="col-xs-11 col-sm-1 col-md-1 col-lg-11">
											                			<label for="roles" class="text-muted small" style="margin-bottom: 1px">Seleccione role</label>
																		<select id="roles" name="roles" disabled="true" data-placeholder=" " style="width: 950px;" class="chzn_a form-control" >
																		</select>
																	</div>
																	<div class="col-sm-1 col-md-1 col-lg-1 text-center" style="margin-top: 18px;">
																		<label for="roles" class="text-muted small" style="margin-bottom: 1px"></label>
																		<button id="addrole" type="button" class="btn btn-success btn-xs ">+</button>
																	</div>
																	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														                <div class="table-responsive">
													                        <table id="tableroles" name="tableroles" class="table table-bordered dTableR" >
													                            <thead>
													                                <tr>
													                                    <th hidden="true">id</th>
													                                    <th>Rol</th>
													                                    <th>Modulo</th>
													                                    <th>Recurso</th>
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
			Rol
			<div class="pull-right" ><a id="newdata" class="hidden btn btn-success btn-xs">Nuevo</a> </div>
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
                                    <th>Teléfono</th>
                                    <th>Correo</th>
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