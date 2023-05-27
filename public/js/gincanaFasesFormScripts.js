// Adiciona validação para garantir que pelo menos um tema seja selecionado
document.getElementById('gincanas-fase-create-form').addEventListener('submit', function(event) {
    var temasCheckboxes = document.querySelectorAll('input[name="temas[]"]:checked');
    if (temasCheckboxes.length === 0) {
        event.preventDefault(); // Impede o envio do formulário
        alert('Selecione pelo menos um tema.');
    }
});

function validarInput(input) {
    if (input.value <= 0) {
      input.value = "";
    }
}

// Carrega a view de temas ao mudar o nível e tipo das perguntas
var selectNivel = document.getElementById("nivel");
var selectTipo = document.getElementById("tipo");
var faseTemasDiv = document.getElementById("fase-temas");

selectNivel.addEventListener("change", validarSelecao);
selectTipo.addEventListener("change", validarSelecao);

function validarSelecao() {
    var nivel = selectNivel.value;
    var tipo = selectTipo.value;

    if (nivel && tipo) {
        var url = '/temas-por-nivel-partial-view/' + nivel;
        var data = {
            nivel: nivel,
            tipo: tipo
        };

        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Configurar o cabeçalho da solicitação Fetch com o token CSRF
        var headers = new Headers();
        headers.append('X-CSRF-TOKEN', csrfToken);

        // Opções da requisição Fetch
        var requestOptions = {
            method: 'POST',
            headers: headers,
            body: JSON.stringify(data)
        };

        fetch(url, requestOptions)
            .then(response => response.text())
            .then(data => {
                console.log(data);
                faseTemasDiv.innerHTML = data;
            })
            .catch(error => {
                console.error(error);
            });
    } else {
        faseTemasDiv.innerHTML = '';
    }
}

// selectNivel.addEventListener("change", function() {
//     // Obtém o valor da opção selecionada
//     var nivel = selectNivel.value;

//     if (nivel) {
//         var url = '/temas-por-nivel-partial-view/' + nivel;

//         fetch(url)
//             .then(response => response.text())
//             .then(data => {
//                 faseTemasDiv.innerHTML = data;
//             })
//             .catch(error => {
//                 console.error(error);
//             });
//     } else {
//         faseTemasDiv.innerHTML = '';
//     }
// });
