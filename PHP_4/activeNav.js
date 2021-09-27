function setCurrentPage(currentNav) {
	var navBar = document.getElementById('myTopnav');
	var links = navBar.getElementsByTagName('a');
	var currentPage = document.getElementById(currentNav);

	for (var i = 0; i < links.length; i++) {
		links[i].classList.remove('active');
    }

    currentPage.classList.add('active');
}