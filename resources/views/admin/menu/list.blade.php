@extends('admin.layout.default')
@section('css')
@endsection
@section('contents')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0"></h5>
            <a href="{{ route('admin.menu.add') }}">
                <button type="button" class="btn btn-primary">
                    <span class="tf-icons bx bx-plus"></span>&nbsp; ADD
                </button>
            </a>
        </div>

        <div class="table-responsive text-nowrap mb-5">
            <table class="table table-hover">
                <caption class="ms-4"></caption>
                <thead class="table-light">
                <tr>
                    <th>부모메뉴명</th>
                    <th>메뉴ID</th>
                    <th>메뉴명</th>
                    <th>라우트명</th>
                    <th>아이콘</th>
                    <th>권한레벨</th>
                    <th>순번</th>
                    <th>처리</th>
                </tr>
                </thead>
                <tbody class="">
                @foreach($lists as $list)
                <tr>
                    <td rowspan="{{ count($list->children)+1 ?: 1 }}" class="fw-bold">{{ $list->name }}</td>
                    <td>{{ $list->id }}</td>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->url }}</td>
                    <td>{{ $list->icon }}</td>
                    <td>{{ $list->level }}</td>
                    <td>{{ $list->sort_order }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ url('admin/menu/edit/'.$list->id) }}"><i class="bx bx-edit-alt me-1"></i> 수정</a>
                                <a class="dropdown-item" href="{{ url('admin/menu/delete/'.$list->id) }}" onclick="return confirm('삭제 하시겠습니까?')"><i class="bx bx-trash me-1"></i> 삭제</a>
                            </div>
                        </div>
                    </td>
                </tr>

                @if ($list->children->isNotEmpty())
                    @foreach ($list->children as $child)
                        <tr>
                            <td>{{ $child->id }}</td>
                            <td>{{ $child->name }}</td>
                            <td>{{ $child->url }}</td>
                            <td>{{ $child->icon }}</td>
                            <td>{{ $child->level }}</td>
                            <td>{{ $child->sort_order }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('admin/menu/edit/'.$child->id) }}"><i class="bx bx-edit-alt me-1"></i> 수정</a>
                                        <a class="dropdown-item" href="{{ url('admin/menu/delete/'.$child->id) }}" onclick="return confirm('삭제 하시겠습니까?')"><i class="bx bx-trash me-1"></i> 삭제</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif



                @endforeach
                </tbody>

            </table>
            <div class="mt-3 d-none">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item prev">
                            <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0);">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0);">2</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="javascript:void(0);">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0);">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0);">5</a>
                        </li>
                        <li class="page-item next">
                            <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>


    </div>
    <!--/ Basic Bootstrap Table -->
@endsection
@section('script')
@endsection

