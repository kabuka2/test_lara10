<!-- comment.blade.php -->
<li class="comment-item">

    <div class="story__header">
        <div class="story__user user">
            <span>{{ $comment->user->name }}</span>
            <span>{{ $comment->created_at }}</span>
        </div>
    </div>

    <div class="posts-block-body">
        <p>{{ $comment->content}}</p>
        <x-comments.ui.add-comment-block :parent_id="$comment->id" :post_id="$comment->post_id"/>


    </div>

    <!-- Check if the comment has children -->
    @if(count($comment->children) > 0)
        <ul>
            @foreach($comment->children as $childComment)
                <x-comments.comments :comment="$childComment"/>
            @endforeach
        </ul>
    @endif
</li>
