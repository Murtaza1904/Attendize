<?php

namespace App\Exceptions;

use App\Mail\ServerErrorMail;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        if (config('app.env') == 'production') {
            Mail::to(env('ERROR_MAIL_TO'))
                ->cc(env('ERROR_MAIL_CC'))
                ->send(new ServerErrorMail([$exception->getMessage(), $exception->getFile().':'.$exception->getLine()]));
        }

        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}
