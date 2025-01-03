// admin-script.js

jQuery(document).ready(function ($) {
    // Example: Alert when submitting the form
    $('form').on('submit', function (e) {
        alert('Settings have been saved successfully!');
    });

    // Example: Validate input values
    $('input[type="number"]').on('input', function () {
        var value = parseFloat($(this).val());
        if (value < 0) {
            alert('Please enter a positive value.');
            $(this).val('');
        }
    });
});
