<?php


namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BaseController extends Controller
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth:doctor');
        $this->_view = 'pages.doctor.';
        $this->addBaseRoute('doctor.');
    }

    /**
     * Get Logged User Id
     *
     * @return object
     */
    protected function getLoggedUserId()
    {
        return auth()->user()->id;
    }
}
