@includewhen(!count($contents->posts), 'alerts.empty', ['msg' => 'لا توجد أي مشاركات بعد'])

@foreach ($contents->posts as $post)
    <div class="row mb-2">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @if (Auth::check())
                            @can('delete-post', $post)
                                <form method="POST" action="{{ route('post.destroy', $post->id) }}"
                                    onsubmit="return confirm('هل أنت متأكد أنك تريد حذف المنشور هذا؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="float-left"><i
                                            class="far fa-trash-alt text-danger fa-lg"></i></button>
                                </form>
                            @endcan

                            @can('edit-post', $post)
                                <form method="GET" action="{{ route('post.edit', $post->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="float-left"><i
                                            class="far fa-edit text-success fa-lg ml-3"></i></button>
                                </form>
                            @endcan
                        @endif
                        <img style="float:right" src="{{ $post->user->profile_photo_url }}" width="50px"
                            class="rounded-full" />
                        <p class="mt-2 me-3" style="display:inline-block;"><strong>{{ $post->user->name }}</strong></p>
                        <div class="row mt-2">
                            <div class="col-3">
                                <i class="far fa-clock"></i> <span
                                    class="text-secondary">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-3">
                                <i class="fa-solid fa-align-justify"></i> <span
                                    class="text-secondary">{{ $post->category->title }}</span>
                            </div>
                            <div class="col-3">
                                <i class="fa-solid fa-comment"></i> <span
                                    class="text-secondary">{{ $post->comments->count() }} تعليقات</span>
                            </div>
                        </div>
                        <h4 class="my-2 h4"><a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></h4>
                        <p class="card-text mb-2">{!! Str::limit($post->body, 200) !!}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
