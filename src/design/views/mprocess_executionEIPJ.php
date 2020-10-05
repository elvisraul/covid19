<?php 
	session_start();
	function bfilter($pf){
		
		$key = array_search($pf,array_column($_SESSION['filter'], 'filter'));

		return($key);
	}


	function boptionfilter($po,$pf){
		foreach ($_SESSION['filter'] as $key => $v){
			if($v->option==$po && $v->filter==$pf ){
				return (true);
			}
		}
		return (false);
	}

?>
<div class="modal fade" id="modal_form" data-backdrop="static">
	<form id="formdata" >
		<div class="modal-dialog modal-lg" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">Nueva Ejecución</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-4 col-md-12" style="display:none" >
							<input id="id" name="id" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<label for="rprocess" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Proceso</label>
							<select name="rprocess" id="rprocess" data-placeholder=" " style="width: 900px;" class="chzn_a form-control" >
								<option value="0"></option>
							</select>
						</div>
						<div class="col-sm-4 col-md-12" style="display:none" >
							<input id="executionid" name="executionid" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-sm-5 col-md-5">
							<label for="freference" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Referente (documento de recepción)</label>
							<input id="freference" name="freference" class=" form-control"  type="text" style="height: 24px;padding-left: 4px; color=#FFFFFF">
						</div>
						<div class="col-sm-4 col-md-4">
							<label for="fprecision" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">O. Producción</label>
							<input id="fprecision" name="fprecision"  class="form-control" style="height: 24px;padding-left: 4px; color=#FFFFFF" >
						</div>
						<div class="col-sm-3 col-md-3">
							<label for="freception" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Fecha de recepción</label>
							<input id="freception" name="freception" class="datepicker form-control"  type="text" placeholder="aaaa-mm-dd" style="height: 24px;padding-left: 4px; color=#FFFFFF">
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12">
							<div id="accordionproduct" class="panel-group accordion" style="margin-bottom: 1px;margin-top: 7px;">
								<div class="panel panel-default">
									<div class="panel-heading">
										<a href="#collapseP1" data-parent="#accordionproduct" data-toggle="collapse" class="accordion-toggle collapsed">
											Productos
										</a>
									</div>
									<div class="panel-collapse collapse" id="collapseP1">
										<div class="panel-body">
											<div class="table-responsive">
						                        <table id="tableresponsegood" name="gooduniteds" class="table table-bordered dTableR" >
						                            <thead>
						                                <tr>
						                                    <th hidden="true">id</th>
															<th>Producto</th>
															<th>Cantidad Planeado</th>
															<th>Cantidad Recibido</th>
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
				<div class="modal-footer">
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
					<h3 class="modal-title text-info">Estados de la ejecución</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-4 col-md-12" style="display:none" >
							<input id="fmidexecution" name="fmidexecution" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
							<input id="fmiddetail" name="fmiddetail" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<input id="fmprocess" name="fmprocess" class="form-control input-xs" disabled="true" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
							<input id="fmreference" name="fmreference" class="form-control input-xs" disabled="true" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<input id="fmprecision" name="fmprecision" disabled="true" class="form-control" style="height: 24px;padding-left: 4px; color=#FFFFFF" >
						</div>
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<input id="fmreception" name="fmreception" disabled="true" class="form-control" style="height: 24px;padding-left: 4px; color=#FFFFFF" >
						</div>
						<div class="col-xs-12 col-sm-12">
							<div class="panel-group">
								<div class="panel panel-primary">
									<div class="panel-body">
										<div class="col-sm-4 col-md-12" style="display:none" >
											<input id="fmidexecutiondetail" name="fmidexecution" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
										</div>
										<div class="col-sm-12 col-md-12 col-lg-12">
											<select name="rstates" id="rstates" data-placeholder=" " style="width: 900px;" class="chzn_a form-control" >
											</select>
										</div>
										<div id="divaccepted" class="col-sm-12 col-md-12 col-lg-12">

										</div>
										<div class="col-sm-12 col-md-8 col-lg-8">
											<label for="fnote" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Nota</label>
											<textarea id="fnote"  name="fnote" rows="3" cols="1" class=" form-control"  style="padding-left: 4px"/>
										</div>
										<div class="col-sm-12 col-md-4 col-lg-4">
											<label for="fstart" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Fecha</label>
											<input id="fstart" name="fstart" class="form-control datepicker" type="text" style="height: 24px;padding-left: 4px">
										</div>
										<div class="col-sm-12 col-md-4 col-lg-4" style="margin-bottom: 1px;margin-top: 7px;">
											<button id="addstate" type="button" class="btn btn-primary btn-sm">agregar</button>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 1px;margin-top: 7px;" >
							                <div class="table-responsive">
						                        <table id="executionstates" name="gooduniteds" class="table table-bordered dTableR" >
						                            <thead>
						                                <tr>
						                                    <th hidden="true">id</th>
															<th>Estado</th>
															<th>Inicio</th>
															<th>Nota</th>
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



