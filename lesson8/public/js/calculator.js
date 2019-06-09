let calc = document.getElementById('calculator');
let expr = document.getElementById('expression');

expr.focus();

calc.addEventListener("click", (e) => {

    if (e.target.tagName === 'DIV') {

        let symbol = e.target.textContent;

        if (symbol === '=') {
            // e.target.parentElement.submit();
            document.location.href = `?page=calculator&action=toCalculate&expression=` + expr.value;
        }

        expr.value += symbol;
        expr.focus();
    }

});

expr.oninput = function () {
    this.value = this.value.replace(/[^-+*/.\d]/g, '');
};

expr.addEventListener('keyup', (e) => {
    if (e.key === "Escape") {
        expr.value = '';
        document.location.href = `?page=calculator`;
    }
});

let calcForm = document.getElementById('calcForm');

calcForm.onsubmit = function (e) {
    document.location.href = `?page=calculator&action=toCalculate&expression=` + expr.value;
    e.preventDefault();
};