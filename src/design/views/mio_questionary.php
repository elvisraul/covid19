<div class="modal fade" id="modal_form" data-backdrop="static" >
	<form id="formdata" >
		<div class="modal-dialog modal-lg" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">Nuevo Tipo de Almacen</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-4 col-md-12" style="display:none" >
							<input id="id" name="id" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-sm-3 col-md-2">
							<label for="code" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Código</label>
							<input id="code" name="code"  class="form-control input-xs" readonly="true"   style="height: 23px;padding-left: 4px; color=#FFFFFF" >
						</div>
						<div class="col-sm-2 col-md-2">
							<label for="active" class="text-muted small " style="margin-bottom: 1px;margin-top: 7px;">Activo?</label>
							<input id="active" name="active" type="checkbox" class="bs-switch" data-size="mini" />
						</div>
						<div class="col-sm-7 col-md-8">
							<label for="name" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Título</label>
							<input id="name" name="name" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
						</div>
						<div class="col-sm-12 col-md-12" style="margin-bottom: 7px">
							<label for="description" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Nota</label>
							<textarea id="description" name="description" class="form-control " type="text" style="padding-left: 4px"></textarea>
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


<div class="modal fade" id="modal_form_up" data-backdrop="static" >
	<form id="formdataup" >
		<div class="modal-dialog modal-lg" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="titleup" class="modal-title text-info">Modificar Cuestionario</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-4 col-md-12" style="display:none" >
							<input id="idup" name="idup" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
						</div>
						
						<div class="col-sm-3 col-md-2">
							<label for="codeup" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Código</label>
							<input id="codeup" name="codeup"  class="form-control input-xs" readonly="true"   style="height: 23px;padding-left: 4px; color=#FFFFFF" >
						</div>
						<div class="col-sm-2 col-md-2">
							<label for="activeup" class="text-muted small " style="margin-bottom: 1px;margin-top: 7px;">Activo?</label>
							<input id="activeup" name="activeup" type="checkbox" class="bs-switch" data-size="mini" />
						</div>
						<div class="col-sm-7 col-md-8">
							<label for="nameup" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Título</label>
							<input id="nameup" name="nameup" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
						</div>
						<div class="col-sm-12 col-md-12" style="margin-bottom: 7px">
							<label for="descriptionup" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Nota</label>
							<textarea id="descriptionup" name="descriptionup" class="form-control " type="text" style="padding-left: 4px"></textarea>
						</div>
						<div class="col-sm-12 col-md-12">
							<div class="w-box" id="w_sort01">
				                <div class="w-box-header">
				                    PARAMETROS DE IMPRESION
				                    <div class="pull-right"></div>
				                </div>
		                		<div class="w-box-content cnt_a">
				                	<div class="panel-body">
										<div class="col-sm-12 col-md-12 ">
											<label for="parameterup" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Parametro de Impresión</label>
											<select id="parameterup" name="parameterup"  data-placeholder=" " style="width: 400px;" class="chzn_a form-control" >
											</select>
										</div>
										<div class="col-sm-12 col-md-12">
											<label for="vparameterup" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Valor de Parametro de Impresión</label>
											<textarea id="vparameterup" name="vparameterup" class="form-control " type="text" style="padding-left: 4px"></textarea>
										</div>

										<div class="col-sm-12 col-md-12" style="margin-top: 5px">
											<button id="addparameter" type="button" class="btn btn-success btn-sm glyphicon glyphicon-plus">Añadir</button> 
										</div>

									</div>
									<div class="well">
										<table id="datatableparameterup"  class="table  table-bordered dTableR" >
											<thead>
												<tr>
													<th hidden="true">id</th>
													<th style="width: 700px !important">Parametro</th>
													<th style="width: 700px !important">Valor</th>
													<th style="width: 70px !important"></th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>	
						</div>		
					</div>
				</div>
				<div class="modal-footer">
					<!--<button id="cancelData" type="button" class="btn btn-default btn-sm">Cerrar</button>-->
					<button id="updata" type="button" class="btn btn-primary btn-sm">Guardar</button> 
				</div>
			</div>
		</div>
	</form>
</div>




<div class="modal fade" id="modal_form_question" data-backdrop="static" >
	<form id="formdataquestion" >
		<div class="modal-dialog modal-lg" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">Cargar Preguntas</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-4 col-md-12" style="display:none" >
							<input id="idq" name="idq" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-sm-12 col-md-12">
							<input id="titleq" name="titleq" readonly="true" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
						</div>
						<div class="col-sm-12 col-md-12">
							<label for="reason" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Orientación</label>
							<select name="reason" id="reason" multiple=" " data-placeholder=" " style="width: 1000px;" class="chzn_b form-control">
								<option value="0"></option>
							</select>
						</div>
						<div class="col-sm-12 col-md-12">
							<label for="question" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Pregunta</label>
							<select id="question" name="question"  data-placeholder=" " style="width: 900px;" class="chzn_a form-control" >
								<option value="0"></option>
							</select>
						</div>						
						<div class="col-sm-12 col-md-12">
							<table id="datatablequestionary"  class="table  table-bordered dTableR" >
								<thead>
									<tr>
										<th hidden="true">id</th>
										<th style="width: 40px !important">Orden</th>
										<th style="width: 700px !important">Pregunta</th>
										<th style="width: 70px !important"></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<!--<button id="cancelData" type="button" class="btn btn-default btn-sm">Cerrar</button>-->
					<button id="savedataquestion" type="button" class="btn btn-primary btn-sm">Guardar</button> 
				</div>
			</div>
		</div>
	</form>
</div>




<div class="formSep">
	<div class="w-box" id="w_sort01">
		<div class="w-box-header">
			CUESTIONARIOS
			<div class="pull-right" ><a id="newdata" class="btn btn-success btn-xs">Nuevo</a> </div>
		</div>
		<div class="w-box-content cnt_a">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<table id="alldata"  class="table  table-bordered dTableR" >
						<thead>
							<tr>
								<th hidden="true">id</th>
								<th>Codigo</th>
								<th>Nombre</th>
								<th>Orientación</th>
								<th>Preguntas</th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<div class="w-box-footer">
			<div class="text-center">
				
			</div>
		</div>
	</div>

</div>