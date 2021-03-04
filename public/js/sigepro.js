let ativo = document.querySelector('.ativo-checkbox');
let selector = document.querySelector('.selector');
var title = document.querySelector('.title');


if (selector.childElementCount < 2) {
    setTimeout(function() {
        alert('Seu projeto não possui categorias. Crie-as em Página Inicial->Categorias');
    }, 1000);
}

/*
function openModal() {
    document.getElementById("imgModal").style.display = "block";
}

function closeModal() {
    document.getElementById("imgModal").style.display = "none";
}

*/
