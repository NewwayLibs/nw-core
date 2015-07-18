<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
            HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {

        $this->_trackException($e);

        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {

        return parent::render($request, $e);
    }

    /**
     * @param Exception $e
     */
    private function _trackException(Exception $e)
    {

        $list = Config::get('track.emails', []);

        if (count($list) !== 0) {

            Mail::send(
                    'emails.exception',
                    array('url' => Request::url(), 'exception' => $e->getMessage()),
                    function ($message) use ($e, $list) {

                        foreach ($list as $email) {

                            $message->to($email, '')->subject(Config::get('app.name') . ': Error ' . $e->getCode());
                        }

                    }
            );
        }


    }
}
