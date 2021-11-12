<div class="form-group">
    <div class="row">
        <label class="col-sm-2 control-label" for="name">{{translate('Name')}}</label>
        <div class="col-sm-10">
            <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" value="{{ Session::get('order_edit.shipping_info')['name'] }}" required>
        </div>
    </div>
</div>
<div class="form-group">
    <div class=" row">
        <label class="col-sm-2 control-label" for="address">{{translate('Address')}}</label>
        <div class="col-sm-10">
            <textarea placeholder="{{translate('Address')}}" id="address" name="address" class="form-control" required>{{ Session::get('order_edit.shipping_info')['address'] }}</textarea>
        </div>
    </div>
</div>
<div class="form-group">
    <div class=" row">
        <label class="col-sm-2 control-label" for="email">{{translate('Country')}}</label>
        <div class="col-sm-10">
            <select name="country" id="country" class="form-control demo-select2 aiz-selectpicker" required data-placeholder="{{translate('Select country')}}" data-selected="{{ Session::get('order_edit.shipping_info')['country'] }}" class="form-control"">
                @foreach (\App\Country::where('status',1)->get() as $key => $country)
                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="form-group">
    <div class=" row">
        <label class="col-sm-2 control-label" for="city">{{translate('City')}}</label>
        <div class="col-sm-10">
            <input type="text" placeholder="{{translate('City')}}" id="city" name="city" class="form-control" required>
        </div>
    </div>
</div>
<div class="form-group">
    <div class=" row">
        <label class="col-sm-2 control-label" for="postal_code">{{translate('Postal code')}}</label>
        <div class="col-sm-10">
            <input type="number" min="0" placeholder="{{translate('Postal code')}}" id="postal_code" value="{{ Session::get('order_edit.shipping_info')['postal_code'] }}" name="postal_code" class="form-control" required>
        </div>
    </div>
</div>
<div class="form-group">
    <div class=" row">
        <label class="col-sm-2 control-label" for="phone">{{translate('Phone')}}</label>
        <div class="col-sm-10">
            <input type="number" min="0" placeholder="{{translate('Phone')}}" id="phone" value="{{ Session::get('order_edit.shipping_info')['phone'] }}" name="phone" class="form-control" required>
        </div>
    </div>
</div>
