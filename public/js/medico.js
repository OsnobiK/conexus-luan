document.addEventListener('DOMContentLoaded', function () {
    const telefoneInput = document.getElementById('telefone');
    const crmInput = document.getElementById('crm');
    const cpfInput = document.getElementById('cpf'); // Adiciona o campo CPF

    if (telefoneInput) {
        telefoneInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);
            value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
            e.target.value = value;
        });

        telefoneInput.addEventListener('keypress', function (e) {
            if (!/\d/.test(e.key)) e.preventDefault();
        });
    }

    if (crmInput) {
        crmInput.addEventListener('input', function (e) {
            // Permite números, letras, traço e barra
            let value = e.target.value.replace(/[^0-9a-zA-Z\-\/]/g, '');
            // Aplica a máscara: 00000000-0/BR
            value = value.replace(/^(\d{8})(\d)/, '$1-$2');
            value = value.replace(/^(\d{8}-\d)(\/?)([a-zA-Z]{0,2})/, '$1/$3');
            // Limita a 8 números, 1 número, barra e até 2 letras
            value = value.slice(0, 13); // 8+1+1+2+1 (traço e barra)
            e.target.value = value;
        });

        crmInput.addEventListener('keypress', function (e) {
            if (!/[0-9a-zA-Z\-\/]/.test(e.key)) e.preventDefault();
        });
    }

    // Máscara para CPF: 000.000.000-00
    if (cpfInput) {
        cpfInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não for número

            if (value.length > 11) value = value.slice(0, 11); // Limita a 11 dígitos

            // Aplica a máscara: 000.000.000-00
            value = value.replace(/^(\d{3})(\d)/, '$1.$2');
            value = value.replace(/^(\d{3}\.\d{3})(\d)/, '$1.$2');
            value = value.replace(/^(\d{3}\.\d{3}\.\d{3})(\d)/, '$1-$2');

            e.target.value = value; // Define o valor formatado no input
        });

        cpfInput.addEventListener('keypress', function (e) {
            if (!/\d/.test(e.key)) e.preventDefault(); // Permite apenas números
        });
    }
});