function validateForm() {
    email = $("input[name='email']").val();
    if (checkIfemailIsValid(email) && !checkIfemailComesFromColombia(email) && $("input[name='terms']").is(':checked')) {
        $('#emailError').text(' ');
        $('#termError').text(' ');
        return true;
    }
    else {
        if (email.length == 0) {
            $('#emailError').text('Email address is required');
        }
        if (!checkIfemailIsValid(email) && email.length != 0) {
            $('#emailError').text('Please provide a valid e-mail address');
        }
        if (checkIfemailComesFromColombia(email)) {
            $('#emailError').text('We are not accepting subscriptions from Colombia emails');
        }
        if (!$("input[name='terms']").is(':checked')) {
            $('#termError').text('You must accept the terms and conditions');
        }
        $('button[type="submit"]').attr('disabled', 'disabled');
        return false;
    }


}

// event listener to check if everything in form is valid then removes attribute disabled from button
$("form[name='submitingEmail']").on('input', function () {
    email = $("input[name='email']").val();
    if (checkIfemailIsValid(email) && !checkIfemailComesFromColombia(email) && $("input[name='terms']").is(':checked')) {
        $('button[type="submit"]').removeAttr("disabled");
    }
})

// event listener on input fiel and checks if email is valid and not from colombia
$("input[name='email']").on('input', function () {
    email = $(this).val()
    if (!checkIfemailIsValid(email)) {
        $('#emailError').text('Please provide a valid e-mail address');
    }
    else if (checkIfemailComesFromColombia(email)) {
        $('#emailError').text('We are not accepting subscriptions from Colombia emails');
    }
    else if (checkIfemailIsValid(email)) {
        $('#emailError').text(' ');
    }
});

// event listener on checkt box if it is checked remove error 
$("input[name='terms']").on('change', function () {
    if (!$("input[name='terms']").is(':checked')) {
        $('#termError').text('You must accept the terms and conditions');
    }
    if ($("input[name='terms']").is(':checked')) {
        $('#termError').text(' ');
    }
})


// check if email is valid  and if it is returns TRUE 
function checkIfemailIsValid(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

// check if email is from colombia if it is function returns TRUE 
function checkIfemailComesFromColombia(email) {
    var re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.+-]+\.co$/;
    return re.test(email)
}

