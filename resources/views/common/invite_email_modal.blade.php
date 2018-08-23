<!-- Basic modal -->
<div id="invite_friend" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"> Invite Friend </h5>
            </div>

            {!! Form::open(['url'=>'/invite-friend','class'=>'invite_friend_form']) !!}
            <div class="modal-body">

                <h6 class="text-semibold">Please Enter Your Friend Email</h6>
                <div class="form-group">
                    <input type="text" name="email" id="" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- /basic modal -->