@extends('admin.default.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0 h6">{{translate('Bid Settings')}}</h1>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('bid.save') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="types">{{translate('Bid Price')}}</label>
                            <input type="number" name="set_bid_price" class="form-control" value="{{ get_setting('set_bid_price') }}" min="1" max="999999">
                        </div>
                        <div class="form-group mb-3 text-right">
                            <button type="submit" class="btn btn-primary">{{translate('Update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end card-body -->
    </div> <!-- end card-->

@endsection
