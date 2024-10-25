const servicesForm = document.querySelector('#form');
const contactForm = document.querySelector('#contact-form');
const errorMessages = document.querySelectorAll('.error');
const emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
let isValid = true;
const url = 'bootstrap.php'

const validationMessages = (field, errorMsg) => {
    if (field.type === 'tel' && !/^\d+$/.test(field.value)) {
        errorMsg.textContent = `Invalid ${field.placeholder}. Use numbers only.`;
        field.parentElement.querySelector('.error').classList.remove('hide');
        isValid = false;
    } else if (field.value.trim() === '') {
        errorMsg.textContent = `Please enter a valid ${field.placeholder || field.name}.`;
        field.parentElement.querySelector('.error').classList.remove('hide');
        isValid = false;
    } else if (field.type === 'text' && !/^[a-zA-Z0-9]+$/.test(field.value)) {
        errorMsg.textContent = `Only letters and numbers are allowed.`;
        field.parentElement.querySelector('.error').classList.remove('hide');
        isValid = false;
    } else if (field.type === 'email' && !emailRegex.test(field.value)) {
        errorMsg.textContent = `Please enter a valid email address.`;
        field.parentElement.querySelector('.error').classList.remove('hide');
        isValid = false;
    } else if (field.tagName === 'SELECT' && field.value === "") {
        errorMsg.textContent = `Please select a ${field.name}.`;
        field.parentElement.querySelector('.error').classList.remove('hide');
        isValid = false;
    } else if (field.tagName === 'TEXTAREA' && field.value.trim() === "") {
        errorMsg.textContent = `Please write a message.`;
        field.parentElement.querySelector('.error').classList.remove('hide');
        isValid = false;
    }
};

// Function to validate form fields
const checkFormFields = (...fields) => {
    isValid = true;
    errorMessages.forEach(msg => {
        msg.classList.add('hide');
        msg.querySelector('span').textContent = '';
    });

    fields.forEach(field => {
        const errorMsg = field.parentElement.querySelector('.error span');
        validationMessages(field, errorMsg);
    });

    return isValid;
};

// Function to validate a single field
const validateSingleField = (field) => {
    const errorMsg = field.parentElement.querySelector('.error span');

    errorMsg.textContent = '';
    field.parentElement.querySelector('.error').classList.add('hide');
    validationMessages(field, errorMsg);
    return isValid;
};

const submitFormToServer = async (url, payload) => {
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(payload)
        });

        if (!response.ok) {
            throw new Error(`Network error: ${response.statusText}`);
        }

        // const data = await response.json();
        const rawText = await response.text();
        console.log(rawText);
        const data = JSON.parse(rawText);

        if (data.status === 'success') {
            console.log('User added successfully.');
            console.log(data.message);
        } else {
            console.error('Failed to add user:', data.message);
        }
    } catch (error) {
        console.error('Error:', error.message);
    }
};

const formSubmissionSuccessMsg = (isFormValid, successMsg, successContainer, payload) => {
    if (isFormValid) {
        submitFormToServer(url, payload);
        successMsg.textContent = 'Form submitted successfully!';
        successContainer.classList.remove('hide');

        setTimeout(() => successContainer.classList.add('hide'), 1500);

        form.reset();
    }
};

servicesForm.querySelectorAll('input, select, textarea').forEach(field => {
    field.addEventListener('input', () => {
        validateSingleField(field);
    });
});

contactForm.querySelectorAll('input, select, textarea').forEach(field => {
    field.addEventListener('input', () => {
        validateSingleField(field);
    });
});

// Add event listener to handle form submission
servicesForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const successMsg = e.target.querySelector('.success span');
    const successContainer = e.target.querySelector('.success');
    const fullname = servicesForm.querySelector('#fname');
    const contactno = servicesForm.querySelector('input[name="cno"]');
    const zipcode = servicesForm.querySelector('input[name="zip"]');
    const services = servicesForm.querySelector('#service');
    const csrfToken = servicesForm.querySelector('#csrf_token_services');

    const isFormValid = checkFormFields(fullname, contactno, zipcode, services);

    const payload = {
        action   : "get_services",
        type: 'services',
        fullname : fullname.value,
        contactno : contactno.value,
        zipcode : zipcode.value,
        services : services.value,
        csrf_token : csrfToken.value,
    };

    formSubmissionSuccessMsg(isFormValid, successMsg, successContainer, payload);
});

// Add event listener to handle contact form submission
contactForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const successMsg = e.target.parentElement.querySelector('.success span');   
    const successContainer = e.target.parentElement.querySelector('.success');
    const fullname = contactForm.querySelector('#fullname');
    const contactno = contactForm.querySelector('input[name="contactno"]');
    const email = contactForm.querySelector('input[name="email"]');
    const country = contactForm.querySelector('#country');
    const message = contactForm.querySelector('#message');
    const csrfToken = contactForm.querySelector('#csrf_token_contact');

    const isFormValid = checkFormFields(fullname, contactno, email, country, message);

    const payload = {
        action   : "get_contacts",
        type: 'contact',
        fullname : fullname.value,
        contactno : contactno.value,
        email : email.value,
        country : country.value,
        message : message.value,
        csrf_token : csrfToken.value,
    };
    
    formSubmissionSuccessMsg(isFormValid, successMsg, successContainer, payload);
});

// 