// Adiciona validação para garantir que pelo menos um tema seja selecionado
document.getElementById('gincanas-fase-create-form').addEventListener('submit', function(event) {
    var temasCheckboxes = document.querySelectorAll('input[name="temas[]"]:checked');
    if (temasCheckboxes.length === 0) {
        event.preventDefault(); // Impede o envio do formulário
        alert('Selecione pelo menos um tema.');
    }
});
