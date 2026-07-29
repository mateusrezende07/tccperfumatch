function rolar(direcao){
    const carrossel = document.querySelector(".carrossel");
    if(carrossel){
        carrossel.scrollLeft += direcao * 300;
    }
}

function votar(n){
    document.getElementById("nota").value = n;
}