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

function submitForm(formId, successHandler = null, buttonId = null, buttonLabel = 'Submit') {

    $(formId).submit(function(e) {

        e.preventDefault();
        const form = $(this);
        
        // Only change button state if buttonId is provided
        if (buttonId) {
            buttonState(buttonId, 'loading');
        }
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    toast.success({ message: response.message ?? 'Form submitted succesfully' });
                    
                    // If a custom success handler is provided, call it
                    if (typeof successHandler === 'function') {
                        successHandler(response);
                    }

                } else {
                    toast.error({ message: response.message ?? 'An error occurred' });
                }
            },
            error: function() {
                toast.error({ message: 'Unknown Error Occurred' });
            },
            complete: function() {
                // Reset button state if buttonId is provided
                if (buttonId) {
                    buttonState(buttonId, 'reset', buttonLabel);
                }
            }
        });
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