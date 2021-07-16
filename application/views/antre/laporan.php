<div class="container">
	<hr/>
	<form method="POST" action="./download_laporan">
		<div class="row">
		
			<div class="col col-sm-12" style="margin-bottom: 10%">

				<div class="from-group">
					<label>Please Select Type</label>
					<select required="required" class="form-control selectza" name="GROUP_PO">
						<option></option>
							<option>ALL</option>
						<option>FRESH - 01</option>
						<option>FRESH - 02</option>
						<option>DRY - 01</option>
						<option>DRY - 02</option>
						
					</select>
				</div>
			</div>

		<div class="col col-sm-6">
			<div class="from-group">
				<label>From</label>
				<input required="required" type="text" name="awal" class="AppInput tgl" autocomplete="off">
			</div>
		</div>
		<div class="col col-sm-6">
			<div class="from-group">
				<label>to</label>
				<input required="required" type="text" name="akhir" class="AppInput tgl" autocomplete="off">
			</div>
		</div>
		<div class="col col-sm-12" style="margin-top: 10%">
			<center>
				<button class="btn btn-success btn-lg col-sm-12">Download Excel</button>
			</center>
		</div>
	</div>
	</form>
</div>