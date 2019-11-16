Good Morning {{$partner->first_name}},
Thank you for wanting to partner with Emmanuel TV. Kindly verify your email by clicking on the link below:
{{route('verify', $partner->verification_token)}}