@extends('admin.layout.default')

@section('content')
    <div>관리자 메인 입니다.</div>
    <ul>
        @forelse($menus as $menu)
            <li>
                <a href="{{ $menu->url }}">{{ $menu->name }}</a>
                @if($menu->children->isNotEmpty())
                    <ul>
                        @foreach($menu->children as $child)
                            <li><a href="{{ $child->url }}">{{ $child->name }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @empty
            <li>메뉴없음</li>
        @endforelse
    </ul>
@endsection

