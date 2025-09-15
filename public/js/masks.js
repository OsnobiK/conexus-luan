document.addEventListener('DOMContentLoaded', function() {
    const cpfInput = document.getElementById('cpf');
    const telefoneInput = document.getElementById('telefone');

    // Máscara para CPF (xxx.xxx.xxx-xx)
    cpfInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
        if (value.length > 11) {
            value = value.slice(0, 11);
        }
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = value;
    });

    // Máscara para Telefone ((xx) xxxxx-xxxx)
    telefoneInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
        if (value.length > 11) {
            value = value.slice(0, 11);
        }
        value = value.replace(/^(\d{2})(\d)/g, '($1) $2'); // Adiciona parênteses e espaço
        value = value.replace(/(\d)(\d{4})$/, '$1-$2'); // Adiciona hífen
        e.target.value = value;
    });
});