@props(['user_name','created_at','name','post_image','body','id','count'])

<div class="posts-block-post">
    <div class="story__header">
        <div class="story__user user">
            <span>{{$user_name}}</span>
            <span>{{$created_at}}</span>
        </div>
        <h2 class="posts-block-post-name">
            {{ $name }}
        </h2>
    </div>
    @if(!empty($post_image))
        <div class = "posts-block-image">

            <img class="fit-picture" src="{{$post_image}}" alt="post_image">

        </div>
    @endif
    <div class="posts-block-body">
        <p>{{ $body }}</p>
        <button class="expand-btn">Read more</button>
    </div>
    <div class="posts-block-footer">
        <a href="{{ route('post.user.show', ['id' => $id]) }}">

            <div class="posts-block-footer-count-users">
                <div class = "image-icon-post-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-right-dots" viewBox="0 0 16 16">
                        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z"/>
                        <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                </div>
                <span>{{ $count }}</span>
            </div>

        </a>

    </div>
</div>
