<section >
    <form method="post" action="{{ route('posts.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="py-12 post-create">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 post-block">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl post_body_block_input_name">
                        <x-input-label for="post_body" :value="__('Name')" />
                        <x-text-input value="{{old('name')}}" :placeholder="__('Name Post')" class="post_body_input" name="name"></x-text-input>
                        <x-input-error :messages="$errors->get('name')"></x-input-error>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg post_block_input_body">
n                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl post_body_block_input_name">
                        <div class="max-w-xl post_body_block_input_date">

                            <x-input-label for="date_publish" :value="__('Date Publish')" />

                            <input name="date_publish" id="date_publish" value="{{ date('Y-m-d H:i:s') }}">

                            <x-input-error :messages="$errors->get('date_publish')"></x-input-error>

                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <label for="formFile" class="form-label">Select image</label>
                        <input class="form-control" name="image" type="file" id="formFile" accept="image/*" maxlength="10485760">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
