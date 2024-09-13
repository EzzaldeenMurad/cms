@extends('admin.theme.default')

@section('title')
تعديل معلومات المستخدم
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i>  تعديل معلومات المستخدم
            </div>
            <div class="card-body">
                <div class="container">
                    <form method="POST" action="{{route('user.update', $user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('Patch')
                        <div class="form-row">
                            <div class="col-lg-5 form-group">
                                <label for="name">الاسم</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  value="{{$user->name}}">
                                @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-5 form-group">
                                <label for="email">البريد الإلكتروني</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{$user->email}}">
                                @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-6 form-group">
                                <label for="role_id">الدور </label>
                                <select class="form-control" name="role_id">
                                    <option value="{{$user->role_id}}" selected> {{$user->role->role}} </option>
                                    @include('lists.roles')
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 form-group">
                            <button type="submit" class="btn btn-dark mt-3">تحديث </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection