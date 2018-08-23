@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="row" id="sponsers" v-if="sponsers">
        @foreach($sponsers as $sponser)
            <div class="col-md-55">
                <div class="thumbnail">
                    <div class="image view view-first">
                        <img style="width: 100%; display: block;" src="{{ asset($sponser->image) }}" alt="image"/>
                        <div class="mask">
                            <p>{{ $sponser->name }}</p>
                            <div class="tools tools-bottom">
                                <a href="{{ $sponser->image }}">
                                    <i class="fa fa-link"></i>
                                </a>
                                <a href="{{ url("panel/sponsers/{$sponser->id}/edit") }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <?php $url = url('panel/sponsers/'.$sponser->id.'/delete') ?>
                                <a href="#" @click.prevent="deleteSponser('{{ $url }}')">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="caption">
                        <p>{{ $sponser->name }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $sponsers->links() }}
    </div>
@stop