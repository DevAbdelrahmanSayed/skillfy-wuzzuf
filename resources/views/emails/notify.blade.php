<x-mail::message>
# Introduction

Congratulations! you are a premium user :)
<p>Your purchase details:</p>
    <p>Plan: {{$plan}}</p>
    <p>Your plan ends on : {{$billingEnds}}</p>

Thanks<br>
{{ config('app.name') }}
</x-mail::message>
