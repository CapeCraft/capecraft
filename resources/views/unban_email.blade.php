@component('mail::message')
# {{$unbanRequest->username}} - Unban Request
    {{$unbanRequest->uuid}}
    {{$unbanRequest->email}}

**Location**<br>
{{ucfirst($unbanRequest->ban_type)}}

@if($unbanRequest->platform != null)
**Platform**<br>
{{ucfirst($unbanRequest->platform)}}
@endif

**What happened before you were banned?**<br>
{{$unbanRequest->before_ban}}

**Why should we unban you?**<br>
{{$unbanRequest->why_unban}}

**What will you do to avoid being banned again?**<br>
{{$unbanRequest->what_different}}

Thanks,<br>
{{$unbanRequest->username}}
@endcomponent