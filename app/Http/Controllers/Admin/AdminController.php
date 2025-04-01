<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * name      : AdminIndex
     * author    : HDH
     * date      : 2025/02/20  3:41 PM
     * description : admin index 뷰
     * --------------------------------------------------------
     * @param Request $request
     * @return View
     * --------------------------------------------------------
     */
    public function AdminIndex(Request $request) : View
    {
        return view('admin.index');
    }

    /**
     * name      : AdminLogin
     * author    : HDH
     * date      : 2025/02/20  3:41 PM
     * description : admin 로그인 뷰
     * --------------------------------------------------------
     * @param Request $request
     * @return View
     * --------------------------------------------------------
     */
    public function AdminLogin(Request $request) : View
    {
        return view('admin.auth.login');
    }

    /**
     * name      : AdminLogOut
     * author    : HDH
     * date      : 2025/02/20  3:41 PM
     * description : admin 로그아웃 처리
     * --------------------------------------------------------
     * @param Request $request
     * @return RedirectResponse
     * --------------------------------------------------------
     */
    public function AdminLogOut(Request $request) : RedirectResponse
    {
        Auth::guard('web')->logout();         //로그아웃
        $request->session()->invalidate();          //세션 무효화
        $request->session()->regenerateToken();     // csrf 토크 새로 생성
        return redirect()->route('admin.login');
    }

}
