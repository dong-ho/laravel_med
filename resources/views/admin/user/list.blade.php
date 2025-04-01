@extends('admin.layout.default')
@section('css')
@endsection
@section('contents')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div class="col-md-6">
                <form action="" method="get">
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" id="search" name="search" value="{{ request()->search }}" >
                        <button type="submit" class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-end-auto">
                <h5 class="mb-0"></h5>
                <a href="{{ route('admin.user.add', request()->query()) }}">
                    <button type="button" class="btn btn-primary">
                        <span class="tf-icons bx bx-plus"></span>&nbsp; ADD
                    </button>
                </a>
            </div>
        </div>

        <div class="table-responsive text-nowrap mb-5">
            <table class="table table-hover">
                <caption class="ms-4"></caption>
                <thead class="table-light">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>status</th>
                    <th>level</th>
                    <th>photo</th>
                    <th>create</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody class="">
                @forelse ($lists as $list)
                <tr>
                    <td>{{ $list->id }}</td>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->email }}</td>
                    <td>{{ $list->status }}</td>
                    <td>{{ $list->level }}</td>
                    <td>
                        @if(!empty($list->photo))
                            <img src={{ asset('storage/'.$list->photo) }} alt="" class="w-px-20 h-auto rounded-circle">
                        @endif
                    </td>
                    <td>{{ $list->created_at}}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.user.edit',['id'=>$list->id] + request()->query()) }}"><i class="bx bx-edit-alt me-1"></i> 수정</a>
                                <a class="dropdown-item" href="{{ route('admin.user.delete',['id'=>$list->id] + request()->query()) }}" onclick="return confirm('삭제 하시겠습니까?')"><i class="bx bx-trash me-1"></i> 삭제</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="100%" class="text-center">데이터가 존재하지 않습니다.</td>
                </tr>
                @endforelse
                </tbody>

            </table>
            <div class="mt-3 ">
                {{ $lists->appends(Request::except('page'))->links() }}
            </div>
        </div>


    </div>
    <!--/ Basic Bootstrap Table -->
@endsection
@section('script')
@endsection

