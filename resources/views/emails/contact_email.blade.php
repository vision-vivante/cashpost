@include('emails.header_email')
	<!-- Intro -->
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
		<tr>
			<th  style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px;padding-top: 12px;"> User Enquiry <!-- : {{ $first_name }}  {{ $last_name }} --><br><br></th>
		</tr>
		<tr>
			<td class="p30-15" style="padding: 40px 30px 70px 30px;">
				<table style="white-space: nowrap;" width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<th  style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#000000; padding-bottom:16px;">Name:</th>
						<td class="h2 center pb10" style="color:#000000; font-family:'Ubuntu', Arial,sans-serif; font-size:15px; text-align:left; padding-bottom:16px;">{{ $first_name }}  {{ $last_name }}</td>
					</tr>
					<tr>
						<th  style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#000000; padding-bottom:16px;">Email:</th>
						<td class="h5 center blue pb30" style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#000; padding-bottom:16px;">{{$email}} </td>
					</tr>
					<tr>
						<th style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#000000; padding-bottom:16px;">Company Name:</th>
						<td class="h5 center blue pb30" style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#000; padding-bottom:16px;">{{$company_name}} </td>
					</tr>
					<tr>
						<th style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#000000; padding-bottom:16px;">Phone Number:</th>
						<td class="h5 center blue pb30" style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#000; padding-bottom:16px;">{{$phone_number}} </td>
					</tr>	
					<tr>
						<th style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#000000; padding-bottom:16px;">Help</th>
						<td class="h5 center blue pb30" style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#000; padding-bottom:16px;">{{$help}} </td>
					</tr>	
					<tr>
						<th  style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#000000; padding-bottom:16px;">Message</th>
						<td class="h5 center blue pb30" style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#000; padding-bottom:16px;">{{$user_message}} </td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<!-- END Intro -->

@include('emails.footer_email')