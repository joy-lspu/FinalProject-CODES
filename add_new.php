<?php
	
	session_start();
	if (!isset($_SESSION['user'])) header('location: login.php');
	$_SESSION['table'] = 'users';
	$user = $_SESSION['user'];
	$users = include('database/show_user.php');
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
					<div class="row">
						<div class="column c1">
							<h1 class="SecTitle"><i class="fa fa-user" style="font-size: 26px"></i> Create New Account</h1>
								<div id="AddNewUser">
									<form action="database/AddNew.php" method="POST" class="App">
										<div >
											<label for="First_Name">First Name</label>
											<input type="text" id="First_Name" name="First_Name" required />
										</div>
										<div >
											<label for="Last_Name">Last Name</label>
											<input type="text" id="Last_Name" name="Last_Name" required />
										</div>
										<div >
											<label for="Email">Email Add</label>
											<input type="text" id="Email" name="Email" required />
										</div>
										<div >
											<label for="Password">Password</label>
											<input type="password" id="Password" name="Password" required />
										</div>
											<button type="submit" class="SubmitBtn" style="font-family: sans-serif;"><i class="fa fa-plus"></i>ADD NEW USER</button>
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
						<div class="column c2">
							<h1 class="SecTitle"><i class="fa fa-list-alt" style="font-size: 26px"></i> User List</h1>
							<div class="s_content">
								<div class="Num_Users">
										<table>
											<thead>
											<tr>
												<th>No.</th>
												<th>First Name</th>
												<th>Last Name</th>
												<th>Email</th>
												<th>Created At</th>
												<th>Updated At</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
												<?php
													foreach ($users as $index => $user) { ?>
												<tr>
													<td class="no"><?= $index + 1?></td>
													<td class="FFname"><?= $user['First_Name']?></td>
													<td class="LLname"><?= $user['Last_Name']?></td>
													<td class="EEadd"><?= $user['Email']?></td>
													<td class="Cdate"><?= date('M d, Y @ h:i A', strtotime($user['Created_at']))?></td>
													<td class="Up"><?= date('M d, Y @ h:i A', strtotime($user['Updated_at']))?></td>
													<td class="iconn">
														<a href="" class="Update" data-userid="<?= $user['ID'] ?>"><i class=" fa fa-pencil-square-o"></i>Update</a>
														<a href="" class="Delete" data-userid="<?= $user['ID'] ?>" data-fname="<?= $user['First_Name'] ?>" data-lname="<?= $user['Last_Name'] ?>"><i class=" fa fa-trash"></i>Delete</a>	
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>		
										<p class="UCount">No. of Users: <?= count($users) ?></p>
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

					if(classList.contains('Delete')) {
						e.preventDefault();
						userid = targetElement.dataset.userid;
						fname = targetElement.dataset.fname;
						lname = targetElement.dataset.lname;
						full_name = fname +' '+ lname;

						if(window.confirm('Are you sure you want to delete '+full_name+'?')) {
							$.ajax ({
								method: 'POST',
								data: {
									UserID: userid,
									FName: fname,
									LName: lname
								},
								url: 'database/delete_user.php',
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
					if(classList.contains('Update')) {
						e.preventDefault();
									
						FFname = targetElement.closest('tr').querySelector('td.FFname').innerHTML;
						LLname = targetElement.closest('tr').querySelector('td.LLname').innerHTML;
						EEadd = targetElement.closest('tr').querySelector('td.EEadd').innerHTML;
						userid = targetElement.dataset.userid;	

						BootstrapDialog.confirm({
							title: 'Update data of ' + FFname + ' ' + LLname,
							message: '<form>\
										<div class = "form-group">\
										<label for = "FFname">First Name: </label>\
										<input type = "text" class = "form-control" id = "FFname" value = "'+ FFname +'">\
										</div>\
										<div class = "form-group">\
										<label for = "LLname">Last Name: </label>\
										<input type = "text" class = "form-control" id = "LLname" value = "'+ LLname +'">\
										</div>\
										<div class = "form-group">\
										<label for = "EEadd">Email Address: </label>\
										<input type = "text" class = "form-control" id = "EEadd" value = "'+ EEadd +'">\
										</div>\
									</form>',
							callback: function(isUpdate) {

								if(isUpdate)
								{
									$.ajax ({
										method: 'POST',
										data: {
											userid: userid,
											ffname: document.getElementById('FFname').value,
											llname: document.getElementById('LLname').value,
											EmailAd: document.getElementById('EEadd').value
										},
									url: 'database/update_user.php',
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