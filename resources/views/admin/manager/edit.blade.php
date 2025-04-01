@extends('admin.layout.default')
@section('css')
@endsection
@section('contents')
    <div class="col-xl-12">
        <!-- Basic Layout -->
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">관리자 수정</h5>
                <small class="text-muted float-end"></small>
            </div>
            <div class="card-body">
                <form id="formMenu" method="POST" action="{{ route('admin.manager.edit',['id' => $list->id] + request()->query()) }}" enctype="multipart/form-data">
                    @csrf
                    <dif class="row">
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="email" id="email" name="email" placeholder="E-mail" value="{{ $list->email }}" disabled/>
                            <span class="error">{{ $errors->first('email') }}</span>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" id="name" name="name" placeholder="Name" value="{{ $list->name }}"/>
                            <span class="error">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Password" value=""/>
                            <span class="error">{{ $errors->first('password') }}</span>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password_confirm" class="form-label">Password Confirm</label>
                            <input class="form-control" type="password" id="password_confirm" name="password_confirm" placeholder="Password Confirm" value=""/>
                            <span class="error">{{ $errors->first('password_confirm') }}</span>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="level" class="form-label">Level</label>
                            <select id="level" name="level" class="form-select">
                                @for($i=($list->level===9?9:7);$i<10;$i++)
                                    <option value="{{$i}}" {{$i===$list->level ?'selected':''}}>{{ $i }}</option>
                                @endfor
                            </select>
                            <span class="error">{{ $errors->first('level') }}</span>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select">
                                <option value="active" {{ $list->status==='active'?'selected':'' }}>active</option>
                                <option value="inactive" {{ $list->status==='inactive'?'selected':'' }}>inactive</option>
                            </select>
                            <span class="error">{{ $errors->first('status') }}</span>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="photo" class="form-label">Photo</label>
                            <input class="form-control" type="file" id="photo" name="photo" placeholder="Photo" value="{{ old('photo') }}"/>
                            @if(!empty($list->photo))
                                <div id="div-profile-photo">
                                    <img src="{{ asset('storage/'.$list->photo) }}" class="mt-2 w-20">
                                    <button type="button" class="btn btn-sm btn-icon btn-danger align-bottom" id="btn_photo_delete">
                                        <span class="tf-icons bx bx-trash"></span>
                                    </button>
                                </div>
                            @endif
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
    <script>
        'use strict';
        (function () {

            const csrfTokenObj = document.querySelector('meta[name="csrf-token"]');
            const deleteBtn = document.querySelector('#btn_photo_delete');

            if (deleteBtn) {
                deleteBtn.onclick = function () {
                    if (confirm('이미지를 삭제 하시겠습니까?')) {
                        const f = new FormData;
                        f.append('id', {{ $list->id }});

                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', '{{ route('admin.manager.photo.delete') }}', true);
                        xhr.setRequestHeader('X-CSRF-TOKEN', csrfTokenObj.getAttribute('content'));
                        xhr.send(f);

                        xhr.onload = function () {
                            const parseTxt = JSON.parse(xhr.responseText);
                            csrfTokenObj.setAttribute('content', parseTxt.token);
                            document.querySelector('input[name="_token"]').value = parseTxt.token;
                            if (xhr.status === 200) {
                                document.querySelector('#div-profile-photo').innerText = "";
                            } else {
                                console.log('Response error: ' + xhr.status);
                            }
                            toastEl.toastShow('info', 'TR',parseTxt.processMessage);
                        }
                    }
                };
            }
        })();

    </script>
@endsection
