<div class="form-group">
                {!! Form::label('title','Offer Title:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('title',null,['class'=>'form-control col-md-7 col-xs-12 ']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('person','Contact Person :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('contact_person',null,['class'=>'form-control col-md-7 col-xs-12 ']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('email','Email:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::email('email',null,['class'=>'form-control col-md-7 col-xs-12 ']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('phone','Phone:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('phone',null,['class'=>'form-control col-md-7 col-xs-12 ']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('summary','Summary Of Offer:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::textarea('summary',null,['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description','Offer Description:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="form-group">
                {!! Form::label('deadline','Offer DeadLine : (leave empty of its opened)',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12 input-group date">
                    {{--  <input type="text" name="deadline" class="deadline form-control">  --}}
                    {!! Form::text('deadline',null,['class' => 'deadline form-control']) !!}
                    <span class="input-group-addon">
                <i class="glyphicon glyphicon-th"></i>
            </span>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('sectors','Target Sectors:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('sectors[]',$sectors,(isset($offerSectors) && !empty($offerSectors) ? $offerSectors : null),['class'=>'form-control call_city','multiple'=>true]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('activities',' Offer Type:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12 ']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('activities',$activities+['0'=>'Other'],(isset($offer->activity_id) && !empty($offer->activity_id) ? $offer->activity_id : null),['class'=>'form-control activities']) !!}
                    <div class="other_activities form-group">

                    </div>
                </div>

            </div>

            <div class="form-group">
                {!! Form::label('offer_country','Country :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('offer_country[]',$countries,(isset($offer_countries) && !empty($offer_countries) ? $offer_countries : null),['class'=>'form-control call_country','id'=>'call_country','multiple'=>true]) !!}
                </div>
            </div>

            <div class="ln_solid"></div>
            