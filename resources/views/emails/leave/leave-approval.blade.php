@component('mail::message')
    # Hi {{ $leave->users->firstname }}

    Your leave request with reference number {{ $leave->reference_no }} has been approved by the Company Admin. Login to your dashboard to see status.





    Thanks,
    EMS Team
@endcomponent
