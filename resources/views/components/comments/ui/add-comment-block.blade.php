@props(['parent_id','post_id'])
@auth
    <div class="comment-content">
        <x-textarea-input class="comments-text-content"></x-textarea-input>
    </div>

    <div class="footer-comment">
        <button
            data-parent-id="{{$parent_id}}"
            data-post-id="{{$post_id}}"
            class="btn-add-comment save-comment-page-comment"
        >
            {{__('Add comment')}}
        </button>
    </div>
@endauth
