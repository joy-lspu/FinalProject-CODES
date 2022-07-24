<div class="DB_sidebar" id="DB_sidebar">
<div class="DB_logo">
		<img src="images/ge_logo.png" alt="Logo" id="Logo" />
</div>
<div class="DB_user">
	<img src="images/user/dp.jpg" alt="User Image" id="UImage" />
	<span><?= $user['First_Name'] . ' ' . $user['Last_Name'] ?></span>
</div>
<div class="DB_menubar" id="DB_menubar">
	<ul class="DB_list">
		<li>
			<a href="./dashboard.php"><i class="fa fa-bar-chart" style="font-size: 23px;"></i> <span class="menuText">DASHBOARD</span></a>
		</li>
		<li>
			<a href="./add_new.php"><i class="fa fa-user-plus" style="font-size: 23px;"></i> <span class="menuText">NEW USER ACCOUNT</span></a>
		</li>
		<li>
			<a href="./add_prod.php"><i class="fa fa-shopping-basket" style="font-size: 23px;"></i> <span class="menuText">PRODUCTS</span></a>
		</li>
	</ul>
</div>
</div>