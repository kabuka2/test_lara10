<x-main-layout>
    {{$data->id}}
    <form method="post" action="{{route('comments.update',['id'=> $data->id])}}">
        @csrf
        @method('patch')

        <div class="py-12 post-create">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 post-block">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl post_body_block_input_name">
                        <div class="max-w-xl post_body_block_input_date">

                          <textarea name ="content">
                            {{$data->content}}
                            <x-input-error :messages="$errors->get('content')"></x-input-error>
                          </textarea>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
        <input name="id" type="hidden" value="{{$data->id}}">
    </form>






</x-main-layout>

