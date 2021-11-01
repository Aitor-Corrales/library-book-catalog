const messages = {
    validations: {
        emailFormatFailed: 'The format of the email is not correct',
        securePasswordFailed: 'The password must have a number, a lowercase and an uppercase letter',
        repeatedPasswordFailed: 'The 2 password fields must be identical.',
    }
}

const procedures = {
    mainProcedure() {
        events.validateOnSubmit();
    },
    cleanValidationErrorMessages() {
        let validationErrors = document.getElementsByClassName('validation_failed');
        for (let i = 0; i < validationErrors.length; i++) {
            validationErrors[i].innerHTML = '';
            if (!validationErrors[i].classList.contains('hidden'))
                validationErrors[i].classList.add('hidden');
        }
    },
}

const events = {
    validateOnSubmit() {
        document.addEventListener('submit', function (event) {
            procedures.cleanValidationErrorMessages();
            const validationsPassed = functions.validations.emailValidations.validate(this) &&
                functions.validations.passwordValidations.validate(this) &&
                functions.validations.repeatedPasswordValidation.validate(this);
            !validationsPassed ? event.preventDefault() : '';
        })
    },
}

const functions = {
    validations: {
        emailValidations: {
            // Passes every email validator
            validate(context) {
                let validationsPassed = true;
                const toValidateEmailFields = context.getElementsByClassName('email_validation');
                if (toValidateEmailFields.length)
                    for (let i = 0; i < toValidateEmailFields.length; i++)
                        if (!this.correctFormatEmailValidator(toValidateEmailFields[0])) {
                            validationsPassed = false;
                            break;
                        }
                return validationsPassed;
            },
            // Validates the correct format from an email
            correctFormatEmailValidator(emailElement) {
                let correctEmailFormat = true;
                const regExp = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (!regExp.test(emailElement.value.toLowerCase())) {
                    correctEmailFormat = false;
                    let validationFailedElement = emailElement.parentElement.getElementsByClassName('email_validation_failed');
                    if (validationFailedElement.length === 1) {
                        validationFailedElement[0].innerHTML = messages.validations.emailFormatFailed;
                        if (validationFailedElement[0].classList.contains('hidden'))
                            validationFailedElement[0].classList.remove('hidden');
                    }
                }
                return correctEmailFormat;
            },
        },
        passwordValidations: {
            validate(context) {
                let validationsPassed = true;
                const toValidatePasswordFields = context.getElementsByClassName('password_validation');
                if (toValidatePasswordFields.length)
                    for (let i = 0; i < toValidatePasswordFields.length; i++)
                        if (!this.securePasswordValidate(toValidatePasswordFields[0])) {
                            validationsPassed = false;
                            let validationFailedElement = toValidatePasswordFields[0].parentElement.getElementsByClassName('password_validation_failed');
                            if (validationFailedElement.length) {
                                validationFailedElement[0].innerHTML = messages.validations.securePasswordFailed;
                                if (validationFailedElement[0].classList.contains('hidden'))
                                    validationFailedElement[0].classList.remove('hidden');
                            }
                            break;
                        }
                return validationsPassed;
            },
            // Validates if the password is strong enough
            securePasswordValidate(passwordElement) {
                return /[a-z]/.test(passwordElement.value) &&
                    /[A-Z]/.test(passwordElement.value) &&
                    /[0-9]/.test(passwordElement.value);
            },
        },
        repeatedPasswordValidation: {
            validate(context) {
                let repeatedPasswordValidation = true;
                const toValidatePasswordField = context.getElementsByClassName('password_validation');
                const toValidateRepeatedPasswordField = context.getElementsByClassName('repeat_password_validation');
                if (toValidatePasswordField.length === 1 && toValidateRepeatedPasswordField.length === 1)
                    if (toValidatePasswordField[0].value !== toValidateRepeatedPasswordField[0].value) {
                        let validationFailedElement = toValidateRepeatedPasswordField[0].parentElement.getElementsByClassName('repeat_password_validation_failed');
                        if (validationFailedElement.length) {
                            validationFailedElement[0].innerHTML = messages.validations.repeatedPasswordFailed;
                            if (validationFailedElement[0].classList.contains('hidden'))
                                validationFailedElement[0].classList.remove('hidden');
                        }
                        repeatedPasswordValidation = false;
                    }
                return repeatedPasswordValidation;
            }
        },
    }
}

procedures.mainProcedure();