@extends('frontend.default.layouts.app')

@section('content')
<style>
    .image-upload {
        width: 100%;
        height: 220px;
        background-color: #F3FAFF;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px dashed #1492E6;
        border-radius: 10px;
    }
    .invalid-feedback{
        display: block;
    }
</style>
    <section class="py-5 compaign-section">
        <div class="container">
            <div class="d-block align-items-start">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="aiz-user-panel">
                            <div class="aiz-titlebar mt-2 mb-4">
                                    <div class="campaign-heading">
                                        <h2 class="font-weight-bold">{{ translate('Post A New Project') }}</h2>
                                        <h2 class="text-sm font-italic text-grey">{{ translate('*All fields are required') }}</h2>
                                    </div>
                            </div>
                            <div class="card">
                                <div class="campaign-card-body">
                                    <form class="form-horizontal" id ="createForm" action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label h5">
                                                {{ translate('Campaign Title*') }}
                                            </label>
                                            <div class="form-group">
                                                <input type="text" class="form-control radius-10 @error('name') is-invalid @enderror" name="name" placeholder="Enter campaign title" value="{{ old('name') }}" >
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="form-label h5">
                                                        {{ translate('Project category*') }}
                                                    </label>
                                                    <select class="form-control radius-10 coustom-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" data-live-search="true" required>
                                                    @foreach ($categories as $category)
                                                        @if (old('category_id') == $category->id )
                                                            <option value="{{ $category->id }}" data-id="{{ $category->id}}" selected>{{ $category->name }}</option>
                                                        @else
                                                            <option value="{{ $category->id }}" data-id="{{ $category->id}}">{{ $category->name }}</option>
                                                        @endif
                                                        
                                                    @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-8">
                                                    <label class="form-label h5">
                                                        <span class="text-danger"></span>
                                                    </label>
                                                    <input type="text" class="form-control radius-10 mt-2 @error('excerpt') is-invalid @enderror" name="excerpt" placeholder="Caption (optional)" value="{{ old('excerpt') }}">
                                                    @error('excerpt')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row align-items-end">
                                                        <div class="col-lg-4">
                                                            <label class="form-label h5">
                                                                {{ translate('Content Type*') }}
                                                            </label>
                                                            <select class="form-control coustom-select radius-10 @error('content_type') is-invalid @enderror" id="content_type" name="content_type">
                                                                <option value=""> Select</option>


                                                                <option id="link" class="link" value="1" @if(old('content_type')==1) selected @endif> Link</option>  
                                                                <option  class="video" value="2" 
                                                                @if(old('content_type')==2) selected @endif>Image / Video</option>  

                                                            </select>
                                                        </div>
                                                        <div class="col-lg-8 content_link">
                                                            <input type="url" id="content_1" class="form-control  @error('extra_url') is-invalid @enderror" placeholder="Enter url" name="extra_url" value=" @if(old('content_type')==1) {{ old('extra_url') }} @endif" style="@if(old('content_type')==1) display: block; @else display: none; @endif">
                                                            @error('extra_url')
                                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group mb-4" id="content_2" style="@if(old('content_type')==2) display: block; @else display: none; @endif;">
                                                            <label class="form-label text-dark h5 h5 mb-3"> </label>
                                                            <div class="input-group flex-column image-upload ">
                                                                <div><i class="bi bi-image-fill h3 mb-2 text-grey"></i></div>
                                                                <div class="fw-600 text-dark h5" >
                                                                    <label for="chooseFile" class="custom-file-upload">
                                                                        <i class="fa fa-cloud-upload"></i> Upload
                                                                    </label>
                                                                    <input type="file" name="campaign_file" class="campaign_file"  id="chooseFile" style="visibility:hidden;">
                                                                </div>
                                                            </div>
                                                            <label id="chooseFile-error" class="error" for="chooseFile"></label>
                                                            @error('campaign_file')
                                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @error('content_type')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group u-summernote-editor">
                                            <label class="form-label h5">
                                                {{ translate('Project Details*') }}
                                            </label>
                                            <textarea class="form-control radius-10 @error('description') is-invalid @enderror" rows="5" name="description">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-4">
                                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}"></div>
                                        </div>

                                        <div class="text-left"> 
                                        <button type="submit" class="btn btn-green-lg transition-3d-hover mr-1 create-btn">{{ translate('Post Project') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
<script type="text/javascript">
    $(function () {
        $('#content_type').on("change",function () {
            if($(this).val()==1){
                $('#content_2').hide();
                $('#content_1').show();
            }else{
                $('#content_1').hide();
                $("#content_1").val('');
                $('#content_2').show();
            }
        })
        $('#category_id').change(function(e){
            var id=$(this).find(':selected').data("id");
            if(id==5 || id==2 || id==3){
                $('#content_type').find('#link').remove();
                $('#content_1').remove();
                $('#content_1').find('#url').remove();
                if(id==2){
                    $('.video').text('Image / Video');
                }else{
                    $('.video').text('Video');
                }
            }else{
                if(!$('#link').hasClass('link')){
                    add_link();
                    $('#content_type').append('<option id="link" class="link" value="1">Link</option>');
                }
            }
        })
        $('.create-btn').click(function(e) {
            $(this).attr('disabled','disabled');
            $('#createForm').submit();
            setTimeout(function(){
                $(this).removeAttr('disabled');
            },3000);



            var response = grecaptcha.getResponse();
            if(response.length == 0)
            {
            //reCaptcha not verified
                alert("Please verify you are a human.");
                e.preventDefault();
                return false;
            }
            //captcha verified
            //do the rest of your validations here
            $("#createForm").submit();

            return true;
        });
        function add_link(){
            $('.video').text('Image / Video');
            var input =$("<input name='extra_url' id='content_1' type='url' class='form-control' placeholder='Enter url' value='' style='display:none;'>");
            $('.content_link').append(input);
        }

    });
</script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- <script type="text/javascript">
    $(document).ready(function(){
        $("#createForm").on("submit", function(evt)
        {
            var response = grecaptcha.getResponse();
            if(response.length == 0)
            {
            //reCaptcha not verified
                alert("Please verify you are a human.");
                evt.preventDefault();
                return false;
            }
            //captcha verified
            //do the rest of your validations here
            $("#createForm").submit();
        });
    });
</script> -->
@endsection