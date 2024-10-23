@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Manage District</h2>
            <form action="{{ route('district.store') }}" method="post">
                @csrf


                <div class="form-group">
                    <label for="state_name">State Name *</label>
                    <select name="state_name" id="state_id" class="form-control">
                        <option value="">Select</option>
                        @foreach($statenames as $statename)
                            <option value="{{ $statename->id }}">{{ $statename->state_name}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="district_name">District Name *</label>
                    <input type="text" name="district_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="status">Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('district.index') }}" class="btn btn-secondary">Back</a>

            </form>
        </div>
    </div>
</div>
@endsection



