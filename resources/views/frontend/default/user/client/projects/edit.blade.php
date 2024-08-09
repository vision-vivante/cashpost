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
                                    <h2 class="font-weight-bold">{{ translate('Edit Project') }}</h2>
                                    <h2 class="text-sm font-italic text-grey">{{ translate('*All fields are required') }}</h2>
                                </div>
                            </div>
                            <div class="card">
                                <div class="campaign-card-body">
                                    <form class="form-horizontal" action="{{ route('projects.update',$project->id) }}" method="POST" enctype="multipart/form-data">
                                        <input name="_method" type="hidden" value="PATCH">
                                        @csrf
                                        <div class="form-group">
                                                    <label class="form-label h5">
                                                        {{ translate('Campaign Title') }}
                                                    </label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control radius-10 @error('name') is-invalid @enderror" name="name" placeholder="Enter campaign title" value="{{ $project->name }}" >
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <label class="form-label h5">
                                                                {{ translate('Project category') }}
                                                            </label>
                                                            <select class="form-control coustom-select radius-10 @error('category_id') is-invalid @enderror" name="category_id" required data-live-search="true" id="category_id">
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}" data-id="{{ $category->id}}" @if ($project->project_category_id == $category->id) selected @endif>{{ $category->name }}</option>
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
                                                            <input type="text" class="form-control radius-10 mt-2 @error('excerpt') is-invalid @enderror" name="excerpt" placeholder="Caption (optional)" value="{{ $project->excerpt}}">
                                                            @error('excerpt')
                                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                               @php 
                                                  if(old('content_type')==1){
                                                    $link="selected";
                                                    $extra_url=old('extra_url');
                                                  }else if($project->content_type==1 && old('content_type')==null){
                                                      $link="selected";
                                                      $extra_url=$project->extra_url;
                                                  }else{
                                                    $link="";
                                                     $extra_url='';
                                                  }
                                                  if(old('content_type')==2){
                                                    $video="selected";
                                                  }else if($project->content_type==2 && old('content_type')==null){
                                                      $video="selected";
                                                  }else{
                                                    $video="";
                                                  }
                                               @endphp  
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row align-items-end">
                                                                <div class="col-lg-4">
                                                                    <label class="form-label h5">
                                                                        {{ translate('Content Type') }}
                                                                    </label>
                                                                    <select class="form-control radius-10 coustom-select radius-10 @error('content_type') is-invalid @enderror" id="content_type" name="content_type">
                                                                        <option value=""> Select</option>
                                                                        <option value="1" {{$link}} id="link" class="link"> Link</option>
                                                                        <option value="2" {{$video}} class="video"> Image / Video</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-8 content_link">
                                                                    <input type="url" id="content_1" class="form-control radius-10  @error('extra_url') is-invalid @enderror" placeholder="Enter url" name="extra_url" value="{{$extra_url}}" style="@if($project->content_type==1 || old('content_type')==1) display: block; @else display: none; @endif">
                                                                    @error('extra_url')
                                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                    @error('content_type')
                                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                                    @enderror

                                                                        <div class="form-group mb-4" id="content_2" style="@if($project->content_type==2 && old('content_type')!=1) display: block;  @else display: none; @endif">
                                                                        <label class="form-label text-dark h5 h5 mb-3"> </label>
                                                                        <div class="input-group flex-column image-upload ">
                                                                            <div><i class="bi bi-image-fill h3 mb-2 text-grey"></i></div>
                                                                            <div class="fw-600 text-dark h5" >
                                                                                <label for="chooseFile" class="custom-file-upload" >
                                                                                    <i class="fa fa-cloud-upload"></i> Upload
                                                                                </label>
                                                                                <input type="file" name="campaign_file" class="campaign_file"  id="chooseFile" style="visibility:hidden;">
                                                                                <input type=hidden name="file_value" class="file_value" value="{{$project->extra_url}}">
                                                                            </div>
                                                                        </div>
                                                                        @if(is_numeric($project->extra_url) && $project->content_type==2 && old('content_type')!=1)
                                                                        @php  
                                                                        $url=custom_asset($project->extra_url);
                                                                        $extension = pathinfo($url, PATHINFO_EXTENSION);
                                                                        $video_ext=array("mp4","mov","wmv","avi","flv","mkv","webm","3gp","MOV");
                                                                        @endphp
                                                                            <div class="file-preview box mt-2 ">
                                                                            @if(in_array($extension,$video_ext))
                                                                                <video  width="100" height="100" alt="" class="img-fluid radius-10"  src="{{$url}}" controls></video>
                                                                            @else
                                                                                <img src="{{ custom_asset($project->extra_url) }}" width="100" height="100" alt="" class="img-fluid radius-10">
                                                                            @endif
                                                                            </div>
                                                                        @endif

                                                                    <label id="chooseFile-error" class="error" for="chooseFile"></label>
                                                                    @error('campaign_file')
                                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="form-group">
                                            <label class="form-label h5">
                                                {{ translate('Project Details') }}
                                            </label>
                                            <textarea class="form-control radius-10 @error('description') is-invalid @enderror" rows="5" name="description">{{ $project->description}}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-green-lg transition-3d-hover mr-1">{{ translate('Update Project') }}</button>
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
    $(document).ready(function(){
        var id=$('#category_id').find(':selected').data("id");
        add_link(id);
    });
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
            add_link(id);
        })
    });
    function add_link(id=''){
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
                $('.video').text('Image / Video');
                var input =$("<input name='extra_url' id='content_1' type='url' class='form-control' placeholder='Enter url' value='' style='display:none;'>");
                $('.content_link').append(input);
                $('#content_type').append('<option id="link" class="link" value="1">Link</option>');
            }
        }
    }
     function myFunction() {
      $(".file_value").val('');
    }
</script>
@endsection