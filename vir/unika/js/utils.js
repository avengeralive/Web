
'use strict';

// Fields Classes
var formName = '.form-name';
var formEmail = '.form-email';
var formMessage = '.form-message';
var nlEmail = '.nl-email';


function onBlurValidator(formName, formEmail, formMessage) {

    $(formName).on('blur', function() {
        validateName(formName);
    });

    $(formEmail).on('blur', function() {
        validateEmail(formEmail);
    });

    $(formMessage).on('blur', function() {
        validateMessage(formMessage);
    });
}

/**
 * Validate All Fields
 * @return true if is valid
 */
function validateContact(formName, formEmail, formMessage) {
    var valid = true;

    // Check Data
    valid = validateName(formName) & validateEmail(formEmail) & validateMessage(formMessage);

    return valid;
}

/**
 * Validate Name Field
 * @return true if is valid
 */
function validateName(formName) {
    var valid = true;

    if( !$(formName).val() ) {
        $(formName).css('border-color','#d9534f');
        valid = false;
    } else {
        $(formName).css('border-color','#40D900');
    }

    return valid;
}

/**
 * Validate Email Field
 * @return true if is valid
 */
function validateEmail(formEmail) {
    var valid = true;

    if(!$(formEmail).val()) {
        $(formEmail).css('border-color','#d9534f');
        valid = false;
    } else {
        $(formEmail).css('border-color','#40D900');
    }

    if(!$(formEmail).val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
        $(formEmail).css('border-color','#d9534f');
        valid = false;
    }

    return valid;
}

/**
 * Validate Message Field
 * @return true if is valid
 */
function validateMessage(formMessage) {
    var valid = true;

    if(!$(formMessage).val()) {
        $(formMessage).css('border-color','#d9534f');
        valid = false;
    } else {
        $(formMessage).css('border-color','#40D900');
    }
    
    return valid;
}

/**
 * Empty Form Fields After Submit For New Input
 */
function emptyFields(formName, formEmail, formMessage) {

    // Empty Fields
    $(formName).val('');
    $(formEmail).val('');
    $(formMessage).val('');

    // Set Default Styles
    $(formName).css('border-color','#D0D0D0');
    $(formEmail).css('border-color','#D0D0D0');
    $(formMessage).css('border-color','#D0D0D0');
}