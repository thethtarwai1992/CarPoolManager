@component('mail::message') 

@if (count($data) == 0)
# Whoops!
@else
 Hi {{ $data->driver->first_name }},
@endif 

{{-- Intro Lines --}}
Passenger book from your scheduled post.  
Please check your detail in {{ URL::to('driver/task') }}.  


From: {{ $data->pickup }} 
To : {{ $data->destination }}  
Price : ${{ $data->price }}
 
 
Regards, 
Team Carpooling Manager  