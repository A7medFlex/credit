@if($stories)
    <x-default-layout :data="$stories" :name="$name" :allusers="$allusers"></x-default-layout>
@endif
