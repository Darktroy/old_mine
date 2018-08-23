@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="table-responsive" id="contact_us_categories">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th>
                    <input type="checkbox" id="check-all" name="table_records">
                </th>
                <th class="column-title">ID</th>
                <th class="column-title">Name</th>
                <th class="column-title no-link last col-xs-1">
                    <span class="nobr">Action</span>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($categories as $k => $categorie)
            <?php $url = url('panel/about_us/categorie/'.$categorie->id) ?>
                @if($k%2 == 0)
                    <tr class="even pointer">
                @else
                    <tr class="odd pointer">
                @endif
                        <td class="a-center ">
                            <input type="checkbox" name="">
                        </td>
                        <td class=" "> {{ $k+1 }} </td>
                        <td class=" ">{{ $categorie->name }}</td>
                        <td class=" last">
                            <a href="{{ url('panel/blog/categories/'.$categorie->id.'/edit') }}">Edit</a>
                            /
                           <form action="{{ url('panel/blog/categories/'.$categorie->id.'/delete') }}"  method="POST" onSubmit="return confirm('are you sure you want to delete this categorie')" style="display:inline;">
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