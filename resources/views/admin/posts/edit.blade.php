@extends('layouts.main')

@section('content')
<div class="col-md-12">
    <h2 class="h4 my-4">
        تعديل المنشور
    </h2>
</div>
<div class="col-md-8 bg-white py-3">
    <form method="POST" action="{{route('posts.update', $post->id)}}" enctype="multipart/form-data">
         @csrf
        @method('patch')
        <label for="title" class="mb-2">التصنيف</label>
        <div class="input-group mb-3">
            <select class="form-select" name="category_id">
                @include('lists.categories', ['category_id' => $post->category_id])
            </select>
        </div>

        <label for="title" class="mb-2">عنوان المنشور</label>
        <div class="input-group mb-3">
            <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="حدد عنوان الموضوع" value="{{ $post->title }}">
            @error('title')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-row">
            <div class="col-lg-5 form-group">
                <label for="slug">الإسم اللطيف </label>
                <input type="text" class="form-control" name="slug" placeholder="" value="{{$post->slug}}">
            </div>
            <div class="col-lg-6 form-group">
                <label for="approved">نشر الموضوع </label>
                <input type="checkbox" class="" name="approved"  value="{{$post->approved}}" {{$post->approved ? 'checked' : ''}}>
            </div>
        </div>

        <label for="editor" class="mb-2">محتوى المنشور</label>
        <div class="input-group d-inline">
            <textarea id="editor" class="form-control  @error('body') is-invalid @enderror" name="body" rows="3">{{$post->body}}</textarea>
            @error('body')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group my-3 file-area">
            <label for="image" class="mb-2">صورة الغلاف</label>
            <input type="file" id="image" accept="image/*"  onchange="readCoverImage(this);" name="image">
            <div class="input-title">اسحب الصورة إلى هنا أو انقر للاختيار يدويًا</div>
        </div>
        <div class="row">
            <img id="cover-image-thumb" src="{{ asset('/storage/images/'.$post->image_path) }}" class="col-2" width="100" height="100">
            <span class="input-name col-6"></span>
        </div>

        <button type="submit" class="btn btn-outline-dark my-3">تعديل </button>

     </form>
</div>

    @include('partials.sidebar')

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
