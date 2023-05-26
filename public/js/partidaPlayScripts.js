const respostas = document.getElementById('respostas');
const btnConfirmar = document.getElementById('btn-confirmar');

respostas.addEventListener('change', function() {
    const opcoes = respostas.querySelectorAll('input[type="radio"]');
    let selecionado = false;

    opcoes.forEach(function(opcao) {
        if (opcao.checked) {
            selecionado = true;
        }
    });

    if (selecionado) {
        btnConfirmar.classList.remove('disabled');
    } else {
        btnConfirmar.classList.add('disabled');
    }
});
