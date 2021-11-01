import '../svg/svg-sprite.svg';
import header from "./modules/header";

const procedures = {
    mainProcedure() {
        // Load every action in header module
        header();
        events.on();
    }
}

const events = {
    on() {
        this.buttonAlertClicked();
    },
    buttonAlertClicked() {
        const buttonAlertElements = document.getElementsByClassName('button--alert');
        for (let i = 0; i < buttonAlertElements.length; i++) {
            buttonAlertElements[i].addEventListener('click', (event) => {
                if (!confirm('Are you sure that you want to perform this action?'))
                    event.preventDefault();
            })
        }
    }
}

procedures.mainProcedure();