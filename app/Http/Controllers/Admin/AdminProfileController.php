<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AdminProfileController extends Controller
{

    /**
     * name      : Profile
     * author    : HDH
     * date      : 2025/02/20  2:00 PM
     * description : 프로필 수정 뷰
     * --------------------------------------------------------
     * @param Request $request
     * @return View
     * --------------------------------------------------------
     */
    public function Profile(Request $request) : View
    {
        $adminUser  = User::find(Auth::user()->id);
        return view('admin.profile.profile',compact('adminUser'));
    }

    /**
     * name      : ProfileUpdate
     * author    : HDH
     * date      : 2025/02/20  2:00 PM
     * description : 프로필 업데이트
     * --------------------------------------------------------
     * @param Request $request
     * @return RedirectResponse
     * --------------------------------------------------------
     */
    public function ProfileUpdate(Request $request) : RedirectResponse
    {
        $user = User::find(Auth::user()->id);
        $user->name = trim($request->name);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        if($request->hasFile('photo')){
            $fileName = $request->file('photo')->store('profile');
            if(!empty($user->photo) && file_exists(storage_path('app/public/'.$user->photo))) {
                File::delete(storage_path('app/public/'.$user->photo));
            }
            $user->photo = $fileName;
        }
        $user->save();
        return redirect()->route('admin.profile.edit')->with('processMessage','정상적으로 업데이트 되었습니다.');
    }

    /**
     * name      : PhotoDelete
     * author    : HDH
     * date      : 2025/02/20  2:00 PM
     * description : 프로필 이미지 삭제
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
