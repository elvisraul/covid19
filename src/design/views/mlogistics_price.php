<div >

	<div class="w-box" id="w_sort01">
		<div class="w-box-header">
			PRECIO
		</div>
		
		<div class="w-box-content cnt_a">
		<form id="formparameter" >
			<div class="col-sm-4 col-md-12" style="display:none" >
				<input id="id" name="id" class="form-control" type="number" style="height: 23px;padding-left: 4px">
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="good" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Producto</label>
				<select id="good" name="good"  data-placeholder=" " style="width: 1000px;" class="chzn_a form-control" >
					<option value="0"></option>
				</select>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<label for="type" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Tipo de precio</label>
				<select id="type"  name="type" data-placeholder=" " style="width: 500px;" class="chzn_a form-control" >
					<option value="0"></option>
				</select>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
	            <label for="money" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Moneda</label>
	            <select id="money" name="money"  data-placeholder=" " style="width: 500px;" class="chzn_a form-control" >
					<option value="0"></option>
				</select>
	        </div>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<label for="united" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Unidad</label>
				<select id="united" name="united"  data-placeholder=" " style="width: 500px;" class="chzn_a form-control" >
					<option value="0"></option>
				</select>
			</div>
			<div class="f_success col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<label for="valor" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Valor</label>
				<input id="valor" type="text" name="valor" class="form-control" style="height: 26px;padding-left: 4px"/>
			</div>
			
			<div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="text-center">
					<button id="savedata" type="button" class="btn btn-primary btn-xs">Guardar</button>
				</div>
			</div>
			<div class=" heading col-xs-12 col-sm-12 col-md-12 col-lg-12"/>
			
		</form>
			<div class="row">
                <div class="col-sm-12 col-md-12 ">
                    <div class="table-responsive">
                        <table id="alldata"  class="table table-bordered dTableR" >
                            <thead>
                                <tr>
                                    <th hidden="true">id</th>
                                    <th>Tipo Precio</th>
                                    <th>Moneda</th>
                                    <th>Unid. Medida</th>
                                    <th>Valor</th>
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
