@extends('admin.theme.default')

@section('title')
    تعيين الصلاحيات إلى الأدوار
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <form method="post" action="{{ route('permissions') }}">
                @csrf
                <div class="card-header">
                    <div class="col-lg-6 form-group">
                        <label for="role_id">حدد الدور </label>
                        <select name="role_id" id="role_id" class="form-control">
                            @include('lists.roles')
                        </select>
                    </div>
                </div>
                <div class="card-body row">
                    @foreach ($permissions as $permission)
                        <div class="col-lg-4">
                            <label for="permission">
                                <input type="checkbox" class="" id="check-role" name="permission[]"
                                    value="{{ $permission->id }}" {{ $permission->roles()->find(1) ? 'checked' : '' }}>
                                {{ $permission->desc }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer small text-muted">
                    <input type="submit" class="btn btn-dark" value="حفظ">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#role_id').on('change', function(event) {
               var role_id = $(this).val();
            var token = '{{ Session::token() }}';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('permission_byRole') }}',
                method: 'GET',
                data: {
                    'id': role_id,
                    _token: token
                },
                success: function(data)
                {
                    $('input[type=checkbox]').each(function () {
                        var ThisVal =parseInt(this.value) ;
                        if(data.includes(ThisVal))
                             this.checked = true;
                        else
                            this.checked = false;
                    });
                }
            })
        });
    </script>
@endsection
