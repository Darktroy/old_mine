@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="table-responsive" id="contact_us_questions">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th>
                    <input type="checkbox" id="check-all" name="table_records">
                </th>
                <th class="column-title">ID</th>
                <th class="column-title">question</th>
                <th class="column-title">answer</th>
                <th class="column-title"> category </th>
                <th class="column-title no-link last col-xs-1">
                    <span class="nobr">Action</span>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($questions as $k => $question)
            <?php $url = url('panel/about_us/question/'.$question->id) ?>
                @if($k%2 == 0)
                    <tr class="even pointer">
                @else
                    <tr class="odd pointer">
                @endif
                        <td class="a-center ">
                            <input type="checkbox" name="">
                        </td>
                        <td class=" "> {{ $k+1 }} </td>
                        <td class=" ">{{ $question->question }}</td>
                        <td class=" ">{{ mb_substr($question->answer,0,150) }}</td>
                        <td class=""> {{ $categories[$question->category] }} </td>
                        <td class=" last">
                            <a href="" @click.prevent="getquestion('{{ $url}}')">View</a>
                            /
                            <a href="{{ url('panel/faq/'.$question->id.'/edit') }}">Edit</a>
                            /
                           <form action="{{ url('panel/faq/'.$question->id.'/delete') }}"  method="POST" onSubmit="return confirm('are you sure you want to delete this question')" style="display:inline;">
                            {{ csrf_field() }}
                                <button class="delete_button"> delete </button>
                            </form>
                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>
        {{ $questions->links() }}
        <modal v-if="modal" @close="modal = false">
        <h4 class="modal-title" slot="title" id="myModalLabel">@{{ title }}</h4>
        <p slot="message_body">@{{ message_body }}</p>
        </modal>
    </div>
@stop