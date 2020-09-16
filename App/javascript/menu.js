// Faire apparaître et disparaître le menu déroulant

class Menu{

	constructor(nav){

		this.nav= nav;
	}


	open(){

		this.nav.style.display="block";
	}


	close(){

		this.nav.style.display="none";
	}


}


var openButton= document.querySelector("#profilMenuLink");
var closeButton= document.querySelector("#closeMenu");

var menu= document.querySelector(".navMenu");



var headerMenu= new Menu(menu);



openButton.addEventListener("click", function(){

	headerMenu.open();
	event.preventDefault();
})

closeButton.addEventListener("click", function(){
	headerMenu.close();
})

