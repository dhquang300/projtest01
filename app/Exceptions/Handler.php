<?php

namespace App\Exceptions;

use App\Utils\ResponseUtil;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
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
        ValidationException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }
    
    
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
   
//     public function render($request, Exception $e)
//     {
//        $e = $this->prepareException($e);
    
// //         if ($e instanceof HttpResponseException) {
// //             return $e->getResponse();
// //         } elseif ($e instanceof AuthenticationException) {
// //             return $this->unauthenticated($request, $e);
// //         }
//         if ($e instanceof ValidationException) {
//             return $this->convertValidationExceptionToResponse($e, $request);
//         }
    
//         return $this->prepareResponse($request, $e);
//     }
    
    /**
     * Prepare exception for rendering.
     *
     * @param  \Exception  $e
     * @return \Exception
     */
//     protected function prepareException(Exception $e)
//     {
//         if ($e instanceof ModelNotFoundException) {
//             $e = new NotFoundHttpException($e->getMessage(), $e);
//         } elseif ($e instanceof AuthorizationException) {
//             $e = new AccessDeniedHttpException($e->getMessage(), $e);
//         } elseif ($e instanceof TokenMismatchException) {
//             $e = new HttpException(419, $e->getMessage(), $e);
//         } elseif ($e instanceof ValidationException) {
//             $e = new HttpException(422, $e->getMessage(), $e);
//         }
//         return $e;
//     }
    /**
     * 
     * @param ValidationException $e
     * @param unknown $request
     */
//     protected function convertValidationExceptionToResponse(ValidationException $e, $request){
//         $error = $e->validator->error()->getMessage();
//         if($request->expectsJson()){
//             return response()->json($error,422);
//         }
//         return redirect()->back()->withInput($request->input())->withError($error);
//     }
    
//     protected function unauthenticated($request, AuthenticationException $e){
        
//         if($request->expectsJson()){
//             return response()->json(['error'=>'Unauthenticated'],401);
//         }
//         return redirect()->guest('login');
//     }
}
