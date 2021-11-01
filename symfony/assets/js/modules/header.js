// Procedures for the header
const procedures = {
    mainProcedure() {
        events.on();
    }
}

// Events for the header
const events = {
    on() {
        events.userProfileClick();
    },
    userProfileClick() {
        const userProfileImage = document.getElementsByClassName('profile__icon');
        if (userProfileImage.length === 1) {
            userProfileImage[0].addEventListener('click', function () {
                const options = this.parentElement.getElementsByClassName('profile__options');
                options.length === 1 && options[0].classList.contains('hidden') ?
                    options[0].classList.remove('hidden') :
                    options[0].classList.add('hidden');
            })
        }
    },
}

export default function header() {
    procedures.mainProcedure();
}