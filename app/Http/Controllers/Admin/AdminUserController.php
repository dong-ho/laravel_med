<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    protected $baseRouteName = 'admin.user';

    /**
     * name      : List
     * author    : HDH
     * date      : 2025/03/05  3:05 PM자
     * description : 사용자 리스트 뷰
     * --------------------------------------------------------
     * @return View
     * --------------------------------------------------------
     */
    public function List() : View
    {
        $lists = User::getUser();
        return view($this->baseRouteName.'.list',compact('lists'));
    }

    /**
     * name      : Add
     * author    : HDH
     * date      : 2025/03/05  3:05 PM
     * description : 사용자 추가 뷰
     * --------------------------------------------------------
     * @return View
     * --------------------------------------------------------
     */
    public function Add() : view
    {
        return view($this->baseRouteName.'.add');
    }

    /**
     * name      : Store
     * author    : HDH
     * date      : 2025/03/05  3:05 PM
     * description : 사용자 추가 저장
     * --------------------------------------------------------
     * @param Request $request
     * @return RedirectResponse
     * --------------------------------------------------------
     */
    public function Store(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'email'             => 'required|email|unique:users,email',
            'name'              => 'required|min:2',
            'password'          => 'required|min:4|required_with:password_confirm|same:password_confirm',
            'password_confirm'  => 'min:4',
            'status'            => 'required',
            'level'             => 'required',
        ]);

        $storeData = new User;
        $storeData->name                = trim($request->name);
        $storeData->email               = trim($request->email);
        $storeData->password            = Hash::make(trim($request->password));
        $storeData->role                = "user";
        $storeData->email_verified_at   = now();
        $storeData->status              = trim($request->status);
        $storeData->level               = trim($request->level);

        if($request->hasFile('photo')){
            $fileName = $request->file('photo')->store('profile');
            if(!empty($user->photo) && file_exists(storage_path('app/public/'.$user->photo))) {
                File::delete(storage_path('app/public/'.$user->photo));
            }
            $storeData->photo = $fileName;
        }

        $storeData->save();
        return to_route($this->baseRouteName)->with('processMessage','자료가 추가 되었습니다.');
    }

    /**
     * name      : Edit
     * author    : HDH
     * date      : 2025/03/05  3:05 PM
     * description : 사용자 수정 뷰
     * --------------------------------------------------------
     * @param $id
     * @return View
     * --------------------------------------------------------
     */
    public function Edit($id) : View
    {
        $list = User::findOrFail($id);
        return view($this->baseRouteName.'.edit' , compact('list'));
    }

    /**
     * name      : Update
     * author    : HDH
     * date      : 2025/03/05  3:05 PM
     * description : 사용자 수정 저장
     * --------------------------------------------------------
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     * --------------------------------------------------------
     */
    public function Update($id, Request $request) : RedirectResponse
    {
        $updateData = User::findOrFail($id);
        $validated = $request->validate([
            'name'              => 'required|min:2',
            'password'          => 'nullable|min:4|required_with:password_confirm|same:password_confirm',
            'password_confirm'  => 'nullable|min:4',
            'status'            => 'required',
            'level'             => 'required',
        ]);

        $updateData->name                = trim($request->name);
        $updateData->status              = trim($request->status);
        $updateData->level               = trim($request->level);
        if(!empty($request->password)) $updateData->password = Hash::make($request->password);
        if($request->hasFile('photo')){
            $fileName = $request->file('photo')->store('profile');
            if(!empty($user->photo) && file_exists(storage_path('app/public/'.$user->photo))) {
                File::delete(storage_path('app/public/'.$user->photo));
            }
            $updateData->photo = $fileName;
        }
        $updateData->save();
        return to_route($this->baseRouteName, $request->query())->with('processMessage','자료가 업데이트 되었습니다.');
    }

    /**
     * name      : Delete
     * author    : HDH
     * date      : 2025/03/05  3:05 PM
     * description : 사용자 삭제
     * --------------------------------------------------------
     * @param $id
     * @return RedirectResponse
     * --------------------------------------------------------
     */
    public function Delete($id) : RedirectResponse
    {
        $deleteData = User::findOrFail($id);
        if(!empty($deleteData->photo) && file_exists(storage_path('app/public/'.$deleteData->photo))){
            File::delete(storage_path('app/public/'.$deleteData->photo));
        }
        $deleteData->delete();
        return to_route($this->baseRouteName, request()->query())->with('processMessage','자료가 삭제 되었습니다.');
    }

    /**
     * name      : PhotoDelete
     * author    : HDH
     * date      : 2025/03/05  3:05 PM
     * description : 사용자 사진 삭제
     * --------------------------------------------------------
     * @param Request $request
     * @return JsonResponse
     * --------------------------------------------------------
     */
    public function PhotoDelete(Request $request) : JsonResponse
    {
        $user = User::find($request->id);
        if(!empty($user->photo) && file_exists(storage_path('app/public/'.$user->photo))){
            File::delete(storage_path('app/public/'.$user->photo));
            $user->photo = '';
            $user->save();
            Session::regenerateToken();
            return response()->json(['processMessage'=>'파일이 삭제 되었습니다.','token' => csrf_token()]);
        }
        else {
            return response()->json(['processMessage'=>'삭제할 파일이 없습니다.','token' => csrf_token()]);
        }
    }
}
