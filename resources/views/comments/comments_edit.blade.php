<x-main-layout>

    <form method="post" action="{{route('comments.update',['id'=> $data->id])}}">
        @csrf
        @method('path')

        <textarea>{{$data->content}}</textarea>
    </form>



</x-main-layout>

