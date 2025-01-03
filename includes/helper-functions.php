<?php
// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Helper function to calculate the monthly mortgage payment.
 *
 * @param float $loanAmount The total loan amount.
 * @param float $annualInterestRate The annual interest rate (percentage).
 * @param int   $loanTermYears The loan term in years.
 * @return float Monthly payment.
 */
function mcp_calculate_monthly_payment($loanAmount, $annualInterestRate, $loanTermYears) {
    $monthlyInterestRate = ($annualInterestRate / 100) / 12;
    $numberOfPayments = $loanTermYears * 12;

    if ($monthlyInterestRate == 0) {
        // If interest rate is 0, divide the loan amount by the number of payments
        return $loanAmount / $numberOfPayments;
    }

    $monthlyPayment = ($loanAmount * $monthlyInterestRate) / 
        (1 - pow(1 + $monthlyInterestRate, -$numberOfPayments));

    return round($monthlyPayment, 2);
}

/**
 * Helper function to validate and sanitize form inputs.
 *
 * @param array $inputs The array of input data to validate.
 * @return array Sanitized inputs with error messages if applicable.
 */
function mcp_validate_inputs($inputs) {
    $errors = [];
    $sanitizedInputs = [];

    if (isset($inputs['propertyPrice'])) {
        $sanitizedInputs['propertyPrice'] = filter_var($inputs['propertyPrice'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        if ($sanitizedInputs['propertyPrice'] <= 0) {
            $errors['propertyPrice'] = 'Property price must be a positive number.';
        }
    }

    if (isset($inputs['downPayment'])) {
        $sanitizedInputs['downPayment'] = filter_var($inputs['downPayment'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        if ($sanitizedInputs['downPayment'] < 0) {
            $errors['downPayment'] = 'Down payment cannot be negative.';
        }
    }

    if (isset($inputs['loanTerm'])) {
        $sanitizedInputs['loanTerm'] = filter_var($inputs['loanTerm'], FILTER_SANITIZE_NUMBER_INT);
        if ($sanitizedInputs['loanTerm'] <= 0) {
            $errors['loanTerm'] = 'Loan term must be a positive integer.';
        }
    }

    if (isset($inputs['interestRate'])) {
        $sanitizedInputs['interestRate'] = filter_var($inputs['interestRate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        if ($sanitizedInputs['interestRate'] < 0) {
            $errors['interestRate'] = 'Interest rate cannot be negative.';
        }
    }

    return ['inputs' => $sanitizedInputs, 'errors' => $errors];
}

/**
 * Helper function to format numbers as currency.
 *
 * @param float $amount The number to format.
 * @param string $currencySymbol The currency symbol (default: '$').
 * @return string Formatted currency string.
 */
function mcp_format_currency($amount, $currencySymbol = '$') {
    return $currencySymbol . number_format($amount, 2);
}
