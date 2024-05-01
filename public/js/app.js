document.addEventListener("DOMContentLoaded", function() {
    const addOptionButton = document.querySelector('button.add-option');
    const optionsContainer = document.querySelector('.options');

    addOptionButton.addEventListener('click', function() {
        addOption(optionsContainer, addOptionButton);
    });

    optionsContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-option')) {
            if (optionsContainer.querySelectorAll('.option').length > 3) { // Verifica se há mais de 3 opções
                const optionDiv = event.target.closest('.option');
                removeOption(optionDiv);
                updateOptionLabels(optionsContainer);
            } else {
                alert('A enquete deve ter no mínimo 3 opções');
            }
        }
    });
});

function addOption(optionsContainer, addOptionButton) {
    const optionCount = optionsContainer.querySelectorAll('.option').length;

    const optionDiv = document.createElement("div");
    optionDiv.className = "option";

    const optionLabel = document.createElement("label");
    const optionLabelText = document.createTextNode("Opção " + (optionCount + 1));
    optionLabel.appendChild(optionLabelText);

    const optionContentDiv = document.createElement("div");
    optionContentDiv.className = "option-content";

    const optionInput = document.createElement("input");
    optionInput.type = "text";
    optionInput.required = true;
    optionInput.name = "option[" + (optionCount + 1) + "][content]";
    optionInput.placeholder = "Digite uma opção";

    optionLabel.setAttribute("for", "option" + (optionCount + 1));

    const removeButton = document.createElement("span");
    removeButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
    removeButton.className = "remove-option";
    
    removeButton.addEventListener("click", function () {
        if (optionsContainer.querySelectorAll('.option').length > 3) { // Verifica se há mais de 3 opções
            removeOption(optionDiv);
            updateOptionLabels(optionsContainer);
        } else {
            alert('A enquete deve ter no mínimo 3 opções');
        }
    });

    optionContentDiv.appendChild(optionInput);
    optionContentDiv.appendChild(removeButton);

    optionDiv.appendChild(optionLabel);
    optionDiv.appendChild(optionContentDiv);

    optionsContainer.insertBefore(optionDiv, addOptionButton);

    updateOptionLabels(optionsContainer);
}

function removeOption(optionDiv) {
    optionDiv.parentNode.removeChild(optionDiv);
    updateOptionLabels(optionsContainer);
}

function updateOptionLabels(optionsContainer) {
    const options = optionsContainer.querySelectorAll('.option');
    options.forEach(function(option, index) {
        const label = option.querySelector('label');
        const labelText = "Opção " + (index + 1);
        label.textContent = labelText;

        const input = option.querySelector('input');
        input.name = "option[" + (index + 1) + "][content]";
    });
}
