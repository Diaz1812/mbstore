@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-20">

<div class="grid lg:grid-cols-2 gap-12">

{{-- LEFT --}}

<div>

<img
id="mainImage"
src="{{ asset('uploads/accounts/thumbnail/'.$account['thumbnail']) }}"
class="rounded-3xl w-full h-[500px] object-cover">

@if(count($account['gallery'])>0)

<div class="grid grid-cols-5 gap-3 mt-5">

@foreach($account['gallery'] as $image)

<img
src="{{ asset('uploads/accounts/gallery/'.$image) }}"
class="gallery cursor-pointer rounded-xl h-24 object-cover border-2 border-transparent hover:border-cyan-400">

@endforeach

</div>

@endif

</div>

{{-- RIGHT --}}

<div>

<span class="text-cyan-400">

{{ $account['game'] }}

</span>

<h1 class="text-5xl font-bold mt-4">

{{ $account['title'] }}

</h1>

<div class="text-4xl font-bold mt-6">

Rp{{ number_format($account['price'],0,',','.') }}

</div>

@if($account['status']=="available")

<div class="mt-5 text-green-400">

🟢 Available

</div>

@else

<div class="mt-5 text-red-400">

🔴 Sold

</div>

@endif

{{-- ML --}}

@if($account['game']=="Mobile Legends")

<div class="glass rounded-2xl p-6 mt-10">

<h2 class="font-bold text-2xl mb-5">

Informasi Akun

</h2>

<div class="grid grid-cols-2 gap-5">

<div>Rank</div>
<div>{{ $account['ml']['rank'] }}</div>

<div>Hero</div>
<div>{{ $account['ml']['hero'] }}</div>

<div>Skin</div>
<div>{{ $account['ml']['skin'] }}</div>

<div>Emblem</div>
<div>{{ $account['ml']['emblem'] }}</div>

<div>Starlight</div>
<div>{{ $account['ml']['starlight'] }}</div>

<div>Login</div>
<div>{{ $account['ml']['login'] }}</div>

<div>Bind</div>
<div>{{ $account['ml']['bind'] }}</div>

</div>

</div>

@endif

<div class="glass rounded-2xl p-6 mt-10">

<h2 class="font-bold text-2xl mb-4">

Deskripsi

</h2>

<p class="leading-8 whitespace-pre-line">

{{ $account['description'] }}

</p>

</div>

@if($account['status']=="available")

<a

<a
target="_blank"
href="https://wa.me/6282278953100?text={{ urlencode(
'Halo kak, saya ingin membeli akun ini.

🎮 '.$account['title'].'

💰 Harga : Rp'.number_format($account['price'],0,',','.').'

🔗 Link Akun :
'.url('/account/'.$account['id']).'

Apakah akun ini masih tersedia?'
) }}"
class="block text-center mt-10 bg-green-500 hover:bg-green-600 py-5 rounded-2xl font-bold text-xl">

Beli Sekarang

</a>

@else

<button

disabled

class="w-full mt-10 bg-gray-600 py-5 rounded-2xl">

Sold Out

</button>

@endif

</div>

</div>

</div>

<script>

const main=document.getElementById('mainImage');

document.querySelectorAll('.gallery').forEach(img=>{

img.onclick=()=>{

main.src=img.src;

}

});

</script>

@endsection