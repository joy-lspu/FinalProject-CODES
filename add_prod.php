<?php
	
	session_start();
	if (!isset($_SESSION['user'])) header('location: login.php');
	$_SESSION['table'] = 'product';
	$user= $_SESSION['user'];
	$product = include('database/show_prod.php');

?>

<!DOCTYPE html>
<html>
<head>
	
	<title>GE DASHBOARD - Store Inventory System</title>

	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script src="https://kit.fontawesome.com/b57cdd5fc9.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/css/bootstrap-dialog.min.css" integrity="sha512-PvZCtvQ6xGBLWHcXnyHD67NTP+a+bNrToMsIdX/NUqhw+npjLDhlMZ/PhSHZN4s9NdmuumcxKHQqbHlGVqc8ow==" crossorigin="anonymous" />
</head>
<body>
	<div id="DBMain">
		<?php include('partial/menubar.php') ?>
			<div class="DB_content" id="DB_content">
		<?php include('partial/menubar-tn.php') ?>
			<div class="DB_Content">
				<div class="DBC_main">
					<div class="row-1">
						<div class="column p1">
							<h1 class="SecTitle"><i class="fa fa-shopping-basket" style="font-size: 26px"></i> Add Product</h1>
								<div id="AddNewProd">
									<form action="database/AddProd.php" method="POST" class="AProd">
										<div >
											<label for="Prod_Name">Product Name</label>
											<input type="text" id="Prod_Name" name="Prod_Name" required>
										</div>
										<div>
											<label for="Qty">Qty</label>
											<input type="text" id="Qty" name="Qty" required />
										</div>
										<div>
											<label for="Price">Price</label>
											<input type="text" id="Price" name="Price" required />
										</div>
										<div>
											<label for="Expdate">Expiration Date</label>
											<input type="date" id="Expdate" name="Expdate" />
										</div>
										<div>
											<label for="Status">Status</label>
											<select class="form-select" name="Status">
												<option selected>Select Status</option>
												<option value="Available">Available</option>
											</select>
										</div>
											<button type="submit" class="submitbtn" id="add" name="add" style="font-family: sans-serif;"><i class="fa fa-plus"></i>ADD PRODUCT</button>
									</form>
									<?php 
										if (isset($_SESSION['res'])) { 
											$res_message = $_SESSION['res']['message'];
											$is_success = $_SESSION['res']['success'];

									?>
										<div class = "resMessage">
											<p class = " resMessage <?= $is_success ? 'resMessage_success' : 'resMessage_error' ?>">
												<?= $res_message ?>
											</p>
										</div>
									<?php unset($_SESSION['res']); } ?>
								</div>
								</div>
								<div class="column p2">
									<h1 class="SecTitle"><i class="fa fa-list-alt" style="font-size: 26px"></i> Product List</h1>
									<div class="s_content">
										<div class="Num_Prod">
										<table>
											<thead>
											<tr>
												<th>No.</th>
												<th>Brand Name</th>
												<th>Quantity</th>
												<th>Price</th>
												<th>Expiration Date</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
												<?php
													foreach ($product as $index => $prod) { ?>
												<tr>
													<td class="num"><?= $index + 1?></td>
													<td class="PPName"><?= $prod['Prod_Name']?></td>
													<td class="QQty"><?= $prod['Qty']?></td>
													<td class="PPrice"><?= $prod['Price']?></td>
													<td class="Edate"><?=  date('M d, Y', strtotime($prod['Expiration_Date']))?></td>
													<td class="SStat"><?= $prod['Status']?></td>
													<td class="icon">
														<a href="" class="Edit" data-prodid="<?= $prod['Prod_ID'] ?>"><i class="fa fa-pencil-square-o"></i>Edit</a>

														<a href="" class="Remove" data-prodid="<?= $prod['Prod_ID'] ?>" data-pname="<?= $prod['Prod_Name'] ?>"><i class="fa fa-trash"></i>Remove</a>	
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>		
										<p class="UCount">No. of Product: <?= count($product) ?></p>				
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			<script src="jscript/sc.js"></script>
	<script src="jscript/jQuery/jquery-3.6.0.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/js/bootstrap-dialog.js" integrity="sha512-AZ+KX5NScHcQKWBfRXlCtb+ckjKYLO1i10faHLPXtGacz34rhXU8KM4t77XXG/Oy9961AeLqB/5o0KTJfy2WiA==" crossorigin="anonymous"></script>

	<script>
		function sc() {
			this.initialize = function() {
				this.registerEvents();
			},

			this.registerEvents = function() {
				document.addEventListener('click', function(e) {
					targetElement = e.target;
					classList = e.target.classList;

					if(classList.contains('Remove')) {
						e.preventDefault();
						prodid = targetElement.dataset.prodid;
						pname = targetElement.dataset.pname;

						if(window.confirm('Are you sure you want to remove '+ pname +'?')) {
							$.ajax ({
								method: 'POST',
								data: {
									ProdID: prodid,
									PName: pname
								},
								url: 'database/remove_prod.php',
								dataType: 'json',
								success: function(data) {
									if(data.success) {
										if(window.confirm(data.message)) {
											location.reload();
										}
									} else window.alert(data.message);
								}

							})
						}
					}
					if(classList.contains('Edit')) {
						e.preventDefault();
									
						PPname = targetElement.closest('tr').querySelector('td.PPName').innerHTML;
						QQty = targetElement.closest('tr').querySelector('td.QQty').innerHTML;
						PPrice = targetElement.closest('tr').querySelector('td.PPrice').innerHTML;
						SStat = targetElement.closest('tr').querySelector('td.SStat').innerHTML;
						prodid = targetElement.dataset.prodid;	

						BootstrapDialog.confirm({
							title: 'Update data of ' + PPname,
							message: '<form>\
										<div class="form-group">\
										<label for = "PPname">Quantity: </label>\
										<input type = "text" class = "form-control" id = "PPname" value = "'+ PPname +'">\
										</div>\
										<div class = "form-group">\
										<label for = "QQty">Quantity: </label>\
										<input type = "text" class = "form-control" id = "QQty" value = "'+ QQty +'">\
										</div>\
										<div class = "form-group">\
										<label for = "PPrice">Price: </label>\
										<input type = "text" class = "form-control" id = "PPrice" value = "'+ PPrice +'">\
										</div>\
										<div class="form-group">\
										<label for = "SStat">Status: </label>\
										<select class="form-select" name="Status" id = "SStat" value = "'+ SStat +'">\
												<option selected>Select Status</option>\
												<option value="Available">Available</option>\
												<option value="Not Available">Not Available</option>\
											</select>\
										</div>\
									</form>',
							callback: function(isUpdate) {

								if(isUpdate)
								{
									$.ajax ({
										method: 'POST',
										data: {
											prodid: prodid,
											ppname: document.getElementById('PPname').value,
											qqty: document.getElementById('QQty').value,
											pprice: document.getElementById('PPrice').value,
											sstat: document.getElementById('SStat').value
										},
									url: 'database/edit_prod.php',
									dataType: 'json',
									success: function(data) {
										if(data.success) {
											BootstrapDialog.alert({
												type: BootstrapDialog.TYPE_SUCCESS,
												message: data.message,
												callback: function(){
													location.reload();
												}
											});
										} else 
											BootstrapDialog.alert({
												type: BootstrapDialog.TYPE_DANGER,
												message: data.message,

											});
								}
							});
						}
					}

				});
			}
		});
	}
}

		var sc = new sc;
		sc.initialize();
	</script>
</body>
</html>