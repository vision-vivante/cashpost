@extends('admin.default.layouts.app')

@section('content')

<div class="aiz-titlebar mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col">
			<h1 class="h3">{{ translate('Website Brand') }}</h1>
		</div>
	</div>
</div>
<div class="">

	<div class="card">
		<form action="{{ route('system_configuration.update') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="card-header">
				<h6 class="fw-600 mb-0">{{ translate('Banner Section') }}</h6>
				<div>
					<label class="aiz-switch mb-0">
						<input type="hidden" name="types[]" value="brand_slider_section_show">
						<input type="checkbox" name="brand_slider_section_show" @if( App\Models\SystemConfiguration::where('type', 'brand_slider_section_show')->first()->value == 'on') checked @endif>
						<span></span>
					</label>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>Title</label>
					<input type="hidden" name="types[]" value="brand_slider_section_title">
					<input type="text" class="form-control" placeholder="title" value="{{ App\Models\SystemConfiguration::where('type', 'brand_slider_section_title')->first()->value }}" name="brand_slider_section_title">
				</div>
				<div class="form-group">
					<label>Sub title</label>
					<input type="hidden" name="types[]" value="brand_slider_section_subtitle">
					<textarea class="aiz-text-editor form-control" data-buttons='[["font", ["bold", "underline", "italic"]],["insert", ["link"]],["para", ["ul", "ol"]],["view", ["fullscreen","undo","redo","codeview"]]]' placeholder="Type.." data-min-height="150"
					name="brand_slider_section_subtitle">
						@php
							echo App\Models\SystemConfiguration::where('type', 'brand_slider_section_subtitle')->first()->value
						@endphp
					</textarea>
				</div>
				<div class="form-group">
					<label class="form-label" for="signinSrEmail">{{ translate('Slider Images') }} <small class="text-muted">({{ translate('Recommended size') }} 1920x1080)</small></label>
					<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
						<div class="input-group-prepend">
							<div class="input-group-text bg-soft-secondary ">{{ translate('Browse') }}</div>
						</div>
						<div class="form-control file-amount">{{ translate('Choose Files') }}</div>
						<input type="hidden" name="types[]" value="brand_sliders">
						<input type="hidden" name="brand_sliders" value="{{ App\Models\SystemConfiguration::where('type', 'brand_sliders')->first()->value }}" class="selected-files">
					</div>
					<div class="file-preview box"></div>
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
				<h6 class="fw-600 mb-0">{{ translate('Clients Section') }}</h6>
				<div>
					<label class="aiz-switch mb-0">
						<input type="hidden" name="types[]" value="brand_client_logo_show">
						<input type="checkbox" name="brand_client_logo_show" @if( App\Models\SystemConfiguration::where('type', 'brand_client_logo_show')->first()->value == 'on') checked @endif>
						<span></span>
					</label>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label class="form-label" for="signinSrEmail">{{ translate('Clients Logos') }} <small class="text-muted">({{ translate('Recommended size') }} 190x80)</small></label>
					<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
						<div class="input-group-prepend">
							<div class="input-group-text bg-soft-secondary ">{{ translate('Browse') }}</div>
						</div>
						<div class="form-control file-amount">{{ translate('Choose Files') }}</div>
						<input type="hidden" name="types[]" value="brand_client_logos">
						<input type="hidden" name="brand_client_logos" value="{{ App\Models\SystemConfiguration::where('type', 'brand_client_logos')->first()->value }}" class="selected-files">
					</div>
					<div class="file-preview box sm"></div>
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
				<h6 class="fw-600 mb-0">{{ translate('How it Works Section') }}</h6>
				<div>
					<label class="aiz-switch mb-0">
						<input type="hidden" name="types[]" value="brand_how_it_works_show">
						<input type="checkbox"  name="brand_how_it_works_show"  @if( App\Models\SystemConfiguration::where('type', 'brand_how_it_works_show')->first()->value == 'on') checked @endif>
						<span></span>
					</label>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>{{ translate('Title') }}</label>
					<input type="hidden" name="types[]" value="brand_how_it_works_title">
					<input type="text" class="form-control" placeholder="title" name="brand_how_it_works_title" value="{{ App\Models\SystemConfiguration::where('type', 'brand_how_it_works_title')->first()->value }}">
				</div>
				<div class="form-group">
					<label>{{ translate('Sub title') }}</label>
					<input type="hidden" name="types[]" value="brand_how_it_works_subtitle">
					<textarea class="aiz-text-editor form-control" placeholder="Type.." name="brand_how_it_works_subtitle" data-buttons='[["font", ["bold", "underline", "italic"]],["insert", ["link"]],["para", ["ul", "ol"]],["view", ["undo","redo","codeview"]]]' placeholder="Type.." data-min-height="150">@php
							echo get_setting('brand_how_it_works_subtitle');
						@endphp
					</textarea>
				</div>
				<div class="card bg-light shadow-none">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Step 1') }}</h6>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-label">{{ translate('Image') }}</label>
							<div class="input-group" data-toggle="aizuploader" data-type="image">
								<div class="input-group-prepend">
									<div class="input-group-text bg-soft-secondary ">{{ translate('Browse') }}</div>
								</div>
								<div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="brand_how_it_works_banner_1">
								<input type="hidden" name="brand_how_it_works_banner_1" value="{{ get_setting('brand_how_it_works_banner_1') }}" class="selected-files">
							</div>
							<div class="file-preview"></div>
						</div>
						<div class="form-group">
							<label>{{ translate('About description') }}</label>
							<input type="hidden" name="types[]" value="brand_how_it_works_description_1">
							<textarea class="aiz-text-editor form-control" name="brand_how_it_works_description_1" placeholder="Type.." data-min-height="150">
								@php
									echo get_setting('brand_how_it_works_description_1');
								@endphp
							</textarea>
						</div>
					</div>
				</div>
				<div class="card bg-light shadow-none">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Step 2') }}</h6>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-label">{{ translate('Image') }}</label>
							<div class="input-group" data-toggle="aizuploader" data-type="image">
								<div class="input-group-prepend">
									<div class="input-group-text bg-soft-secondary ">{{ translate('Browse') }}</div>
								</div>
								<div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="brand_how_it_works_banner_2">
								<input type="hidden" name="brand_how_it_works_banner_2" value="{{ get_setting('brand_how_it_works_banner_2') }}" class="selected-files">
							</div>
							<div class="file-preview box"></div>
						</div>
						<div class="form-group">
							<label>{{ translate('About description') }}</label>
							<input type="hidden" name="types[]" value="brand_how_it_works_description_2">
							<textarea class="aiz-text-editor form-control" name="brand_how_it_works_description_2" placeholder="Type.." data-min-height="150">
								@php
									echo get_setting('brand_how_it_works_description_2');
								@endphp
							</textarea>
						</div>
					</div>
				</div>
				<div class="card bg-light shadow-none">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Step 3') }}</h6>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-label">{{ translate('Image') }}</label>
							<div class="input-group" data-toggle="aizuploader" data-type="image">
								<div class="input-group-prepend">
									<div class="input-group-text bg-soft-secondary ">{{ translate('Browse') }}</div>
								</div>
								<div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="brand_how_it_works_banner_3">
								<input type="hidden" name="brand_how_it_works_banner_3" value="{{ get_setting('brand_how_it_works_banner_3') }}" class="selected-files">
							</div>
							<div class="file-preview box"></div>
						</div>
						<div class="form-group">
							<label>{{ translate('About description') }}</label>
							<input type="hidden" name="types[]" value="brand_how_it_works_description_3">
							<textarea class="aiz-text-editor form-control" name="brand_how_it_works_description_3" placeholder="Type.." data-min-height="150">
								@php
									echo get_setting('brand_how_it_works_description_3');
								@endphp
							</textarea>
						</div>
					</div>
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
				<h6 class="fw-600 mb-0">{{ translate('Latest Project Section') }}</h6>
				<div>
					<label class="aiz-switch mb-0">
						<input type="hidden" name="types[]" value="brand_latest_project_show">
						<input type="checkbox"  name="brand_latest_project_show"  @if( get_setting('brand_latest_project_show') == 'on') checked @endif>
						<span></span>
					</label>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>{{ translate('Title') }}</label>
					<input type="hidden" name="types[]" value="brand_latest_project_title">
					<input type="text" class="form-control" placeholder="title" name="brand_latest_project_title" value="{{ App\Models\SystemConfiguration::where('type', 'brand_latest_project_title')->first()->value }}">
				</div>
				<div class="form-group">
					<label>{{ translate('Sub title') }}</label>
					<input type="hidden" name="types[]" value="brand_latest_project_subtitle">
					<textarea class="form-control resize-off" placeholder="Type.." name="brand_latest_project_subtitle">@php
							echo get_setting('brand_latest_project_subtitle');
						@endphp
					</textarea>
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
				<h6 class="fw-600 mb-0">{{ translate('Featured Category Section') }}</h6>
				<div>
					<label class="aiz-switch mb-0">
						<input type="hidden" name="types[]" value="brand_featured_category_show">
						<input type="checkbox"  name="brand_featured_category_show"  @if( App\Models\SystemConfiguration::where('type', 'brand_featured_category_show')->first()->value == 'on') checked @endif>
						<span></span>
					</label>
				</div>
			</div>
			<div class="card-body">
				<div class="card bg-light shadow-none">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Step 1') }}</h6>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label>{{ translate('Title') }}</label>
							<input type="hidden" name="types[]" value="brand_featured_category_title">
							<input type="text" class="form-control" placeholder="title" name="brand_featured_category_title" value="{{ App\Models\SystemConfiguration::where('type', 'brand_featured_category_title')->first()->value }}">
						</div>
						<div class="form-group">
							<label>{{ translate('Description') }}</label>
							<input type="hidden" name="types[]" value="brand_featured_category_description">
							<textarea class="aiz-text-editor form-control resize-off" placeholder="Type.." name="brand_featured_category_description">@php
									echo get_setting('brand_featured_category_description');
								@endphp</textarea>
						</div>
						<div class="form-group">
							<label class="form-label">{{ translate('Banner') }}</label>
							<div class="input-group" data-toggle="aizuploader" data-type="image">
								<div class="input-group-prepend">
									<div class="input-group-text bg-soft-secondary ">{{ translate('Browse') }}</div>
								</div>
								<div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="brand_featured_category_left_banner">
								<input type="hidden" name="brand_featured_category_left_banner" value="{{ App\Models\SystemConfiguration::where('type', 'brand_featured_category_left_banner')->first()->value }}" class="selected-files">
							</div>
							@php
								$value = App\Models\SystemConfiguration::where('type', 'brand_featured_category_left_banner')->first()->value;
							@endphp
							<div class="file-preview box"></div>
						</div>
					</div>
				</div>
				<div class="card bg-light shadow-none">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Step 2') }}</h6>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label>{{ translate('Title') }}</label>
							<input type="hidden" name="types[]" value="brand_featured_category_title_1">
							<input type="text" class="form-control" placeholder="title" name="brand_featured_category_title_1" value="{{get_setting('brand_featured_category_title_1')}}">
						</div>
						<div class="form-group">
							<label>{{ translate('Description') }}</label>
							<input type="hidden" name="types[]" value="brand_featured_category_description_1">
							<textarea class="aiz-text-editor form-control resize-off" placeholder="Type.." name="brand_featured_category_description_1">
								@php
									echo get_setting('brand_featured_category_description_1');
								@endphp
							</textarea>
						</div>
						<div class="form-group">
							<label class="form-label">{{ translate('Banner') }}</label>
							<div class="input-group" data-toggle="aizuploader" data-type="image">
								<div class="input-group-prepend">
									<div class="input-group-text bg-soft-secondary ">{{ translate('Browse') }}</div>
								</div>
								<div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="brand_featured_category_left_banner_1">
								<input type="hidden" name="brand_featured_category_left_banner_1" value="{{ get_setting('brand_featured_category_left_banner_1')}}" class="selected-files">
							</div>
							<div class="file-preview box"></div>
						</div>
						<div class="text-right">
							<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
		<div class="card">
		<form action="{{ route('system_configuration.update') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="card-header">
				<h6 class="fw-600 mb-0">{{ translate('Brand Testimonial Section') }}</h6>
				<div>
					<label class="aiz-switch mb-0">
						<input type="hidden" name="types[]" value="brand_testimonial_show">
						<input type="checkbox"  name="brand_testimonial_show" @if(get_setting('brand_testimonial_show') == 'on') checked @endif>
						<span></span>
					</label>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>{{ translate('Title') }}</label>
					<input type="hidden" name="types[]" value="brand_testimonial_title">
					<input type="text" class="form-control" placeholder="title" name="brand_testimonial_title" value="{{ get_setting('brand_testimonial_title') }}">
				</div>
				<div class="card bg-light shadow-none">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Step 1') }}</h6>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-label">{{ translate('Image') }}</label>
							<div class="input-group" data-toggle="aizuploader" data-type="image">
								<div class="input-group-prepend">
									<div class="input-group-text bg-soft-secondary ">{{ translate('Browse') }}</div>
								</div>
								<div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="brand_testimonial_banner_1">
								<input type="hidden" name="brand_testimonial_banner_1" value="{{ get_setting('brand_testimonial_banner_1') }}" class="selected-files">
							</div>
							<div class="file-preview"></div>
						</div>
						<div class="form-group">
							<label>{{ translate('About description') }}</label>
							<input type="hidden" name="types[]" value="brand_testimonial_description_1">
							<textarea class="aiz-text-editor form-control" name="brand_testimonial_description_1" placeholder="Type.." data-min-height="150">
								@php
									echo get_setting('brand_testimonial_description_1');
								@endphp
							</textarea>
						</div>
						<div class="form-group">
							<label>{{ translate('Name') }}</label>
							<input type="hidden" name="types[]" value="brand_testimonial_name_1">
							<textarea class="form-control" name="brand_testimonial_name_1" placeholder="Type.." data-min-height="150">
								@php
									echo get_setting('brand_testimonial_name_1');
								@endphp
							</textarea>
						</div>
					</div>
				</div>
				<div class="card bg-light shadow-none">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Step 2') }}</h6>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-label">{{ translate('Image') }}</label>
							<div class="input-group" data-toggle="aizuploader" data-type="image">
								<div class="input-group-prepend">
									<div class="input-group-text bg-soft-secondary ">{{ translate('Browse') }}</div>
								</div>
								<div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="brand_testimonial_banner_2">
								<input type="hidden" name="brand_testimonial_banner_2" value="{{ get_setting('brand_testimonial_banner_2') }}" class="selected-files">
							</div>
							<div class="file-preview box"></div>
						</div>
						<div class="form-group">
							<label>{{ translate('About description') }}</label>
							<input type="hidden" name="types[]" value="brand_testimonial_description_2">
							<textarea class="aiz-text-editor form-control" name="brand_testimonial_description_2" placeholder="Type.." data-min-height="150">
								@php
									echo get_setting('brand_testimonial_description_2');
								@endphp
							</textarea>
						</div>
						<div class="form-group">
							<label>{{ translate('Name') }}</label>
							<input type="hidden" name="types[]" value="brand_testimonial_name_2">
							<textarea class="form-control" name="brand_testimonial_name_2" placeholder="Type.." data-min-height="150">
								@php
									echo get_setting('brand_testimonial_name_2');
								@endphp
							</textarea>
						</div>
					</div>
				</div>
				<div class="card bg-light shadow-none">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Step 3') }}</h6>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-label">{{ translate('Image') }}</label>
							<div class="input-group" data-toggle="aizuploader" data-type="image">
								<div class="input-group-prepend">
									<div class="input-group-text bg-soft-secondary ">{{ translate('Browse') }}</div>
								</div>
								<div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="brand_testimonial_banner_3">
								<input type="hidden" name="brand_testimonial_banner_3" value="{{ get_setting('brand_testimonial_banner_3') }}" class="selected-files">
							</div>
							<div class="file-preview box"></div>
						</div>
						<div class="form-group">
							<label>{{ translate('About description') }}</label>
							<input type="hidden" name="types[]" value="brand_testimonial_description_3">
							<textarea class="aiz-text-editor form-control" name="brand_testimonial_description_3" placeholder="Type.." data-min-height="150">
								@php
									echo get_setting('brand_testimonial_description_3');
								@endphp
							</textarea>
						</div>
						<div class="form-group">
							<label>{{ translate('Name') }}</label>
							<input type="hidden" name="types[]" value="brand_testimonial_name_3">
							<textarea class="form-control" name="brand_testimonial_name_3" placeholder="Type.." data-min-height="150">
								@php
									echo get_setting('brand_testimonial_name_3');
								@endphp
							</textarea>
						</div>
					</div>
				</div>
				<div class="card bg-light shadow-none">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Step 4') }}</h6>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-label">{{ translate('Image') }}</label>
							<div class="input-group" data-toggle="aizuploader" data-type="image">
								<div class="input-group-prepend">
									<div class="input-group-text bg-soft-secondary ">{{ translate('Browse') }}</div>
								</div>
								<div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="brand_testimonial_banner_4">
								<input type="hidden" name="brand_testimonial_banner_4" value="{{ get_setting('brand_testimonial_banner_4') }}" class="selected-files">
							</div>
							<div class="file-preview box"></div>
						</div>
						<div class="form-group">
							<label>{{ translate('About description') }}</label>
							<input type="hidden" name="types[]" value="brand_testimonial_description_4">
							<textarea class="aiz-text-editor form-control" name="brand_testimonial_description_4" placeholder="Type.." data-min-height="150">
								@php
									echo get_setting('brand_testimonial_description_4');
								@endphp
							</textarea>
						</div>
						<div class="form-group">
							<label>{{ translate('Name') }}</label>
							<input type="hidden" name="types[]" value="brand_testimonial_name_4">
							<textarea class="form-control" name="brand_testimonial_name_4" placeholder="Type.." data-min-height="150">
								@php
									echo get_setting('brand_testimonial_name_4');
								@endphp
							</textarea>
						</div>
					</div>
				</div>
				<div class="card bg-light shadow-none">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Step 5') }}</h6>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-label">{{ translate('Image') }}</label>
							<div class="input-group" data-toggle="aizuploader" data-type="image">
								<div class="input-group-prepend">
									<div class="input-group-text bg-soft-secondary ">{{ translate('Browse') }}</div>
								</div>
								<div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="brand_testimonial_banner_5">
								<input type="hidden" name="brand_testimonial_banner_5" value="{{ get_setting('brand_testimonial_banner_5') }}" class="selected-files">
							</div>
							<div class="file-preview box"></div>
						</div>
						<div class="form-group">
							<label>{{ translate('About description') }}</label>
							<input type="hidden" name="types[]" value="brand_testimonial_description_5">
							<textarea class="aiz-text-editor form-control" name="brand_testimonial_description_5" placeholder="Type.." data-min-height="150">
								@php
									echo get_setting('brand_testimonial_description_5');
								@endphp
							</textarea>
						</div>
						<div class="form-group">
							<label>{{ translate('Name') }}</label>
							<input type="hidden" name="types[]" value="brand_testimonial_name_5">
							<textarea class="form-control" name="brand_testimonial_name_5" placeholder="Type.." data-min-height="150">
								@php
									echo get_setting('brand_testimonial_name_5');
								@endphp
							</textarea>
						</div>
					</div>
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
				<h6 class="fw-600 mb-0">{{ translate('Brand FAQ Section') }}</h6>
				<div>
					<label class="aiz-switch mb-0">
						<input type="hidden" name="types[]" value="brand_faq_show">
						<input type="checkbox"  name="brand_faq_show" @if( get_setting('brand_faq_show') == 'on') checked @endif>
						<span></span>
					</label>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>{{ translate('Title') }}</label>
					<input type="hidden" name="types[]" value="brand_faq_title">
					<input type="hidden" name="default_type" value="brand">
					<input type="text" class="form-control" placeholder="title" name="brand_faq_title" value="{{ get_setting('brand_faq_title') }}">
				</div>
				    @if(count($faqs))
						<div class="field_wrapper">
					    @foreach ( $faqs as $key =>$value)
									<div class="inner_wrapper">
										@if($key>0)
									    	<a href="javascript:void(0);" class="remove_button"><i class="la la-close"></i></a>
									    @endif
									    <div class="form-group">
									    	<label>{{ translate('Question') }}</label>
									        <input type="text" class="form-control" name="field_name[]" placeholder="question.." value="{{ $value->title }}"/>
									    </div>
									    <div class="form-group">
											<label>{{ translate('Answer') }}</label>
											<textarea class="form-control" name="description[]" placeholder="Type.." data-min-height="200">{{ $value->description}} 
											</textarea>
										</div>
									</div>
						@endforeach
					    </div>
					    <div class="add_button_cnt">
							<a href="javascript:void(0);" class="add_button" title="Add field"><i class="la la-plus"></i></a>
						</div>
					@else
						<div class="field_wrapper">
							<div class="inner_wrapper">
							    <div class="form-group">
							    	<label>{{ translate('Question') }}</label>
							        <input type="text" class="form-control" name="field_name[]" placeholder="question.." value=""/>
							    </div>
							    <div class="form-group">
									<label>{{ translate('Answer') }}</label>
									<textarea class="form-control" name="description[]" placeholder="Type.." data-min-height="200">
									</textarea>
								</div>
							</div>
						</div>
						<div class="add_button_cnt">
							<a href="javascript:void(0);" class="add_button" title="Add field"><i class="la la-plus"></i></a>
						</div>
					@endif
				</div>
			<div class="text-right">
				<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
			</div>
		</form>
	</div>
	<div class="card">
		<form action="{{ route('system_configuration.update') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="card-header">
				<h6 class="fw-600 mb-0">{{ translate('CTA Section') }}</h6>
				<div>
					<label class="aiz-switch mb-0">
						<input type="hidden" name="types[]" value="brand_cta_section_show">
						<input type="checkbox"  name="brand_cta_section_show" @if(App\Models\SystemConfiguration::where('type', 'brand_cta_section_show')->first()->value == 'on') checked @endif>
						<span></span>
					</label>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>{{ translate('Title') }}</label>
					<input type="hidden" name="types[]" value="brand_cta_section_title">
					<input type="text" class="form-control" placeholder="title" name="brand_cta_section_title" value="{{ App\Models\SystemConfiguration::where('type', 'brand_cta_section_title')->first()->value }}">
				</div>
				<div class="form-group">
					<label>{{ translate('Sub title') }}</label>
					<input type="hidden" name="types[]" value="brand_cta_section_subtitle">
					<textarea class="form-control resize-off" placeholder="Type.." name="brand_cta_section_subtitle">@php
							echo App\Models\SystemConfiguration::where('type', 'brand_cta_section_subtitle')->first()->value;
						@endphp</textarea>
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
				<h6 class="fw-600 mb-0">{{ translate('Seo Fields') }}</h6>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>{{ translate('Meta Title') }}</label>
					<input type="hidden" name="types[]" value="brand_meta_title">
					<input type="text" class="form-control" placeholder="Title" name="brand_meta_title" value="{{ App\Models\SystemConfiguration::where('type', 'brand_meta_title')->first()->value }}">
				</div>
				<div class="form-group">
					<label>{{ translate('Meta description') }}</label>
					<input type="hidden" name="types[]" value="brand_meta_description">
					<textarea class="resize-off form-control" placeholder="Description" name="brand_meta_description">@php
							echo App\Models\SystemConfiguration::where('type', 'brand_meta_description')->first()->value;
						@endphp</textarea>
				</div>
				<div class="form-group">
					<label>Keywords</label>
					<input type="hidden" name="types[]" value="brand_meta_keywords">
					<textarea class="resize-off form-control" placeholder="Keyword, Keyword" name="brand_meta_keywords">@php
							echo App\Models\SystemConfiguration::where('type', 'brand_meta_keywords')->first()->value;
						@endphp</textarea>
					<small class="text-muted">{{ translate('Separate with coma') }}</small>
				</div>
				<div class="form-group">
					<label class="form-label" for="signinSrEmail">{{ translate('Meta Image') }}</label>
					<div class="input-group " data-toggle="aizuploader" data-type="image">
						<div class="input-group-prepend">
							<div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
						</div>
						<div class="form-control file-amount">{{ translate('Choose File') }}</div>
						<input type="hidden" name="types[]" value="brand_meta_image">
						<input type="hidden" name="brand_meta_image" value="{{ App\Models\SystemConfiguration::where('type', 'brand_meta_image')->first()->value }}" class="selected-files">
					</div>
					<div class="file-preview box"></div>
				</div>
				<div class="text-right">
					<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
				</div>
			</div>
		</form>
	</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 20; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="inner_wrapper"><a href="javascript:void(0);" class="remove_button"><i class="la la-close"></i></a><div class="form-group"><label>{{ translate('Question') }}</label><input type="text" class="form-control" name="field_name[]" placeholder="question.." value=""/></div><div class="form-group"><label>{{ translate('Answer') }}</label><textarea class="form-control" name="description[]" placeholder="Type.." data-min-height="200"></textarea></div></div></div>'; 
    var x = 1; 
    $(addButton).click(function(){
        if(x < maxField){ 
            x++;
            $(wrapper).last('.inner_wrapper').append(fieldHTML); 
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div.inner_wrapper').remove();
    });
});
</script>
<style>
	a.add_button {
	    padding: 6px 16px;
	    background: #106210;
	    color: #fff;
	    text-decoration: none;
	}
	a.remove_button {
	    margin-bottom: 20px;
	    padding: 6px 16px;
	    background: #b52525;
	    color: #fff;
	    float: right;
	    text-decoration: none;
	}
	a.add_button:hover , a.remove_button:hover{
	    color: #fff;
	}
	.field_wrapper .inner_wrapper {
	    padding: 20px 0px;
	}
</style>
@endsection
