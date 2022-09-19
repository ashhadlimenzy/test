<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BaseController extends Controller
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth:user');
        $this->_view = 'pages.user.';
        $this->addBaseRoute('user.');
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
