// Seleciona o botão flutuante e o modal
var modal = document.getElementById("new-post-modal");
var btn = document.querySelector(".float-button");
var span = document.querySelector(".close-button");

// Quando o botão é clicado, abre o modal
btn.onclick = function() {
    modal.style.display = "block";
}

// Quando o usuário clicar no 'x', fecha o modal
span.onclick = function() {
    modal.style.display = "none";
}

// Quando o usuário clicar fora do modal, fecha o modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

