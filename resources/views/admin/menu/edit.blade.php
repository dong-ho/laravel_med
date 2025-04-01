@extends('admin.layout.default')
@section('css')
@endsection
@section('contents')
    <div class="col-xl-12">
        <!-- Basic Layout -->
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">관리자 메뉴 수정</h5>
                <small class="text-muted float-end"></small>
            </div>
            <div class="card-body">
                <form id="formMenu" method="POST" action="{{ route('admin.menu.edit',['id' => $list->id]) }}" >
                    @csrf
                    <dif class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">메뉴명</label>
                            <input class="form-control" type="text" id="name" name="name" placeholder="메뉴명" value="{{ $list->name }}"/>
                            <span class="error">{{ $errors->first('name') }}</span>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="parent_id" class="form-label">부모메뉴</label>
                            <select id="parent_id" name="parent_id" class="form-select">
                                <option value="" >없음</option>
                                @foreach($parentLists as $parentList)
                                    <option value="{{$parentList->id}}" {{$parentList->id===$list->parent_id?'selected':''}}>{{$parentList->name}}</option>
                                @endforeach
                            </select>
                            <span class="error">{{ $errors->first('parent_id') }}</span>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="url" class="form-label">라우트명</label>
                            <input class="form-control" type="text" id="url" name="url" placeholder="라우트명" value="{{ $list->url }}"/>
                            <span class="error">{{ $errors->first('url') }}</span>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="icon" class="form-label">아이콘</label>
                            <input class="form-control" type="text" id="icon" name="icon" placeholder="아이콘" value="{{ $list->icon }}"/>
                            <span class="error">{{ $errors->first('icon') }}</span>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="level" class="form-label">권한레벨</label>
                            <select id="level" name="level" class="form-select">
                                @for($i=2;$i<10;$i++)
                                    <option value="{{$i}}" {{ ($list->level===$i)?'selected':''}}>{{$i}}</option>
                                @endfor
                            </select>
                            <span class="error">{{ $errors->first('level') }}</span>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="sort_order" class="form-label">순번</label>
                            <select id="sort_order" name="sort_order" class="form-select">
                                @for($i=0;$i<10;$i++)
                                    <option value="{{$i}}" {{ ($list->sort_order===$i)?'selected':'' }}>{{$i}}</option>
                                @endfor
                            </select>
                            <span class="error">{{ $errors->first('sort_order') }}</span>
                        </div>
                    </dif>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">
                            <span class="tf-icons bx bx-save"></span>&nbsp;SAVE
                        </button>
                        <a href="{{ route('admin.menu') }}"  class="btn btn-outline-secondary">
                            <span class="tf-icons bx bx-list-ul"></span>&nbsp;LIST
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
