// Get the form and button elements
const form = document.getElementById('contact-form');
const submitButton = document.getElementById('form_btn');

// Function to validate form fields
const check_form_fields = (...fields) => {
    let isValid = true;

    fields.forEach(field => {
        if (field.type === 'email' && !validateEmail(field.value)) {
            alert(`Invalid email: ${field.placeholder}`);
            isValid = false;
        } else if (field.type === 'tel' && !/^\d+$/.test(field.value)) {
            alert(`Invalid contact number: ${field.placeholder}`);
            isValid = false;
        } else if (field.value.trim() === '') {
            alert(`Please fill out the ${field.placeholder} field.`);
            isValid = false;
        }
    });

    return isValid;
};

// Helper function to validate email format
const validateEmail = (email) => {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
};

// Add event listener to handle form submission
submitButton.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent default form submission

    const fullname = document.getElementById('fullname');
    const contactno = document.querySelector('input[name="contactno"]');
    const email = document.querySelector('input[name="email"]');
    const country = document.getElementById('country');
    const message = document.getElementById('message');

    const isFormValid = check_form_fields(fullname, contactno, email, country, message);

    if (isFormValid) {
        alert('Form submitted successfully!');
        form.submit(); // Submit the form if all fields are valid
    }
});
