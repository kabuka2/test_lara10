<section >
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Create Update') }}
        </h2>
    </header>

    <form method="post" action="{{ route('posts.update',['id'=>$item->id]) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="py-12 post-create">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 post-block">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl post_body_block_input_name">
                        <x-input-label for="post_body" :value="__('Name')" />
                        <x-text-input :value="old('name', $item->name)" :placeholder="__('Name Post')" class="post_body_input" name="name"></x-text-input>
                        <x-input-error :messages="$errors->get('name')"></x-input-error>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg post_block_input_body">
                    <div class="max-w-xl">
                        <x-input-label for="post_body" :value="__('Post')" />
                        <div class="text-area-container">
                            <x-textarea-input class="text-post-body" id="post_body" name="body">{{$item->body}}</x-textarea-input>
                        </div>
                        <x-input-error :messages="$errors->get('body')"></x-input-error>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <label for="formFile" class="form-label">Select image</label>
                        <input class="form-control" name="image" type="file" id="formFile" accept="image/*" maxlength="10485760">
                        <x-input-error :messages="$errors->get('image')"></x-input-error>
                    </div>
                    @if(!empty($item->image))
                        <div class="posts-block-image">
                            <img src="{{$item->image}}">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl post_body_block_input_name">
                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('post_delete', ['id' => $item->id]) }}">Delete</a>
                </div>
            </div>
        </div>

    </form>
</section>

