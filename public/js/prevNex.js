document.addEventListener('DOMContentLoaded', function() {
    const tablesWrapper = document.getElementById('tables-wrapper');
    const tableNumbers = document.getElementById('table-numbers');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');

    let currentTableIndex = 0;
    const tablesCount = tablesWrapper.children.length;
    const tables = tablesWrapper.querySelectorAll('.table');

    generateTableNumbers();
    updateNavigationButtons();

    function generateTableNumbers() {
        tableNumbers.innerHTML = '';
        for (let i = 0; i < tablesCount; i++) {
            const numberBox = document.createElement('button');
            numberBox.textContent = i + 1;
            numberBox.className = 'number-box';
            numberBox.addEventListener('click', function() {
                goToTable(i);
            });
            tableNumbers.appendChild(numberBox);
        }
    }

    function updateNavigationButtons() {
        prevBtn.disabled = currentTableIndex === 0;
        nextBtn.disabled = currentTableIndex === tablesCount - 1;
        highlightCurrentTableNumber();
    }

    function goToTable(index) {
        currentTableIndex = index;
        scrollToTable(currentTableIndex);
        updateNavigationButtons();
    }

    function scrollToTable(index) {
        tables[index].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
    }

    function highlightCurrentTableNumber() {
        const numberBoxes = document.querySelectorAll('.number-box');
        numberBoxes.forEach((box, index) => {
            if (index === currentTableIndex) {
                box.classList.add('current');
            } else {
                box.classList.remove('current');
            }
        });
    }

    function prevTable() {
        if (currentTableIndex > 0) {
            currentTableIndex--;
            scrollToTable(currentTableIndex);
            updateNavigationButtons();
        }
    }

    function nextTable() {
        if (currentTableIndex < tablesCount - 1) {
            currentTableIndex++;
            scrollToTable(currentTableIndex);
            updateNavigationButtons();
        }
    }

    prevBtn.addEventListener('click', prevTable);
    nextBtn.addEventListener('click', nextTable);
});