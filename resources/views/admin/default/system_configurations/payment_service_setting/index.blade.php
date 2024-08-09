@extends('admin.default.layouts.app')

@section('content')
<div class="">
   <div class="card">
        <form action="{{ route('system_configuration.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h6 class="fw-600 mb-0">{{ translate('Service Fees') }}</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                        <label>{{ translate('Service Fees') }}</label>
                        <input type="hidden" name="types[]" value="service_fees">
                        <input type="number" name="service_fees" class="form-control" min="1"  max="100" placeholder="" value="{{ get_setting('service_fees') }}">
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card">
        <form action="{{ route('system_configuration.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h6 class="fw-600 mb-0">{{ translate('Minimum Wallet Amount') }}</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                        <label>{{ translate('Minimum Wallet Amount') }}</label>
                        <input type="hidden" name="types[]" value="minimum_wallet_amount">
                        <input type="number" name="minimum_wallet_amount" min="1"  max="9999999" class="form-control" placeholder="" value="{{ get_setting('minimum_wallet_amount') }}">
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card">
        <form action="{{ route('system_configuration.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h6 class="fw-600 mb-0">{{ translate('Set Admin Commission') }}</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                        <label>{{ translate('Set Admin Commission') }}</label>
                        <input type="hidden" name="types[]" value="set_commission">
                        <input type="number" name="set_commission" min="1"  max="100" class="form-control" placeholder="" value="{{ get_setting('set_commission') }}">
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                </div>
            </div>
        </form>
    </div>
     <div class="card">
        <form action="{{ route('system_configuration.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h6 class="fw-600 mb-0">{{ translate('Influencer Payment Hours') }}</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                        <label>{{ translate('Influencer Payment Hours') }}</label>
                        <input type="hidden" name="types[]" value="payment_hours">
                        <input type="number" name="payment_hours"  min="1"  max="100"  class="form-control" placeholder="" value="{{ get_setting('payment_hours') }}">
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                </div>
            </div>
        </form>
    </div>
    <!-- <div class="card">
        <form action="{{ route('system_configuration.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h6 class="fw-600 mb-0">{{ translate('Project Cancel Hours') }}</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                        <label>{{ translate('Project Cancel Hours') }}</label>
                         <input type="hidden" name="types[]" value="project_cancel_hours">
                        <input type="number" name="project_cancel_hours"  min="1"  max="100" class="form-control" placeholder="" value="{{ get_setting('project_cancel_hours') }}">
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                </div>
            </div>
        </form>
    </div> -->
    <div class="card">
        <form action="{{ route('system_configuration.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <div class="form-group">
                     <h6 class="fw-600 mb-0">{{ translate('Set Dispute Hours') }}</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                         <label>{{ translate('Set Dispute Hours') }}</label>
                        <input type="hidden" name="types[]" value="set_disute_time">
                        <input type="number" class="form-control" placeholder="" min="1"  max="100" name="set_disute_time" value="{{ get_setting('set_disute_time') }}">
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
