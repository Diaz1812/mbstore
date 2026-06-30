@extends('layouts.app')

@section('content')

<div
    id="splash"
    class="fixed inset-0 flex flex-col items-center justify-center bg-[#2933B1] transition-opacity duration-700">

    <img
        src="{{ asset('images/logo.png') }}"
        class="w-56 animate-logo"
        alt="Logo">

    <p class="mt-8 text-white text-sm tracking-[6px]">

        LOADING...

    </p>

    <div class="mt-4 w-48 h-1 bg-white/20 rounded-full overflow-hidden">

        <div class="loading-bar h-full"></div>

    </div>

</div>

<script>

window.onload = function(){

    setTimeout(() => {

        const splash=document.getElementById("splash");

        splash.style.opacity="0";

        setTimeout(()=>{

            window.location.href="/home";

        },700);

    },2500);

}

</script>

@endsection