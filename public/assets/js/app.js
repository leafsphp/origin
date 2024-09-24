// Event Listeners
$('.togglePassword').click(function() {
    $(this).toggleClass('ph-eye').toggleClass('ph-eye-slash');
    var input = $($(this).prev('input'));
    if (input.attr('type') === 'password') {
        input.attr('type', 'text');
    } else {
        input.attr('type', 'password');
    }
});

// Global Functions
function buttonState(button, state, initialText=null) {

    button = $(button);

    if (state === 'loading') {
        button.attr('disabled', true);
        button.html('<i class="ph-duotone ph-circle-notch ph-spin"></i>');
    } else {
        button.attr('disabled', false);
        button.html(initialText);
    }
}


function underDevelopment(){
    // prevent default action
    event.preventDefault();

    Swal.fire({
        title: 'Under Development',
        text: 'This feature is under development and will be available soon.',
        icon: 'info',
        confirmButtonText: 'OK'
    });
}


// Styles and Scripts Injection
function injectStylesheet(url) {
    var link = document.createElement('link');
    link.rel = 'stylesheet';
    link.type = 'text/css';
    link.href = url;
    document.head.appendChild(link);
}

function injectScript(url) {
    return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = url;
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });
}

function copyToClipboard(text) {
    var input = document.createElement('input');
    input.value = text;
    document.body.appendChild(input);
    input.select();
    document.execCommand('copy');
    document.body.removeChild(input);
}

function submitForm(event, responseHandler = null){ //, buttonId = null, buttonLabel = 'Submit') {
    event.preventDefault(); // Prevent the default form submission

    const form = $(event.target); // Get the form element
    const isMultipart = form.attr('enctype') === 'multipart/form-data'; // Check if it's a multipart form

    // Create a FormData object if multipart, else serialize the form
    let formData;
    if (isMultipart) {
        formData = new FormData(event.target);
    } else {
        formData = form.serialize();
    }

    // find the submit button
    const submitButton = form.find('button[type="submit"]');
    const buttonLabel = submitButton.html() ?? null;
    
    if (submitButton) {
        buttonState(submitButton, 'loading');
    }

    $.ajax({
        url: form.attr('action'),
        method: form.attr('method') ?? 'POST',
        data: formData,
        processData: !isMultipart, // Don't process the data if it's multipart (FormData handles that)
        contentType: isMultipart ? false : 'application/x-www-form-urlencoded; charset=UTF-8', // Set content type accordingly
        success: function(response) {
            if (responseHandler && typeof responseHandler === 'function') {
                responseHandler(response);
            }else{
                if (response.status) {
                    toast.success({ message: response.message });
                }else{
                    toast.error({ message: response.message });
                }
            }
        },
        error: function() {
            toast.error({ message: 'Unknown Error Occurred' });
        },
        complete: function() {
            // Reset button state if buttonId is provided
            if (submitButton) {
                buttonState(submitButton, 'reset', buttonLabel);
            }
        }
    });
}

// initializers and settings
const toast = iziToast;
toast.settings({
    timeout: 1500,
    transitionIn: 'fadeInDown',
    transitionOut: 'fadeOutUp',
    position: 'bottomCenter',
    close: true,
    progressBar: true,
    pauseOnHover: true
});

$(document).ready(function() {

    // listent to all .fs-* classes and assign font-size dynamically
    $('[class*="fs-"]').each(function() {
        var classes = $(this).attr('class').split(' ');
        var fontSize = classes.find(c => c.startsWith('fs-'));
        var size = fontSize.split('-')[1];
        $(this).css('font-size', size + 'px');
    });

});