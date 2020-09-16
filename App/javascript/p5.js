// Faire apparaître et disparaître le menu déroulant


document.querySelector("#profilMenuLink").addEventListener("click", function(){

		document.querySelector("#profilMenuRoll").style.display="block";
		event.preventDefault();

})


document.querySelector("#closeMenu").addEventListener ("click", function(){

	document.querySelector("#profilMenuRoll").style.display="none";
})




// AGENDA VIEW

document.querySelector("#organised").addEventListener("click", function(){

	document.querySelector("#participateSection").style.display="none";
	document.querySelector("#organisedSection").style.display="flex";
	document.querySelector("#organised").style.boxShadow="none";
	document.querySelector("#participate").style.boxShadow="inset 2px -2px 5px black";
	document.querySelector("#participate").style.backgroundColor="RGB(229, 223, 221)";
	document.querySelector("#participate").style.opacity="0.5";
	document.querySelector("#organised").style.opacity="1";
	document.querySelector("#organised").style.backgroundColor="white";
})


document.querySelector("#participate").addEventListener("click", function(){

	document.querySelector("#organisedSection").style.display="none";
	document.querySelector("#participateSection").style.display="flex";
	document.querySelector("#participate").style.boxShadow="none";
	document.querySelector("#organised").style.boxShadow="inset -2px -2px 5px black";
	document.querySelector("#organised").style.backgroundColor="RGB(229, 223, 221)";
	document.querySelector("#organised").style.opacity="0.5";
	document.querySelector("#participate").style.opacity="1";
	document.querySelector("#participate").style.backgroundColor="white";
})

	



if(document.querySelector("#organisedSection").style.display=="none"){
	
	document.querySelector("#organised").addEventListener("mouseover", function(){
		document.querySelector("#organised").style.opacity="1";
		console.log('mouse');
		console.log('mouseover#organised');
	})	


	document.querySelector("#organised").addEventListener("mouseleave", function(){
		document.querySelector("#organised").style.opacity="0.5";
		console.log('mouseleave#organised');
	})
}




if(document.querySelector("#participateSection").style.display=="none"){
	
	document.querySelector("#participate").addEventListener("mouseover", function(){
		document.querySelector("#participate").style.opacity="1";
	})


	document.querySelector("#participate").addEventListener("mouseleave", function(){
		document.querySelector("#participate").style.opacity="0.5";
	})

}









