<!-- comment.blade.php -->
<li class="comment-item">
    <div class="story__header">
        <div class="story__user user">
            <span>{{ $comment->user->name }}</span>
            <span>{{ $comment->created_at }}</span>
        </div>
    </div>
    <div class="posts-block-body">
        <p>{{ $comment->content }}</p>
    </div>

    <!-- Check if the comment has children -->
    @if(count($comment->children) > 0)
        <ul>
            @foreach($comment->children as $childComment)
                @include('components.comments', ['comment' => $childComment])
            @endforeach
        </ul>
    @endif
</li>
