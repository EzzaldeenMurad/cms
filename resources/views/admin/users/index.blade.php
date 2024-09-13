@extends('admin.theme.default')

@section('title')
    إضافة مستخدم جديد
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i>
                @can('add-user')
                    <form method="post" action="{{ route('user.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    placeholder="الاسم">
                                @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                    placeholder="البريد الإلكتروني">
                                @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <input type="text" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="كلمة المرور">
                                @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <select name="role_id" class="form-control">
                                    @include('lists.roles')
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-dark">حفظ </button>
                            </div>
                        </div>
                    </form>
                @endcan

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>الإسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>تاريخ التفعيل</th>
                                <th>الدور</th>
                                <th>تاريخ الإنشاء</th>
                                <th>تعديل</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->email_verified_at }}</td>
                                    <td>{{ $user->role->role }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        @can('edit-user')
                                            <form method="GET" action="{{ route('user.edit', $user->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-link"
                                                    style="background-color: white;border: none;"><i
                                                        class="far fa-edit text-success fa-lg"></i></button>
                                            </form>
                                        @endcan

                                    </td>
                                    <td>
                                        @can('delete-user')
                                            <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link"
                                                    style="background-color: white;border: none;"><i
                                                        class="far fa-trash-alt text-danger fa-lg"></i></button>
                                            </form>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
