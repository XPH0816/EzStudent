<x-mail::message>
# Password Resetted

This email confirms that your password for {{ config('app.name') }} was successfully reset at {{ now() }}.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
