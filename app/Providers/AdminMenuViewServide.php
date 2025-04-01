<?php

namespace App\Providers;

use App\Models\Admin\AdminMenus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use function PHPUnit\Framework\isNull;

class AdminMenuViewServide extends ServiceProvider
{
    private $selectedParentName = null;
    private $selectedChildName = null;
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        View::composer('admin.layout.default', function ($view) {
            // 현재 로그인한 사용자 가져오기
            $user = Auth::user();
            $routeParts = explode('.', Route::currentRouteName());
            $currentRouteName = array_slice($routeParts, 1, 1)[0] ?? null;
            $this->selectedParentName = null;
            $this->selectedChildName = null;


            //메뉴 가져오기
            $menus = AdminMenus::where('level' , '<=', $user->level)->whereNull('parent_id')->with('children')->orderBy('sort_order')->get();

            // 현재 Route Name과 비교하여 활성화 상태 추가
            foreach ($menus as $menu) {
                $menu->active = (empty($currentRouteName) && !empty($menu->url)) || (!empty($currentRouteName) && !empty($menu->url) && preg_match("/\b" . preg_quote($currentRouteName, '/') . "\b/u", $menu->url));
                foreach ($menu->children as $child) {
                    $child->active = !empty($currentRouteName) && preg_match("/\b" . preg_quote($currentRouteName, '/') . "\b/u", $child->url);
                    if ($child->active) {
                        $menu->active = true; // 자식이 활성화되면 부모도 활성화
                        $this->selectedParentName   = $menu->name; // 부모 메뉴명 저장
                        $this->selectedChildName    = $child->name; // 자식 메뉴명 저장
                    }
                }
                if ($menu->active && !$this->selectedParentName) {
                    $this->selectedParentName = $menu->name; // 부모가 직접 선택된 경우
                }
            }
            $view->with([
                'menus'             => $menus,
                'selectedParentName'=> $this->selectedParentName,
                'selectedChildName' => $this->selectedChildName
            ]);
        });
    }

}
