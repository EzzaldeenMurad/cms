@extends('layouts.main')

@section('content')
    <div class="container">
        <p class="my-4 font-weight-bold">{{$title}}</p>
        <div class="row">
            @forelse($notifications as $notification)
                <div class="notification_body">
                    <div class="card mb-2" style="width: 56rem;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    <img style="float:right" src="{{ $notification->user->profile_photo_url }}" width="50px" class="rounded-full"/>
                                </div>
                                <div class="col-10"> 
                                    <i class="far fa-clock"></i> <span class="comment_date text-secondary">{{$notification->created_at->diffForHumans()}}</span>
                                    <a href="{{ route('post.show', $notification->post->slug) }}#comments">
                                        <p class="mt-3" style="width: 40rem;">{{ $notification->user->name }} وضع تعليقًا على المنشور <b>{{$notification->post->title}}</b></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="mx-auto col-8">
                    <div class="alert alert-primary text-center" role="alert">
                         لا يوجد إشعارات      
                    </div>
                </div>
            @endforelse
            <!-- Pagination -->
            <ul class="pagination mb-4">
                {{ $notifications->links() }}
            </ul>
        </div>
    </div>
@endsection