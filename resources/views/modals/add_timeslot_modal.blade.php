<!-- delete Modal -->
<div id="add-time-modal" class="modal fade">
    <div class="modal-dialog modal-lg modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6">{{translate('Add New Time Slot')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body text-center" style="min-height: 12rem;">
                <div class="row">
                    <div class="col-sm-6">
                        <input type="hidden" name="types[]" value="days">
                        <select name="days[]" id="days" class="form-control aiz-selectpicker" multiple required>
                            <option value="sat">{{translate('Saturday')}}</option>
                            <option value="sun">{{translate('Sunday')}}</option>
                            <option value="mon">{{translate('Monday')}}</option>
                            <option value="tue">{{translate('Tuesday')}}</option>
                            <option value="wed">{{translate('Wednesday')}}</option>
                            <option value="thu">{{translate('Thursday')}}</option>
                            <option value="fri">{{translate('Friday')}}</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" name="start"  id="start" class="form-control aiz-time-picker">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" name="end" id="end" class="form-control aiz-time-picker">
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" id="time-smt" class="btn btn-success " >Submit</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
