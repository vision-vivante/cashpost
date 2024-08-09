
<h5 class="mb-3">{{ $project->name }}</h5>
<form id="bid-form" class="form-horizontal" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control form-control-sm" action="" name="project_id" value="{{ $project->id }}" placeholder="Enter project title" id="project_id">
    <div class="form-group">
        <div class="message text-danger"></div> 
        <label class="form-label text-sm">
            {{translate('Your Bid Price')}}
            <span class="text-danger">*</span>
        </label>
        <div class="form-group">
            <input type="number"  class="form-control form-control-sm radius-10" name="amount"  id="bid_price" placeholder="Enter your price" min="1" oninput="this.value = Math.abs(this.value)" required>
    </div>
    <div class="form-group">
        <label class="form-label text-sm">
            {{translate('Cover Letter (optional)')}}
        </label>
        <div class="form-group">
            <textarea class="form-control radius-10" rows="3" name="message" id="message" required ></textarea>
        </div>
    </div>
    <div class="form-group text-right">
        <div class="btn-submit">
            <button type="button" class="btn btn-green transition-3d-hover mr-1 bid_btn">{{ translate('Submit') }}</button>
            <span style="display:none" id="loading"><img src="{{my_asset('/uploads/images/loading.gif')}}" height="100" width="100" /></span>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).on('click','.bid_btn',function(e){
        e.preventDefault();
        var amount=$('#bid_price').val();
        var project_id=$('#project_id').val();
        var message=$('#message').val();

        $('.message').text(' ');
        $('.bid_btn').prop( "disabled", true );
        $("#loading").show();
        $.ajax({
            url:"{{ route('bids.store') }}",  
            type: "POST",
            data: { _token: '{{ csrf_token() }}', amount:amount,message:message,project_id:project_id},
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
    });
</script>
