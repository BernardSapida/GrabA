<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'YrockReportingApp')
<img src="https://yrockwebreporting.host/public/images/yrock_scav_logo.png" class="logo" alt="{{config('app.name')}}">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
