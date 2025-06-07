// Aguarda o carregamento completo do DOM (Document Object Model) antes de executar o script.
document.addEventListener('DOMContentLoaded', function() {
    // Obtém uma referência ao elemento <select> com o ID 'sort'.
    const sortSelect = document.getElementById('sort');

    // Verifica se o elemento 'sortSelect' existe para evitar erros se o ID não for encontrado.
    if (sortSelect) {
        // Adiciona um 'event listener' ao evento 'change' (quando a seleção do dropdown muda).
        sortSelect.addEventListener('change', function() {
            // Cria um novo objeto URL com base na URL atual da janela.
            let url = new URL(window.location.href);

            // Define ou atualiza o parâmetro 'sort' na URL com o valor da opção selecionada.
            // 'this.value' refere-se ao valor (value) da opção <option> selecionada.
            url.searchParams.set('sort', this.value);

            // Redireciona a página para a nova URL com o parâmetro 'sort' atualizado.
            window.location.href = url.toString();
        });

        // Este bloco de código é executado no carregamento inicial da página
        // para garantir que a opção de ordenação selecionada anteriormente seja exibida.
        let urlParams = new URLSearchParams(window.location.search); // Obtém todos os parâmetros da URL.
        let sortParam = urlParams.get('sort'); // Tenta obter o valor do parâmetro 'sort' da URL.

        // Se o parâmetro 'sort' existir na URL, define a opção correspondente no dropdown.
        if (sortParam) {
            sortSelect.value = sortParam;
        }
    }
}); 