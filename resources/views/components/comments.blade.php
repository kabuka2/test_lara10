<!-- comment.blade.php -->
<li class="comment-item">

    <div class="story__header">
        <div class="story__user user">
            <span>{{ $comment->user->name }}</span>
            <span>{{ $comment->created_at }}</span>
        </div>
    </div>
    <div class="posts-block-body" data-id="{{$comment->id}}" data-post-id="{{$comment->post_id}}">
        <p>{{ $comment->content}}</p>

        <div class="comment-content">
            <textarea name="comments-text-content"></textarea>
            <button class="save-comment-page-comment">Save</button>
        </div>
        <div class="footer-comment">
            <button class="btn-add-comment">{{__('Add comment')}}</button>
        </div>

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
