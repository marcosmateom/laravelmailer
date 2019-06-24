<div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{old('name') ?? $customer->name}}" class="form-control">
    </div>

    <div>{{$errors->first('name')}}</div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" name="email" value="{{old('email') ?? $customer->email}}" class="form-control">
    </div>

    <div>{{$errors->first('email')}}</div>

    <div class="form-group">
        <label for="active">Status</label>
        <select name="active" id="active" class="form-control">
            <option value="" disabled>Select customer status</option>
            <option value="1" {{$customer->active == 'active' ? 'selected':''}}>Active</option>
            <option value="0" {{$customer->active == 'inactive' ? 'selected':''}}>Inactive</option>
        </select>
    </div>

    <div class="form-group">
        <label for="company_id">Company</label>
        <select name="company_id" id="company_id" class="form-control">
            @foreach ($companies as $company)
        <option value="{{$company->id}}" {{$company->id == $customer->company_id ? 'selected':''}}>{{$company->name}}</option>
            @endforeach
        </select>
    </div>
    @csrf