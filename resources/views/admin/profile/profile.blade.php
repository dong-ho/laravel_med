@extends('admin.layout.default')
@section('css')
@endsection
@section('contents')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <hr class="my-0" />
                <div class="card-body">
                    <form id="formProfileUpdate" method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="email"
                                    name="email"
                                    value="{{ $adminUser->email }}"
                                    autoComplete="off" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{ $adminUser->name }}" autoComplete="off"/>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                                <small class="text-xs">비밀번호를 유지 하려면 이곳을 비워두세요</small>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="photo" class="form-label">Profile Image</label>
                                <input type="file" class="form-control" id="photo" name="photo" placeholder="photo" />
                                @if(!empty($adminUser->photo))
                                    <div id="div-profile-photo">
                                        <img src="{{ asset('storage/'.$adminUser->photo) }}" class="mt-2 w-20">
                                        <button type="button" class="btn btn-sm btn-icon btn-danger align-bottom" id="btn_photo_delete">
                                            <span class="tf-icons bx bx-trash"></span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">저장</button>
                            <button type="reset" class="btn btn-outline-secondary">취소</button>
                        </div>
                    </form>
                </div>
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
                        f.append('id', {{ $adminUser->id }});

                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', '{{ route('admin.profile.photo.delete') }}', true);
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
