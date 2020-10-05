<div class="modal fade " id="modal_form" data-backdrop="static" >
	<form id="formdata" >
		<div class="modal-dialog modal-lg" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">CUESTIONARIOS</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6 col-md-6" style="display:none" >
							<input id="idreason" name="idreason" readonly="true" class="form-control" type="number" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-sm-6 col-md-6" style="display:none" >
							<input id="idquiz" name="idquiz" readonly="true" class="form-control" type="number" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-sm-6 col-md-6" style="display:none" >
							<input id="idtemperature" name="idtemperature" readonly="true" class="form-control" type="number" style="height: 23px;padding-left: 4px">
						</div>
						<div class="col-sm-6 col-md-6" style="display:none" >
							<input id="answered" name="answered" readonly="true" class="form-control" type="text" style="height: 23px;padding-left: 4px">
						</div>
	        			<div class="col-sm-12 col-md-12">
							<div id="accordion2" class="panel-group accordion">
								
							</div>
				        </div>
					</div>
				</div>
				<div class="modal-footer">
					<button id="modalexit" type="button" class="btn btn-default">cerrar</button>
				</div>
			</div>
		</div>
	</form>
</div>


<div class="modal fade " id="modal_formheart" data-backdrop="static" >
	<form id="formdata-heart" >
		<div class="modal-dialog" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="titleheart" class="modal-title text-info">TEMPERATURA CORPORAL</h3>
				</div>
				<div class="modal-body">
					<div class="panel panel-default">
						<div class="panel-body">
							<table class="table table-striped" id="datahistorialtemperature">
								 <thead>
	                                <tr>
	                                    <th>Nro.</th>
	                                    <th>Movimiento</th>
	                                    <th>Hora </th>
	                                    <th>T. Corporal</th>
	                                </tr>
	                            </thead>
							</table>
						</div>
			        </div>
				</div>
				<div class="modal-footer">
					<!--<button id="cancelData" type="button" class="btn btn-default btn-sm">Cerrar</button>-->
					<button id="close" type="button" class="btn btn-default btn-sm">Cerrar</button>
				</div>
			</div>
		</div>
	</form>
</div>


<div class="col-sm-12 col-md-12 ">
	<div class="formSep">

		<div class="w-box" id="w_sort01">
			<div class="w-box-header">
				Asistentes
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
	                                    <th>Momento</th>
	                                    <th>Acción</th>
	                                    <th>Código</th>
	                                    <th>Nombre</th>
	                                    <th>Teléfono</th>
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
</div>