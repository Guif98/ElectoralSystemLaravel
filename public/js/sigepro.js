let ativo = document.querySelector('.ativo-checkbox');
let selector = document.querySelector('.selector');
let projeto = document.querySelector('.project-div');
var title = document.querySelector('.title');


/*projeto.addEventListener('click', function(){
    console.log(projeto.id)
});*/

function apenasNumeros(extra){
	if(window.event){
		if((window.event.keyCode <48) || (window.event.keyCode>57)){
			if(extra == undefined) return false;
			if(extra.indexOf(String.fromCharCode(window.event.keyCode)) < 0) return false;
		}
	}
	return true;
}







/*
function openModal() {
    document.getElementById("imgModal").style.display = "block";
}

function closeModal() {
    document.getElementById("imgModal").style.display = "none";
}

*/
