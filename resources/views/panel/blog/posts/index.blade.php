@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="table-responsive" id="contact_us_posts">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th class="column-title">ID</th>
                <th class="column-title">title</th>
                <th class="column-title no-link last col-xs-1">
                    <span class="nobr">Action</span>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($posts as $k => $post)
            <?php $url = url('panel/about_us/post/'.$post->id) ?>
                @if($k%2 == 0)
                    <tr class="even pointer">
                @else
                    <tr class="odd pointer">
                @endif
                        <td class=" "> {{ $k+1 }} </td>
                        <td class=" ">{{ $post->title }}</td>
                        <td class=" last">
                            <a href="{{ url('panel/blog/posts/'.$post->id.'/edit') }}">Edit</a>
                            /
                           <form action="{{ url('panel/blog/posts/'.$post->id.'/delete') }}"  method="POST" onSubmit="return confirm('are you sure you want to delete this post')" style="display:inline;">
                            {{ csrf_field() }}
                                <button class="delete_button"> delete </button>
                            </form>
                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop