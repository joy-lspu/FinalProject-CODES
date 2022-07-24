var menubarIsOpen = true;

	selectbtn.addEventListener('click', (event) => {
		event.preventDefault();

		if(menubarIsOpen){
		DB_sidebar.style.width ='15%';
		DB_sidebar.style.transition = '0.35s all'
		DB_content.style.width ='85%';
		Logo.style.width = '265px';
		UImage.style.width = '55px';

		menuIcons = document.getElementsByClassName('menuText');
		for(var i=0; i < menuIcons.length; i++){
			menuIcons[i].style.display = 'none';
		}

		document.getElementsByClassName('DB_list')[0].style.textAlign ='center';
		menubarIsOpen = false;
		} 

		else {
		DB_sidebar.style.width ='20%';
		DB_content.style.width ='95%';
		Logo.style.width = '320px';
		UImage.style.width = '65px';

		menuIcons = document.getElementsByClassName('menuText');
		for(var i=0; i < menuIcons.length; i++){
			menuIcons[i].style.display = 'inline-block';
		}
		document.getElementsByClassName('DB_list')[0].style.textAlign ='left';
		menubarIsOpen = true;
		}
	});