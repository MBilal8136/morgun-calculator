<div class="mcp-calculator">
    <h3>Mortgage Calculator Pro</h3>
    <form id="mcp-calculator-form">
        <label for="propertyPrice">Property Price:</label>
        <input type="number" id="propertyPrice" placeholder="Enter property price">

        <label for="downPayment">Down Payment:</label>
        <input type="number" id="downPayment" placeholder="Enter down payment">

        <label for="loanTerm">Loan Term (years):</label>
        <input type="number" id="loanTerm" placeholder="Enter loan term" value="<?php echo esc_attr(get_option('mcp_default_loan_term', '30')); ?>">

        <label for="interestRate">Interest Rate (%):</label>
        <input type="number" id="interestRate" placeholder="Enter interest rate" value="<?php echo esc_attr(get_option('mcp_default_interest_rate', '3.5')); ?>">

        <button type="button" id="mcp-calculate-btn">Calculate</button>
    </form>
    <p id="monthlyPayment"></p>
</div>
