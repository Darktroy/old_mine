@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="table-responsive" id="contact_us_themes">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th>
                    <input type="checkbox" id="check-all" name="table_records">
                </th>
                <th class="column-title">ID</th>
                <th class="column-title">Title</th>
                <th class="column-title">Description</th>

                <th class="column-title no-link last col-xs-1">
                    <span class="nobr">Action</span>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($themes as $k => $theme)
            <?php $url = url('panel/about_us/themes/'.$theme->id) ?>
                @if($k%2 == 0)
                    <tr class="even pointer">
                @else
                    <tr class="odd pointer">
                @endif
                        <td class="a-center ">
                            <input type="checkbox" name="">
                        </td>
                        <td class=" "> {{ $k+1 }} </td>
                        <td class=" ">{{ $theme->title }}</td>
                        <td class=" ">{{ mb_substr($theme->description,0,150) }}</td>
                        <td class=" last">
                            <a href="" @click.prevent="gettheme('{{ $url}}')">View</a>
                            /
                            <a href="{{ url('panel/about_us/themes/'.$theme->id.'/edit') }}">Edit</a>
                            /
                           <form action="{{ url('panel/about_us/themes/'.$theme->id.'/delete') }}"  method="POST" onSubmit="return confirm('are you sure you want to delete this theme')" style="display:inline;">
                            {{ csrf_field() }}
                                <button class="delete_button"> delete </button>
                            </form>
                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>
        {{ $themes->links() }}
        <modal v-if="modal" @close="modal = false">
        <h4 class="modal-title" slot="title" id="myModalLabel">@{{ title }}</h4>
        <p slot="message_body">@{{ message_body }}</p>
        </modal>
    </div>
@stop