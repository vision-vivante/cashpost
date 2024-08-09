<form class="form-horizontal" action="{{ route('hire.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control form-control-sm" name="freelancer_id" value="{{ $freelancer_id }}">
    <div class="form-group">
        <label class="form-label h5 d-flex justify-content-between mb-3">
            {{translate('Select Campaign')}}
        </label>
        <select class="select2 coustom-select my-modal form-control aiz-selectpicker" name="project_id" data-toggle="select2" data-placeholder="Choose ..."data-live-search="true" required>
            <option value="">{{translate('Please Select Campaign')}}</option>
            @foreach($projects as $key => $project)
            <option value="{{$project->id}}" @if($project_slug == $project->slug) selected @endif>{{ucfirst($project->name)}}</option>
            @endforeach
        </select>
        <!-- @error('project_id')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror -->
    </div>
    <div class="my-hire-textarea mt-4">
        <textarea class="form-control h5 d-none" name="message" placeholder="Enter text"></textarea>
    </div>
    <div class="form-group text-right my-invite-btn">
        <button type="submit" class="btn btn-green-lg transition-3d-hover mr-1">{{ translate('Invite') }}</button>
    </div>
</form>
