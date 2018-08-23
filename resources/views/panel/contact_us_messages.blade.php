@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="table-responsive" id="contact_message_admin">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th>
                    <input type="checkbox" id="check-all" name="table_records" v-model="records" @click="{records : !records}" >
                </th>
                <th class="column-title">ID</th>
                <th class="column-title">Name</th>
                <th class="column-title">Email</th>
                <th class="column-title">Subject</th>

                <th class="column-title no-link last"><span class="nobr">Action</span>
                </th>
                <th class="bulk-actions" colspan="7">
                    <li>
                        <a class="antoo" style="color:#fff; font-weight:500;">
                            Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i>
                            <ul class="nav child_menu">
                                <li><a href="#"> <i class="fa fa-trash-o"></i> </a></li>
                            </ul>
                        </a>
                    </li>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($messages as $k => $message)
                <?php $url = url('panel/home/contact_us/' . $message->id) ?>
                <?php $deleteUrl = $url . '/delete' ?>
                @if($k%2 == 0)
                    <tr class="even pointer">
                @else
                    <tr class="odd pointer">
                @endif
                    <td class="a-center ">
                                <input type="checkbox"  name="">
                        </td>
                        <td class=" ">{{ $k+1 }}</td>
                        <td class=" "> {{ $message->name }} </td>
                        <td class=" ">{{ $message->email }} </td>
                        <td class=" ">{{ $message->subject }}</td>
                        <td class=" last">
                            <a href="#" @click="getMessage('{{ $url}}')">View</a>
                            /
                            <form action="{{ url('panel/home/contact_us/'.$message->id.'/delete') }}" method="POST" onSubmit="return confirm('are you sure you want to delete this message')" style="display:inline;">
                            {{ csrf_field() }}
                                <button class="delete_button"> delete </button>
                            </form>
                            <!--<a href="#" @click="deleteMessage('{{ $deleteUrl}}')">Delete </a>-->
                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>
        {{ $messages->links() }}
        <modal v-if="modal" @close="modal = false">
        <h4 class="modal-title" slot="title" id="myModalLabel">@{{ title }}</h4>
        <p slot="message_body">@{{ message_body }}</p>
        </modal>
    </div>
@stop