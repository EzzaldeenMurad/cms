@extends('admin.theme.default')

@section('title')
تعديل صفحة
@endsection

@section('content')
    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  
        </div>
        <div class="card-body">
          <div class="container">
            <form method="POST" action="{{route('page.update', $page->id)}}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="col-lg-5 form-group">
                    <label for="title">عنوان الصفحة </label>
                    <input type="text" class="form-control" name="slug"  value="{{ $page->slug }}">
                </div>

                <div class="col-lg-5 form-group">
                    <label for="title"> الوصف </label>
                    <input type="text" class="form-control" name="title"  value="{{ $page->title }}">
                </div>

                <div class="col-lg-12 form-group">
                    <label for="body"> المحتوى </label>
                    <textarea name="content" class="form-control" id="editor">{{ $page->content }}</textarea>
                </div>

                <div class="col-lg-12 form-group">
                    <button type="submit" class="btn btn-dark mt-3">تعديل </button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')

    <script>
        function readCoverImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector('#cover-image-thumb').setAttribute('src', e.target.result);
                };
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                language: {
                // The UI will be Arabic.
                ui: 'ar',

                // the content will be edited in Arabic.
                content: 'ar'
                },
                
                toolbar: {
                    items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    '|',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'undo',
                    'redo',
                    '|',
                    'Blockquote'
                    ]
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection