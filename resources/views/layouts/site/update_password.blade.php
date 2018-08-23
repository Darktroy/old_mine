<!-- Account settings -->
<div class="panel panel-flat" id="password">
    <div class="panel-heading">
        <h6 class="panel-title">Account Password</h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        {!! Form::open(['url'=>$user_type.'/settings/change-password']) !!}
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <label>Current password <span class="label label-success"
                                                  v-if="status"> correct password </span> </label>
                    <div class="errors" style="display:inline; float:right;"></div>
                    <input type="password" v-model="old_password"
                           v-on:keyup="currentPassword('{{ url($user_type.'/settings/check-user-password/') }}' , '{{ csrf_token() }}' )"
                           id="old_password" class="form-control">
                </div>

                <div class="col-md-4">
                    <label>New password <span class="label label-info" v-if="status"> Enabled </span> </label>
                    <input type="password" name="password" placeholder="Enter new password" :disabled="disabled"
                           class="form-control password">
                </div>

                <div class="col-md-4">
                    <label>Repeat password <span class="label label-info" v-if="status"> Enabled </span> </label>
                    <input type="password" name="password_confirmation" placeholder="Repeat new password"
                           :disabled="disabled" class="form-control password">
                </div>

            </div>
        </div>


        <div class="text-right">
            <button type="submit" class="btn btn-primary" :disabled="disabled">Save <i
                        class="icon-arrow-right14 position-right"></i>
            </button>
        </div>
        {!! Form::close() !!}
    </div>
</div>