function meteo(url){

	this.url=url;

	let request=new XMLHttpRequest();
		

	request.open("GET", this.url, true);

	request.onreadystatechange=function(){
		if(request.readyState===XMLHttpRequest.DONE){
			if(request.status===200){

				let data = JSON.parse(request.responseText);

				console.log(data);
				console.log(data['city_info']);

				var day= document.querySelector("#day");
				var img=document.querySelector('#dayImg');
				var tMax= document.querySelector('#tMax');
				var tMin= document.querySelector('#tMin');



				if(typeof(data['city_info'])=="undefined"){
					document.querySelector('#meteo').innerHTML="Impossible d'afficher les prévisions météos de cet évènement";
					document.querySelector('#meteo').style.fontSize="30px";
					document.querySelector('#meteo').style.marginTop="20px";
				}
				else{

					if(day.className=="day0"){
						day.innerHTML='Auj. '+data['fcst_day_0']['date'];
						img.src=data['fcst_day_0']['icon_big'];
						tMin.innerHTML+=data['fcst_day_0']['tmin']+'°C';
						tMax.innerHTML+=data['fcst_day_0']['tmax']+'°C';
					}
					else if(day.className=="day1"){
						day.innerHTML='Dem. '+data['fcst_day_1']['date'];
						img.src=data['fcst_day_1']['icon_big'];
						tMin.innerHTML=data['fcst_day_1']['tmin']+'°C';
						tMax.innerHTML=data['fcst_day_1']['tmax']+'°C';
					}
					else if(day.className=="day2"){
						day.innerHTML=data['fcst_day_2']['day_short']+" "+data['fcst_day_2']['date'];
						img.src=data['fcst_day_2']['icon_big'];
						tMin.innerHTML=data['fcst_day_2']['tmin']+'°C';
						tMax.innerHTML=data['fcst_day_2']['tmax']+'°C';
					}
					else if(day.className=="day3"){
						day.innerHTML=data['fcst_day_3']['day_short']+" "+data['fcst_day_3']['date'];
						img.src=data['fcst_day_3']['icon_big'];
						tMin.innerHTML=data['fcst_day_3']['tmin']+'°C';
						tMax.innerHTML=data['fcst_day_3']['tmax']+'°C';
					}
					else if(day.className=="day4"){
						day.innerHTML=data['fcst_day_4']['day_short']+" "+data['fcst_day_4']['date'];
						img.src=data['fcst_day_4']['icon_big'];
						tMin.innerHTML=data['fcst_day_4']['tmin']+'°C';
						tMax.innerHTML=data['fcst_day_4']['tmax']+'°C';
					}

				}

			}
	
		}
	}

	request.send(null);

}


var city = document.querySelector('#City').innerHTML;



meteo('https://prevision-meteo.ch/services/json/'+city);












