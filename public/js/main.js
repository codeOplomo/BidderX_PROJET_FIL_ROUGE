
$(document).ready(function() {

    console.log('jQuery and main.js are loaded');
    $('#register-form').validate({
        rules: {
            name: {
                required : true,
                minlength : 5,
                maxlength : 70
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                equalTo: "#password"
            }
        },
        messages: {
            name: "Please enter a valid name",
            email: "Please enter a valid email address",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long"
            },
            password_confirmation: "Enter confirm password same as password"
        },
        submitHandler: function(form) {
            // If you reach this point, the form is valid.
            form.submit(); // Submit the form
        }

    });
});

