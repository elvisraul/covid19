
<div class="w-box" id="w_sort01">
	<div class="w-box-header">
		REPORTE DE DESPACHO
	</div>
	<div class="w-box-content cnt_a">
		<div class="row">
			<div class="col-sm-12 col-md-12 " style="margin-bottom: 10px;" >
				<div class="col-sm-2 col-md-2 ">
					<label for="ffilter" class="text-muted small" style="margin-bottom: 1px;margin-top: 7px;">Buscar por </label>
					<select name="ffilter" id="ffilter" style="height: 24px;padding-left: 4px;padding: 0px 0px !important " class="chzn_a form-control" >
						<option value="0" >Todos</option>
						<option value="1" >N. Guía</option>
						<option value="2" >Fecha</option>
					</select>
				</div>	
				<div id="viewguide" class="col-sm-2 col-md-2 ">
					
				</div>	
				<div id="viewstart"  class="col-sm-2 col-md-2 ">
					
				</div>	
				<div id="viewend" class="col-sm-2 col-md-2 ">
					
				</div>	
				<div class="col-sm-1 col-md-1 ">
					<button id="searchDispatch" name="searchDispatch" type="button" class="btn btn-info btn-xl glyphicon glyphicon-search" ></button>
				</div>	
				<div class="col-sm-1 col-md-1 ">
					<button id="downloadDispatchXLS" name="downloadDispatchXLS" type="button" class="btn btn-xl glyphicon glyphicon-cloud-download"/></button>
				</div>
			</div>
            <div class="col-sm-12 col-md-12 ">
                <div class="table-responsive">
                    <table id="alldata"  class="table table-bordered dTableR" >
                        <thead>
                            <tr>
                                <th hidden="true">id</th>
                                <th>Producto</th>
                                <th>Cantidad (Cajas)</th>
                                <th>Referente</th>
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