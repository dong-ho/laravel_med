<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminMenus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminMenuController extends Controller
{
    protected $baseRouteName = 'admin.menu';

    /**
     * name      : List
     * author    : HDH
     * date      : 2025/03/10  6:19 PM
     * description : 관리자 메뉴 리스트 뷰
     * --------------------------------------------------------
     * @return View
     * --------------------------------------------------------
     */
    public function List() : View
    {
        $lists = AdminMenus::whereNull('parent_id')
                ->with(['children' => function ($query) {
                    $query->orderBy('sort_order', 'asc');
                }])
                ->orderBy('sort_order', 'asc')
                ->get();
        return view($this->baseRouteName.'.list',compact('lists'));
    }

    /**
     * name      : Add
     * author    : HDH
     * date      : 2025/03/10  6:19 PM
     * description : 관리자 메뉴 추가 뷰
     * --------------------------------------------------------
     * @return View
     * --------------------------------------------------------
     */
    public function Add() : view
    {
        $parentLists = AdminMenus::parentLists();
        return view($this->baseRouteName.'.add',compact('parentLists'));
    }

    /**
     * name      : Store
     * author    : HDH
     * date      : 2025/03/10  6:19 PM
     * description : 관리자 메뉴 추가 처리
     * --------------------------------------------------------
     * @param Request $request
     * @return RedirectResponse
     * --------------------------------------------------------
     */
    public function Store(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
           'name'       => 'required|min:2'
        ],['name.required' => '메뉴명 필드는 필수 입력 입니다.']);

        /**
         * 대량 할당 방법
         */
        AdminMenus::create([
            'name'          => trim($request->name),
            'parent_id'     => !empty($request->parent_id)?$request->parent_id:null,
            'url'           => trim($request->url),
            'icon'          => trim($request->icon),
            'level'         => trim($request->level),
            'sort_order'    => trim($request->sort_order),
        ]);

        /**
         * 개별 할당 방법
         */
        /*$storeData = new AdminMenus;
        $storeData->name        = trim($request->name);
        $storeData->parent_id   = !empty($request->parent_id)?$request->parent_id:null;
        $storeData->url         = trim($request->url);
        $storeData->icon        = trim($request->icon);
        $storeData->level       = trim($request->level);
        $storeData->sort_order  = trim($request->sort_order);
        $storeData->save();*/


        return to_route($this->baseRouteName)->with('processMessage','자료가 추가 되었습니다.');
    }

    /**
     * name      : Edit
     * author    : HDH
     * date      : 2025/03/10  6:19 PM
     * description : 관리자 메뉴 수정 뷰
     * --------------------------------------------------------
     * @param $id
     * @return View
     * --------------------------------------------------------
     */
    public function Edit($id) : view
    {
        $list = AdminMenus::find($id);
        $parentLists = AdminMenus::parentLists();
        return view($this->baseRouteName.'.edit' , compact(['list','parentLists']));
    }

    /**
     * name      : Update
     * author    : HDH
     * date      : 2025/03/10  6:19 PM
     * description : 관리자 메뉴 수정 처리
     * --------------------------------------------------------
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     * --------------------------------------------------------
     */
    public function Update($id, Request $request) : RedirectResponse
    {

        $validated = $request->validate([
            'name'       => 'required|min:2',
            'parent_id'  => Rule::notIn([$id]),
        ],['name.required' => '메뉴명 필드는 필수 입력 입니다.','parent_id' => '자신이 아닌 메뉴를 선택해 주세요']);

        /**
         * 대량 할당 방법
         */

        $adminMenu = AdminMenus::find($id);
        if(!$adminMenu) return redirect(to_route($this->baseRouteName)->with('errorMessage','업데이트 할 자료가 없습니다.'));
        AdminMenus::where('id',$id)->update([
            'name'          => trim($request->name),
            'parent_id'     => !empty($request->parent_id)?$request->parent_id:null,
            'url'           => trim($request->url),
            'icon'          => trim($request->icon),
            'level'         => trim($request->level),
            'sort_order'    => trim($request->sort_order),
        ]);


        /**
         * 개별 할당 방법
         */
        /*
        $updateData = AdminMenus::find($id);
        $updateData->name        = trim($request->name);
        $updateData->parent_id   = !empty($request->parent_id)?$request->parent_id:null;
        $updateData->url         = trim($request->url);
        $updateData->icon        = trim($request->icon);
        $updateData->level       = trim($request->level);
        $updateData->sort_order  = trim($request->sort_order);
        $updateData->save();*/

        return to_route($this->baseRouteName)->with('processMessage','자료가 업데이트 되었습니다.');
    }

    /**
     * name      : Delete
     * author    : HDH
     * date      : 2025/03/10  6:19 PM
     * description : 관리자 메뉴 삭제 처리
     * --------------------------------------------------------
     * @param $id
     * @return RedirectResponse
     * --------------------------------------------------------
     */
    public function Delete($id) : RedirectResponse
    {
        $deleteData = AdminMenus::find($id);
        if(!$deleteData) return redirect(to_route($this->baseRouteName)->with('errorMessage','삭제 할 자료가 없습니다.'));
        $deleteData->delete();
        return to_route($this->baseRouteName)->with('processMessage','자료가 삭제 되었습니다.');
    }
}
