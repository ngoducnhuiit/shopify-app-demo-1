<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // public function report(Throwable $e)
    // {
    //     parent::report($e);
    // }

    // public function render($request, Throwable $e)
    // {
    //     if($e instanceof \Osiset\ShopifyApp\Exceptions\MissingShopDomainException){
    //         return response()->view('login', [], 500);
    //     }
    //     return parent::render($request, $e);
    // }

    // public function report(Throwable $exception)
    // {
    //     parent::report($exception);
    // }

    // /**
    //  * Render an exception into an HTTP response.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \Throwable  $exception
    //  * @return \Symfony\Component\HttpFoundation\Response
    //  *
    //  * @throws \Throwable
    //  */
    // public function render($request, Throwable $exception)
    // {
    //     return parent::render($request, $exception);
    // }
}
