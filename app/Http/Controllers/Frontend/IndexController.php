<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * Class IndexController
 * @package App\Http\Controllers\Frontend
 */
class IndexController extends Controller
{

    public $_theme = 'default';

    public function index()
    {
        return view('hello');
    }

}
