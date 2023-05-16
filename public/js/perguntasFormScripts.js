// Tratamento para mudar estilo de respotas com base no tipo da pergunta
var select = document.getElementById("tipo");
var discursiveOptions = document.getElementById("opcoes-perguntas-discursivas");
var objectiveOptions = document.getElementById("opcoes-perguntas-objetivas");

select.addEventListener("change", function() {
    // Obtém o valor da opção selecionada
    var selectedOption = select.value;

    // Verifica o valor da opção selecionada para mostrar elemento correto
    if (selectedOption === "DISCURSIVA") {
        objectiveOptions.style.display = "none";
        discursiveOptions.style.display = "block";

        // Busca elemento da resposta discursiva e define o campo como required
        document.querySelectorAll('#opcoes-perguntas-discursivas .discursive-option-text').forEach(function(elemento) {
            elemento.required = true;
        });

        // Busca elemento da resposta discursiva e define o campo como required
        document.querySelectorAll('#opcoes-perguntas-discursivas .discursive-option-text').forEach(function(elemento) {
            elemento.required = true;
        });

        // Buscar opções de resposta das perguntas objetivas e remove o required
        document.querySelectorAll('.objetive-option-ratio').forEach(function(elemento) {
            elemento.required = false;
        });
    } else if (selectedOption === 'OBJETIVA') {
        discursiveOptions.style.display = "none";
        objectiveOptions.style.display = "block";

        // Buscar opções de resposta das perguntas objetivas e definir as mesmas como required
        document.querySelectorAll('.objetive-options .objetive-option-text').forEach(function(elemento) {
            elemento.required = true;
        });

        // Busca elemento da resposta discursiva e remove o required
        document.querySelectorAll('#opcoes-perguntas-discursivas .discursive-option-text').forEach(function(elemento) {
            elemento.required = false;
        });

        // Buscar opções de resposta das perguntas objetivas e remove o required
        document.querySelectorAll('.objetive-option-ratio').forEach(function(elemento) {
            elemento.required = true;
        });
    } else {
        discursiveOptions.style.display = "none";
        objectiveOptions.style.display = "none";

        // Buscar opções de resposta das perguntas objetivas e remove o required
        document.querySelectorAll('.objetive-options .objetive-option-text').forEach(function(elemento) {
            elemento.required = false;
        });

        // Busca elemento da resposta discursiva e remove o required
        document.querySelectorAll('#opcoes-perguntas-discursivas .discursive-option-text').forEach(function(elemento) {
            elemento.required = false;
        });
    }
});
