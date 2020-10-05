<div class="modal fade" id="modal_form" data-backdrop="static" >
	<form id="formdata" >
		<div class="modal-dialog" style="margin: 35px auto">
			<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="title" class="modal-title text-info">Nuevo Almacen</h3>
				</div>
				<div class="modal-body">
						<div class="row">
							<div class="col-sm-4 col-md-12" style="display:none" >
								<input id="id" name="id" class="form-control input-xs" type="number" style="height: 23px;padding-left: 4px">
							</div>
							<div class="col-sm-4 col-md-3">
								<label for="code" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Código</label>
								<input id="code" name="code"  class="form-control input-xs" type="number" min="0"  style="height: 23px;padding-left: 4px; color=#FFFFFF" >
							</div>
							<div class="col-sm-8 col-md-9">
								<label for="name" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Nombre</label>
								<input id="name" name="name" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px; color=#FFFFFF">
							</div>
							<div class="col-sm-12 col-md-12">
								<label for="description" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Descripción</label>
								<input id="description" name="description" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
							</div>
                            <div class="col-sm-12 col-md-12">
                                <label for="address" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Dirección</label>
                                <input id="address" name="address" class="form-control input-xs " type="text" style="height: 23px;padding-left: 4px">
                            </div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<label for="chosen_a" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Tipo de Almacen</label>
								<select name="warehouse_type" id="chosen_a" data-placeholder=" " style="width: 350px;" class="chzn_a form-control" >
									<option value="0"></option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<label for="chosen_l" class="text-muted small"   style="margin-bottom: 1px;margin-top: 7px;">Local</label>
								<select name="locale" id="chosen_l" data-placeholder=" " style="width: 350px;" class="chzn_a form-control">
									<option value="0"></option>
								</select>
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
			ALMACEN
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
                                    <th>Descripción</th>
                                    <th>Dirección</th>
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