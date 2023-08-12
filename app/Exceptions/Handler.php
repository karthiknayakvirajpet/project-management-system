<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    //Customized 403 page
    public function render($request, Throwable $exception)
    {
        //403 custom error page
        if ($exception instanceof HttpException && $exception->getStatusCode() === 403) {
            return response()->view('errors.403', [], 403);
        }

        //Sanctum Unauthorized rendering for APIs
        $this->renderable(function (\Illuminate\Auth\AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 401, 
                    'message' => 'Unauthorized - Note: Please use "login" API and set the "Authorization" header with the value "Bearer {access_token}" received during the login process.',
                ])->setStatusCode(401);
            }
        });

        return parent::render($request, $exception);
    }
}
