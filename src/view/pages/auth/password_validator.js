const passInput = document.getElementById(passInputId);
const passConfInput = document.getElementById(passConfInputId);

function validarPassword() {
    const pass = passInput.value;

    if (pass.length < 8) {
        passInput.setCustomValidity('La contraseña debe tener al menos 8 caracteres.');
        return;
    }
    if (!/[A-Z]/.test(pass)) {
        passInput.setCustomValidity('La contraseña debe tener al menos una mayúscula.');
        return;
    }
    if (!/[0-9]/.test(pass)) {
        passInput.setCustomValidity('La contraseña debe tener al menos un número.');
        return;
    }

    passInput.setCustomValidity('');
}

function validarCoincidencia() {
    if (passConfInput.value !== passInput.value) {
        passConfInput.setCustomValidity('Las contraseñas no coinciden.');
    } else {
        passConfInput.setCustomValidity('');
    }
}

passInput.addEventListener('input', function () {
    validarPassword();
    if (passConfInput.value) {
        validarCoincidencia();
    }
});

passConfInput.addEventListener('input', validarCoincidencia);

