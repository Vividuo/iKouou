<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //处理ajax请求
        if ($request->ajax() || $request->wantsJson()) {
            //当抛出验证异常时，设置错误信息为验证失败原因
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                $message = $exception->validator->errors()->first();
                $status = '422';
            } else if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                $message = '服务器资源找不到';
                $status = '404';
            } else if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
                $message = '当前用户没有访问权限';
                $status = '401';
            } else if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                $message = $exception->getMessage();
                $status = $exception->getStatusCode();
            } else {
                $message = get_class($exception).' '.$exception->getMessage();
                $status = '500';
            }

            return response()->json(['code' => $status, 'msg' => $message], '200');
        }
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
