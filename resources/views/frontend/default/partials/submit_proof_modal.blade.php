<label class="form-label text-sm">               
    In order to get paid, you have to provide a link to the social media post you created with your client's content.
</label>
<form class="project-form" action="" method="post">
@csrf 
<div class="message text-danger"></div>
<div class="form-group row">
    <div class="col-lg-11">
    <input type="url" name="social_link" class="form-control form-control-sm radius-10 social_link"  id="social_link" placeholder="https://example.com" pattern="https://">
    </div>
    <div class="col-lg-1 p-0 text-center my_tooltip">
        <i data-toggle="tooltip" data-placement="left" title="You can usually find a link to the post by clicking on the picture/video details of the post and copying the link" class=" bi bi-info-circle"></i>
       <!--  <i  data-bs-toggle="tooltip" data-bs-placement="top" title="You can usually find a link to the post by clicking on the picture/video details of the post and copying the link" class="bi bi-info-circle"></i> -->

    </div>
    
</div>
    <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">
    <button type="button"  class="btn btn-green transition-3d-hover mr-1 final_submit" >{{ translate('Submit') }}</button>
    <span style="display:none" id="loading"><img src="{{my_asset('/uploads/images/loading.gif')}}" height="100" width="100" /></span>
</form>
               

    <script type="text/javascript">
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
            $(document).on('click','.final_submit',function(e){
                e.preventDefault();
                var project_id=$('#project_id').val();
                var url=$('#social_link').val();
                var message=$('#message').val();
                $('.message').text(' ');
                $('.final_submit').prop( "disabled", true );
                $("#loading").show();
                $.ajax({
                    url:"{{ route('projects.submit') }}",  
                    type: "POST",
                    data: { _token: '{{ csrf_token() }}',message:message,project_id:project_id,url:url},
                    dataType: 'JSON',
                    success: function( response ) {
                        if(response.status==false){
                            $('.final_submit').prop( "disabled",false);
                            $("#loading").hide();
                            $('.message').text(response.msg);
                        }else{
                            window.location.reload();
                        }
                    }
                });
            });
        });
        
    </script>