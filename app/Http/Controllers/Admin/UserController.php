<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Toastr;


class UserController extends BaseController
{

    /**
     * UserController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseView('user');
        $this->addBaseRoute('user');
    }

    /**
     * List users
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = new User();
        if ($request->has('name')) {
            $users = $users->where(function ($query) use($request) {
                $query->where('first_name', 'LIKE', '%'.$request->name.'%')
                ->orWhere('last_name', 'LIKE', '%'.$request->name.'%');
            });
        }
        if ($request->has('status') && '' != $request->status) {
            $users = $users->where('status', $request->status);
        }
        $users = $users->get();
        return $this->renderView($this->getView('index'), compact('users'), 'User List');
    }

    /**
     * Show form to edit user
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return $this->renderView($this->getView('edit'), compact('user'), 'Edit User');
    }

    

    /**
     * Update user
     *
     * @param UserUpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);
        Toastr::success('User updated successfully');
        return redirect()->route($this->getRoute('index'));
    }

    /**
     * Delete user
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return Response::json(['success' => 'User deleted successfully']);
    }

    public function activeuser($id)
    {
        $data=User::find($id);
        $data->status='1';
        $data->save();
        return redirect()->back()->with(['success' => 'User is activated Successfully!']);
    }

    public function Inactiveuser($id)
    {
        $data=User::find($id);
        $data->status='0';
        $data->save();
        return redirect()->back()->with(['success' => 'User is deactivated Successfully!']);
    }

}
