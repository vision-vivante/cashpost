<h4>Are you sure you want to file this dispute?</h4>
<form class="form-horizontal" action="{{ route('get_disputed_project_modal') }}" method="POST" enctype="multipart/form-data" id="disputed_form">
    @csrf
    <input type="hidden" name="project_id" value="{{$project->project_id}}">
    <input type="hidden" name="receiver_user_id" value="{{$project->user_id}}">
    <div class="form-group text-right mt-3">
        <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1">{{ translate('Dispute Now') }}</button>
    </div>
</form>
               

    <script type="text/javascript">
       /* $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
            $(document).on('click','.dispute_submit',function(e){
                e.preventDefault();
                var project_id=$('#project_id').val();
                var receiver_user_id=$('#receiver_user_id').val();
                var message=$('#message').val();
                $('.message').text(' ');
                $('.dispute_submit').prop( "disabled", true );
                $("#loading").show();
                $.ajax({
                    url:"{{ route('get_disputed_project_modal') }}",  
                    type: "POST",
                    data: { _token: '{{ csrf_token() }}',project_id:project_id,receiver_user_id:receiver_user_id},
                    dataType: 'JSON',
                    success: function( response ) {
                        if(response.status==false){
                            $('.dispute_submit').prop( "disabled",false);
                            $("#loading").hide();
                            $('.message').text(response.msg);
                        }else{
                            window.location.reload();
                        }
                    }
                });
            });
        });*/
        
    </script>