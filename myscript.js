
//Tentando verificar senha dinamicamente quando o usuario estiver colocando

$(document).ready(function(){

});  

function validate(){

    repsenha = document.getElementById('#senha2');
    if ($('#senha1') !== $('#senha2')){
        repsenha.preventDefault();
        repsenha.style.color('#A52A2A');
        alert('Senhas não estão iguais...');
    }
    else{
        repsenha.style.color('#000000');
    }
    
}