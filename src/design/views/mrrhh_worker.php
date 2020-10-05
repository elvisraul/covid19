<div class="modal fade" id="modal_form_new" data-backdrop="static" >
	<form id="formnewdata" >
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
					                            <li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
					                            <li><a href="#tab2" data-toggle="tab">Laboral</a></li>
					                        </ul>
					                        <div class="tab-content">
					                            <div class="tab-pane active" id="tab1">
					                            	<div class="panel panel-default">
														<div class="panel-body">
															<div class="col-sm-4 col-md-3">
																<label for="ncode" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">DNI</label>
																<input id="ncode" name="ncode"  class="form-control input-xs" style="height: 23px;padding-left: 4px; color=#FFFFFF" >
															</div>
															<div class="col-sm-8 col-md-9">
																<label for="nname" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Nombre</label>
																<input id="nname" name="nname" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
															</div>
															<div class="col-sm-6 col-md-6 col-lg-6">
																<label for="npaternal" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Apellido materno</label>
																<input id="npaternal" name="npaternal" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
															</div>
															<div class="col-sm-6 col-md-6 col-lg-6">
																<label for="nmaternal" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Apellido paterno</label>
																<input id="nmaternal" name="nmaternal" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
															</div>
								                            <div class="col-sm-12 col-md-12">
								                                <label for="naddress" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Dirección</label>
								                                <input id="naddress" name="naddress" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
								                            </div>
								                            <div class="col-sm-4 col-md-4 col-lg-4">
																<label for="nphone" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Teléfono</label>
																<input id="nphone" name="nphone" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
															</div>
								                            <div class="col-sm-8 col-md-8 col-lg-8">
								                                <label for="nmail" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Correo</label>
								                                <input id="nmail" name="nmail" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
								                            </div>
															<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
																<label for="nsex" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Sexo</label>
																<select id="nsex" name="nsex" data-placeholder=" " style="width: 350px;" class="chzn_a form-control" >
																	<option value="MASCULINO">MASCULINO</option>
																	<option value="FEMENINO">FEMENINO</option>
																</select>
															</div>
															<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
																<label for="nbirth" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Fecha de nacimiento</label>
								                                <input id="nbirth" name="nbirth" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
															</div>
														</div>
									                    
													</div>
					                            </div>
					                            <div class="tab-pane" id="tab2">
													<div class="col-sm-4 col-md-3">
														<label for="lcode" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Código</label>
														<input id="lcode" name="lcode"  class="form-control input-xs" style="height: 23px;padding-left: 4px; color=#FFFFFF" >
													</div>
													<div class="col-sm-8 col-md-9">
														<label for="lname" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Completo</label>
														<input id="lname" name="lname" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
													</div>
													<div class="col-sm-7 col-md-7 col-lg-7">
														<label for="laddress" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Dirección</label>
														<input id="laddress" name="laddress" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
													</div>
													<div class="col-sm-5 col-md-5 col-lg-5">
														<label for="lphone" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Teléfono</label>
														<input id="lphone" name="lphone" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
													</div>
													<div class="f_error col-sm-7 col-md-7 col-lg-7">
														<label for="lmail" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Correo</label>
														<input id="lmail" name="lmail" disabled="true" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
														<span class="help-block">Este correo es generado por el personal de Sistemas </span>
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
				                            <li class="active"><a href="#tabgen" data-toggle="tab">General</a></li>
				                            <li><a href="#tablab" data-toggle="tab">Laboral</a></li>
				                            <li><a href="#tabpue" data-toggle="tab">Puestos</a></li>
				                        </ul>
				                        <div class="tab-content">
				                            <div class="tab-pane active" id="tabgen">
				                            	<div class="panel panel-default">
														<div class="panel-body">
							                            	<div class="col-sm-4 col-md-12" style="display:none" >
																<input id="id" name="id" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
															</div>
															<div class="col-sm-4 col-md-3">
																<label for="mcode" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">DNI</label>
																<input id="mcode" name="mcode"  class="form-control input-xs" style="height: 23px;padding-left: 4px; color=#FFFFFF" >
															</div>
															<div class="col-sm-8 col-md-9">
																<label for="mname" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Nombre</label>
																<input id="mname" name="mname" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
															</div>
															<div class="col-sm-6 col-md-6 col-lg-6">
																<label for="mpaternal" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Apellido materno</label>
																<input id="mpaternal" name="mpaternal" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
															</div>
															<div class="col-sm-6 col-md-6 col-lg-6">
																<label for="mmaternal" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Apellido paterno</label>
																<input id="mmaternal" name="mmaternal" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
															</div>
								                            <div class="col-sm-12 col-md-12">
								                                <label for="maddress" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Dirección</label>
								                                <input id="maddress" name="maddress" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
								                            </div>
								                            <div class="col-sm-4 col-md-4 col-lg-4">
																<label for="mphone" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Teléfono</label>
																<input id="mphone" name="mphone" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
															</div>
								                            <div class="col-sm-8 col-md-8 col-lg-8">
								                                <label for="mmail" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Correo</label>
								                                <input id="mmail" name="mmail" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
								                            </div>
															<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
																<label for="msex" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Sexo</label>
																<select id="msex" name="msex" data-placeholder=" " style="width: 350px;" class="chzn_a form-control" >
																	<option value="MASCULINO">MASCULINO</option>
																	<option value="FEMENINO">FEMENINO</option>
																</select>
															</div>
															<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
																<label for="mbirth" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Fecha de nacimiento</label>
								                                <input id="mbirth" name="mbirth" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
															</div>
														</div>
									                    
													</div>
				                            </div>
				                            <div class="tab-pane" id="tablab">
				                            	<div class="panel panel-default">
													<div class="panel-body">
						                            	<div class="col-sm-4 col-md-3">
															<label for="mlcode" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Código</label>
															<input id="mlcode" name="mlcode"  class="form-control input-xs" style="height: 23px;padding-left: 4px; color=#FFFFFF" >
														</div>
														<div class="col-sm-8 col-md-9">
															<label for="mlname" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Completo</label>
															<input id="mlname" name="mlname" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
														</div>
														<div class="col-sm-7 col-md-7 col-lg-7">
															<label for="mladdress" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Dirección</label>
															<input id="mladdress" name="mladdress" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
														</div>
														<div class="col-sm-5 col-md-5 col-lg-5">
															<label for="mlphone" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Teléfono</label>
															<input id="mlphone" name="mlphone" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
														</div>
														<div class="f_error col-sm-7 col-md-7 col-lg-7">
															<label for="mlmail" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Correo</label>
															<input id="mlmail" name="mlmail" disabled="true" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
															<span class="help-block">Este correo es generado por el personal de Sistemas </span>
														</div>
													</div>
								                    
												</div>
									        </div>
									        <div class="tab-pane" id="tabpue">
    						                    <div class="col-sm-12 col-md-12" style="margin-bottom: 5px">
						                            <div class="w-box" id="w_sort01">
										                <div class="w-box-header">
										                    Puesto
										                    <div class="pull-right"></div>
										                </div>
										                <div class="w-box-content cnt_a">
										                	<div class="panel-body">
										                		<div class="col-sm-4 col-md-12" style="display:none" >
																	<input id="cmbid" name="cmbid" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
																</div>
										                		<div class="col-sm-4 col-md-4">
																	<label for="cmcode" class="text-muted small" style="margin-bottom: 1px;margin-top: 5px;">Código/Contrato</label>
																	<input id="cmcode" name="cmcode" class="form-control input-xs" style="height: 23px;padding-left: 4px; color=#FFFFFF" >
																</div>
																<div class="col-sm-4 col-md-4">
																	<label for="cmstart" class="text-muted small" style="margin-bottom: 1px;margin-top: 5px;">Fecha Inicio</label>
																	<input id="cmstart" name="cmstart" class="form-control input-xs" style="height: 23px;padding-left: 4px; color=#FFFFFF" >
																</div>
																<div class="col-sm-4 col-md-4">
																	<label for="cmend" class="text-muted small" style="margin-bottom: 1px;margin-top: 5px;">Fecha Término</label>
																	<input id="cmend" name="cmend" class="form-control input-xs" style="height: 23px;padding-left: 4px; color=#FFFFFF" >
																</div>
										                		<div class="col-xs-11 col-sm-1 col-md-1 col-lg-11">
										                			<label for="position" class="text-muted small" style="margin-bottom: 1px;;margin-top: 5px">Seleccione Puesto</label>
																	<select id="position" name="position" data-placeholder=" " style="width: 950px;" class="chzn_a form-control" >
																	</select>
																</div>
																<div class="col-sm-1 col-md-1 col-lg-1 text-center" style="margin-top: 22px;">
																	<label for="roles" class="text-muted small" style="margin-bottom: 1px"></label>
																	<button id="addposition" type="button" class="btn btn-success btn-xs ">+</button>
																</div>
																<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													                <div class="table-responsive">
												                        <table id="tableposition" name="tableposition" class="table table-bordered dTableR" >
												                            <thead>
												                                <tr>
												                                    <th hidden="true">id</th>
												                                    <th>Código</th>
												                                    <th>Inicio</th>
												                                    <th>Termino</th>
												                                    <th>Puesto</th>
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
			Personal
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