<!-- resolve Modal -->
<h5 class="mb-3">{{ $project->name }}</h5>
<form id="bid-form" class="form-horizontal" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control-sm" action="" name="projectuser_id" value="{{ $projectuser_id }}" id="projectuser_id">
    <input type="hidden" class="form-control-sm" action="" name="project_id" value="{{ $project->id }}"  id="project_id">
    <div class="form-group">
        <div class="message text-danger"></div> 
        <label class="form-label text-sm">
            {{translate('Dispute Resolve')}}
            <span class="text-danger">*</span>
        </label>
        <div class="form-group">
            <select name="dispute_resolve" class="form-control" id="dispute_resolve">
                @foreach ($users as $key => $user)
                   <option value="{{$user->id}}">{{$user->name}} ({{$user->user_type}})</option>
                @endforeach
            </select>
    </div>
    <div class="form-group text-right">
        <div class="btn-submit">
            <button type="button" class="btn btn-primary transition-3d-hover mr-1 dispute_btn">{{ translate('Submit') }}</button>
            <span style="display:none" id="loading"><img src="{{my_asset('/uploads/images/loading.gif')}}" height="100" width="100" /></span>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).on('click','.dispute_btn',function(e){
        e.preventDefault();
        var faviour_user_id=$('#dispute_resolve').val();
        var projectuser_id=$('#projectuser_id').val();
        var project_id=$('#project_id').val();
        $('.message').text(' ');
        $('.dispute_btn').prop( "disabled", true );
        $("#loading").show();
        if(confirm('Are sure to submit this form')){
            $.ajax({
                url:"{{ route('resolve.store') }}",  
                type: "POST",
                data: { _token: '{{ csrf_token() }}',faviour_by_user_id:faviour_user_id,projectuser_id:projectuser_id,project_id:project_id},
                dataType: 'JSON',
                success: function( response ) {
                    if(response.status==false){
                        $('.bid_btn').prop( "disabled",false);
                        $("#loading").hide();
                        $('.message').text(response.msg);
                    }else{
                        window.location.reload();
                    }
                }
            });
        }
    });
</script>