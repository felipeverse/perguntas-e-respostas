// Adiciona validação para garantir que pelo menos um tema seja selecionado
document.getElementById('gincanas-fase-create-form').addEventListener('submit', function(event) {
    var temasCheckboxes = document.querySelectorAll('input[name="temas[]"]:checked');
    if (temasCheckboxes.length === 0) {
        event.preventDefault(); // Impede o envio do formulário
        alert('Selecione pelo menos um tema.');
    }
});

// Carrega a view de temas ao mudar o nível das perguntas
var select = document.getElementById("nivel");

select.addEventListener("change", function() {
    // Obtém o valor da opção selecionada
    var nivel = select.value;

    if (nivel) {
        var url = '/temas-por-nivel-partial-view/' + nivel;

        fetch(url)
            .then(response => response.text())
            .then(data => {
                var temasDiv = document.getElementById('fase-temas');
                temasDiv.innerHTML = data;
            })
            .catch(error => {
                console.error(error);
            });
    } else {
        var temasDiv = document.getElementById('fase-temas');
        temasDiv.innerHTML = '';
    }
});

function validarInput(input) {
    if (input.value <= 0) {
      input.value = "";
    }
}
