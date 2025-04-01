<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Node\Scalar\String_;

class AdminMenus extends Model
{
    use HasFactory;

    protected $table = 'admin_menus';

    protected $fillable = ['name', 'parent_id', 'url', 'icon', 'level', 'sort_order'];

    /**
     * name      : children
     * author    : HDH
     * date      : 2025/03/10  6:20 PM
     * description : 하위 메뉴 정보 (1:N)
     * --------------------------------------------------------
     * @return HasMany
     * --------------------------------------------------------
     */
    public function children()
    {
        return $this->hasMany(related: AdminMenus::class, foreignKey: 'parent_id');
    }

    /**
     * name      : parent
     * author    : HDH
     * date      : 2025/03/10  6:20 PM
     * description : 부모 메뉴 정보 (1:1)
     * --------------------------------------------------------
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * --------------------------------------------------------
     */
    public function parent()
    {
        return $this->belongsTo(related: AdminMenus::class, foreignKey: 'parent_id');
    }

    /**
     * name      : parentLists
     * author    : HDH
     * date      : 2025/03/10  6:20 PM
     * description : 전체 상위 메뉴 리스트 쿼리
     * --------------------------------------------------------
     * @return mixed
     * --------------------------------------------------------
     */
    public static function parentLists()
    {
        return self::where('parent_id', null)->orderBy('sort_order', 'asc')->get();
    }

}
