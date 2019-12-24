Good Morning {{$user->first_name}},
Please click on the link below to confirm your new Email Address:
{{route('verify', $user->verification_token)}}