@component('mail::message')
# Hello {{ $userName }},

Your time capsule message has been activated!

**Message Preview**:  
"{{ \Illuminate\Support\Str::limit($capsule->message, 100) }}"

**Reveal Date**: {{ $activationDate }}

Thank you for using Time-Capsule.

@endcomponent
