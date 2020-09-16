
class Agenda{

	constructor(leftChoice, rightChoice, leftContent, rightContent){

		this.leftChoice= leftChoice;
		this.rightChoice= rightChoice;
		this.leftContent= leftContent;
		this.rightContent= rightContent;
	}


	showLeft(){

		this.leftContent.style.display="flex";
		this.rightContent.style.display="none";



		this.leftChoice.style.boxShadow="none";
		this.rightChoice.style.boxShadow="inset 2px -2px 5px black";

		this.leftChoice.style.backgroundColor="white";
		this.rightChoice.style.backgroundColor="RGB(229, 223, 221)";

		this.leftChoice.style.opacity="1";
		this.rightChoice.style.opacity="0.5";

	}


	showRight(){

		this.leftContent.style.display="none";
		this.rightContent.style.display="flex";



		this.leftChoice.style.boxShadow="inset -2px -2px 5px black";
		this.rightChoice.style.boxShadow="none";

		this.leftChoice.style.backgroundColor="RGB(229, 223, 221)";
		this.rightChoice.style.backgroundColor="white";

		this.leftChoice.style.opacity="0.5";
		this.rightChoice.style.opacity="1";

	}


	/*over(){

		if(this.rightChoice.style.opacity=="0.5"){
			this.rightChoice.style.backgroundColor=="white";
			console.log('over');
		}
	}*/


}




var leftSelector= document.querySelector("#organised");
var rightSelector= document.querySelector("#participate");


var organisedContent= document.querySelector("#organisedSection");
var participateContent= document.querySelector("#participateSection");



var agendaView= new Agenda(leftSelector, rightSelector, organisedContent, participateContent);



leftSelector.addEventListener("click", function(){

	agendaView.showLeft();
})

rightSelector.addEventListener("click", function(){

	agendaView.showRight();
})






/*rightSelector.addEventListener("mouseover", function(){

	agendaView.over();
})*/


