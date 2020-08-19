
document.querySelector("#menuBar").addEventListener("click", function(){
	document.querySelector("#listMenuRoll").style.display="block";
	document.querySelector("#menuBar").style.display="none";

	event.preventDefault();

})



document.querySelector(".fa-window-close").addEventListener("click", function(){
	document.querySelector("#listMenuRoll").style.display="none";
	document.querySelector("#menuBar").style.display="block";

	event.preventDefault();
})





document.querySelector("#profilMenuLink").addEventListener("click", function(){
	document.querySelector("#profilMenuRoll").style.display="block";
	document.querySelector("#profilMenuLink").style.display="none";

	event.preventDefault();

})



document.querySelector(".fa-window-close").addEventListener("click", function(){
	document.querySelector("#profilMenuRoll").style.display="none";
	document.querySelector("#profilMenuLink").style.display="block";

	event.preventDefault();
})




	