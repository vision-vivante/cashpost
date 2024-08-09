@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<th class="column" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td class="img m-center" style=" font-size:0pt; line-height:0pt; text-align:left;"><img src="{{email_logo('other')}}" style="max-width: 150px; width:100%; object-fit:cover;  " border="0" alt="" /></td>
				</tr>
			</table>
		</th>
		<th class="column-empty" width="1" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;"></th>
		<th class="column" width="120" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
			
		</th>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="separator" style="padding-top: 40px; border-bottom:4px solid #000000; font-size:0pt; line-height:0pt;">&nbsp;</td>
	</tr>
</table>
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}
{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
