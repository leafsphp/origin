<?php

use App\Helpers\MailTool;

app()->redirect('/', '/auth/login');

app()->redirect('login', '/auth/login');
app()->redirect('register', '/auth/register');

app()->get('test', function() {
    $mail = new MailTool();
    $mail->sendHtml(
        'Test Reset Email', 
        view('mails.reset', [
            'name' => 'Abdulbasit Rubeya',
            'token' => 'testToken'
        ]),
        'abdulbasitsultan4@gmail.com', 'Abdulbasit Sultan'
    );
});

app()::group('auth', fn() => \App\Controllers\AuthController::routes());