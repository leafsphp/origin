<?php

app()->redirect('/', '/auth/login');

app()->redirect('login', '/auth/login');
app()->redirect('register', '/auth/register');

app()::group('auth', fn() => \App\Controllers\AuthController::routes());