Good Morning {{$user->name}},
Thank you for wanting to partner with Emmanuel TV. Kindly verify your email by clicking on the link below:
{{route('verify', $user->verification_token)}}