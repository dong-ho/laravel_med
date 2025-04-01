@extends('admin.layout.default')
@section('css')
@endsection
@section('contents')

<div class="col-xl-12">
    <!-- Basic Layout -->
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">관리자 메뉴 추가</h5>
            <small class="text-muted float-end"></small>
        </div>
        <div class="card-body">
            <form id="formMenu" method="POST" action="{{ route('admin.manager.store') }}" enctype="multipart/form-data">
                @csrf
                <dif class="row">
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail <span class="text-danger align-middle">*</span></label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required/>
                        <span class="error">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Name <span class="text-danger align-middle">*</span></label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required/>
                        <span class="error">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="password" class="form-label">Password <span class="text-danger align-middle">*</span></label>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Password" value="{{ old('password') }}" required/>
                        <span class="error">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="password_confirm" class="form-label">Password Confirm <span class="text-danger align-middle">*</span></label>
                        <input class="form-control" type="password" id="password_confirm" name="password_confirm" placeholder="Password Confirm" value="" required/>
                        <span class="error">{{ $errors->first('password_confirm') }}</span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="level" class="form-label">Level <span class="text-danger align-middle">*</span></label>
                        <select id="level" name="level" class="form-select" required>
                            @for($i=7;$i<9;$i++)
                                <option value="{{$i}}" {{$i==old('level')?'selected':''}}>{{$i}}</option>
                            @endfor
                        </select>
                        <span class="error">{{ $errors->first('level') }}</span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger align-middle">*</span></label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="active" {{old('status')==='active'?'selected':''}}>active</option>
                            <option value="inactive" {{old('status')==='inactive'?'selected':''}}>inactive</option>
                        </select>
                        <span class="error">{{ $errors->first('status') }}</span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="photo" class="form-label">Photo</label>
                        <input class="form-control" type="file" id="photo" name="photo" placeholder="Photo" value="{{ old('photo') }}"/>
                        <span class="error">{{ $errors->first('photo') }}</span>
                    </div>
                </dif>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">
                        <span class="tf-icons bx bx-save"></span>&nbsp;SAVE
                    </button>
                    <a href="{{ route('admin.manager', request()->query()) }}"  class="btn btn-outline-secondary">
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
