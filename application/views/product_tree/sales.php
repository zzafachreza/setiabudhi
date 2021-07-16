<form action="download_sales" method="POST">
	<div class="container">
	<div class="row">
		<div class="col col-sm-6">
			<div class="from-group">
				<label>From</label>
				<input type="text" name="awal" class="AppInput tgl" autocomplete="off">
			</div>
		</div>
		<div class="col col-sm-6">
			<div class="from-group">
				<label>to</label>
				<input type="text" name="akhir" class="AppInput tgl" autocomplete="off">
			</div>
		</div>
			<div class="col col-sm-6">
			<div class="from-group">
				

				<select class="form-control" name="jamAwal">
					<?php
						for ($i=1; $i < 25; $i++) { 
							# code...
					?>
					<option><?php echo strlen($i)>1?$i:'0'.$i ?>:00</option>
					<?php } ?>
				</select>
		
			</div>
		</div>
		<div class="col col-sm-6">
			<div class="from-group">
		
				<select class="form-control" name="jamAkhir">
					<?php
						for ($i=1; $i < 25; $i++) { 
							# code...
					?>
					<option><?php echo strlen($i)>1?$i:'0'.$i ?>:00</option>
					<?php } ?>
				</select>
		
			</div>
		</div>
		<div class="col col-sm-12" style="margin-top: 10%">
			<center>
				<button class="btn btn-danger">Download Excel</button>
			</center>
		</div>
</div>
</div>
</form>

