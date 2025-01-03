document.addEventListener('DOMContentLoaded', function () {
    const calculateBtn = document.getElementById('mc-calculate-btn');
    calculateBtn.addEventListener('click', function () {
        const propertyPrice = parseFloat(document.getElementById('propertyPrice').value);
        const downPayment = parseFloat(document.getElementById('downPayment').value);
        const loanTerm = parseFloat(document.getElementById('loanTerm').value);
        const interestRate = parseFloat(document.getElementById('interestRate').value);

        if (isNaN(propertyPrice) || isNaN(downPayment) || isNaN(loanTerm) || isNaN(interestRate)) {
            alert('Please enter valid numbers.');
            return;
        }

        const loanAmount = propertyPrice - downPayment;
        const numberOfPayments = loanTerm * 12;
        const monthlyInterestRate = (interestRate / 100) / 12;

        const monthlyPayment = (loanAmount * monthlyInterestRate) / 
            (1 - Math.pow(1 + monthlyInterestRate, -numberOfPayments));

        document.getElementById('monthlyPayment').innerText = 
            'Monthly Payment: ' + monthlyPayment.toFixed(2);
    });
});