<div class="modal fade" id="modal_state_read" data-backdrop="static" >
	<form id="formdatastatesread" >
		<div class="modal-dialog modal-lg" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title text-info">Hitorial de Estados</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<input id="xfmprocess" name="fmprocess" class="form-control input-xs" disabled="true" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
							<input id="xfmreference" name="fmreference" class="form-control input-xs" disabled="true" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<input id="xfmprecision" name="fmprecision" disabled="true" class="form-control" style="height: 24px;padding-left: 4px; color=#FFFFFF" >
						</div>
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<input id="xfmreception" name="fmreception" disabled="true" class="form-control" style="height: 24px;padding-left: 4px; color=#FFFFFF" >
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12">
							<div id="accordionproductread" class="panel-group accordion" style="margin-bottom: 1px;margin-top: 7px;">
								<div class="panel panel-default">
									<div class="panel-heading">
										<a href="#collapseP1read" data-parent="#accordionproductread" data-toggle="collapse" class="accordion-toggle collapsed">
											Materiales e Insumos
										</a>
									</div>
									<div class="panel-collapse collapse" id="collapseP1read">
										<div class="panel-body">
											<div class="table-responsive">
						                        <table id="tableresponsegoodread" name="gooduniteds" class="table table-bordered dTableR" >
						                            <thead>
						                                <tr>
						                                    <th hidden="true">id</th>
															<th>Materiales e insumos / Unidad</th>
															<th>C. Planeado</th>
															<th>C. Recibido</th>
															<th>C. Liberado</th>
						                                </tr>
						                            </thead>
						                        </table>
						                    </div>
										</div>
									</div>
								</div>
							</div>
						</div>						
						<div class="col-xs-12 col-sm-12">
							<div class="panel-group">
								<div class="panel panel-primary">
									<div class="panel-body">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 1px;margin-top: 7px;" >
							                <div class="table-responsive">
						                        <table id="executionstatesread" name="gooduniteds" class="table table-bordered dTableR" >
						                            <thead>
						                                <tr>
						                                    <th hidden="true">id</th>
															<th>Estado</th>
															<th>Inicio</th>
															<th>Nota</th>
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
		EVALUACIÓN DE INSUMOS PARA LA PRODUCCIÓN DE JABÓN
		<div class="pull-right" ><?php if(boptionfilter('execution_soapsupplies','received')){ echo "<a id='newdata' class='btn btn-success btn-xs'>Nuevo</a>"; }   ?></div>
	</div>
	<div class="w-box-content cnt_a">
		<div class="row">
            <div class="col-sm-12 col-md-12 ">
                <div class="table-responsive">
                    <table id="alldata"  class="table table-bordered dTableR" >
                        <thead>
                            <tr>
								<th hidden="true">id</th>
								<th>Referente</th>
								<th>O. Producción</th>
								<th>Estado</th>
								<th>Fecha</th>
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

<div class="w-box" id="w_sort00">
	<div class="w-box-header">
		ESTADOS DE LA EVALUACIÓN DE INSUMOS PARA PRODUCCIÓN DE JABÓN
	</div>
	<div class="w-box-content cnt_a">
		<div class="row">
            <div class="col-sm-12 col-md-12 ">
                <div class="table-responsive">
                    <table id="alldataread"  class="table table-bordered dTableR" >
                        <thead>
                            <tr>
								<th hidden="true">id</th>
								<th>Referente</th>
								<th>O.Producción</th>
								<th>Estado</th>
								<th>Fecha</th>
								<th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
		</div>
	</div>
</div>