document.addEventListener("DOMContentLoaded", function () {
    const addOptionButton = document.querySelector(".add-option");
    const optionsContainer = document.querySelector(".options");
    const createPollButton = document.querySelector(".create-poll");
    let optionCount = document.querySelectorAll('.option').length; // Contador inicial de opções

    function removeOption(optionDiv) {
        if (optionDiv.classList.contains("fixed-option")) {
            optionDiv.style.display = "none";
        } else {
            optionsContainer.removeChild(optionDiv);
            optionCount--;
        }
        if (optionCount < 3) {
            addOption();
        }
        updateOptionsAttributes();
    }

    function addOption() {
        optionCount++;
        const optionDiv = document.createElement("div");
        optionDiv.className = "option";
    
        const optionLabel = document.createElement("label");
        const optionLabelText = document.createTextNode("Opção " + optionCount);
        optionLabel.appendChild(optionLabelText);
    
        const optionContentDiv = document.createElement("div");
        optionContentDiv.className = "option-content";
    
        const optionInput = document.createElement("input");
        optionInput.type = "text";
        optionInput.id = "option" + optionCount;
        optionInput.name = "option" + optionCount; 
        optionInput.placeholder = "Digite uma opção";
    
        optionLabel.setAttribute("for", "option" + optionCount); 
    
        const removeButton = document.createElement("span");
        removeButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
        removeButton.className = "remove-option";
        removeButton.addEventListener("click", function () {
            removeOption(optionDiv);
        });
    
        optionContentDiv.appendChild(optionInput);
        optionContentDiv.appendChild(removeButton);
    
        optionDiv.appendChild(optionLabel);
        optionDiv.appendChild(optionContentDiv);
    
        optionsContainer.insertBefore(optionDiv, addOptionButton);
    }
    
    function updateOptionLabels() {
        const optionLabels = document.querySelectorAll('.option label');
        optionLabels.forEach((label, index) => {
            label.textContent = "Opção " + (index + 1);
        });
    }

    function updateOptionsAttributes() {
        const optionInputs = document.querySelectorAll('.option input[type="text"]');
        const optionLabels = document.querySelectorAll('.option label');
        optionInputs.forEach((input, index) => {
            const optionNumber = index + 1;
            input.id = "option" + optionNumber;
            input.name = "option" + optionNumber;
            optionLabels[index].setAttribute("for", "option" + optionNumber);
        });
        updateOptionLabels();
    }

    addOptionButton.addEventListener("click", addOption);

    createPollButton.addEventListener("click", function () {
        console.log("Enquete criada!");
    });

    optionsContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-option")) {
            const optionDiv = event.target.closest(".option");
            removeOption(optionDiv);
        }
    });
});
