@includewhen(!count($contents->comments) ,'alerts.empty', ['msg'=>'لا توجد أي تعليقات بعد'])

<div class="commentBody">
    @foreach($contents->comments as $comment)
        <div class="card mt-5 mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <img src="{{$comment->user->profile_photo_url}}" width="150px" class="rounded-full"/>
                    </div>
                    <div class="col-10">
                        @can('delete-post', $comment)
                            <form method="POST" action="{{ route('comment.destroy', $comment->id) }}" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف التعليق هذا؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="float-left"><i class="far fa-trash-alt text-danger fa-lg"></i></button>
                            </form>
                        @endcan

                        <p class="mt-3 mb-2"><strong>{{$comment->user->name}}</strong></p>
                        <i class="far fa-clock"></i> <span class="comment_date text-secondary">{{$comment->created_at->diffForHumans()}}</span>
                        <a href="{{ route('post.show', $comment->Post->slug) }}#comments"><p class="mt-3" >{{\Illuminate\Support\Str::limit($comment->body , 250) }}</p></a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
