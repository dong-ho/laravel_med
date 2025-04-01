<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Request;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * name      : getAdminUser
     * author    : HDH
     * date      : 2025/03/04  6:09 PM
     * description : 관리자 리스트 (검색 + 페이징)
     * --------------------------------------------------------
     * @return array
     * --------------------------------------------------------
     */
    public static function getAdminUser()
    {
        $result = self::where('role','admin');
        $search = Request::get('search');
        if(!empty($search))
        {
            $result->where(function ($query) use ($search) { // OR 조건 그룹핑
                $query->where('name','like', '%'.$search.'%')
                    ->orWhere('email','like', '%'.$search.'%');
            });
        }
        return $result->orderBy('created_at','desc')->paginate(config('common.per_page_10'));
    }

    /**
     * name      : getUser
     * author    : HDH
     * date      : 2025/03/04  6:09 PM
     * description : 사용자 리스트 (검색 + 페이징)
     * --------------------------------------------------------
     * @return array
     * --------------------------------------------------------
     */
    public static function getUser()
    {
        $result = self::where('role','<>','admin');
        $search = Request::get('search');
        if(!empty($search))
        {
            $result->where(function ($query) use ($search) { // OR 조건 그룹핑
                $query->where('name','like', '%'.$search.'%')
                    ->orWhere('email','like', '%'.$search.'%');
            });
        }
        return $result->orderBy('created_at','desc')->paginate(config('common.per_page_10'));
    }
}
