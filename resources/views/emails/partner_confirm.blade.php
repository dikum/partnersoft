Good Morning {{$partner->first_name}},
Please click on the link below to confirm your new Email Address:
{{route('verify', $partner->verification_token)}}