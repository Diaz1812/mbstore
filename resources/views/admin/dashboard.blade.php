@extends('admin.layouts.app')

@section('content')

<div class="flex justify-between items-center mb-10">

<div>

<h1 class="text-4xl font-bold">

Dashboard

</h1>

<p class="text-white/60">

Kelola semua akun MB Store

</p>

</div>

<a
href="/admin/create"
class="bg-cyan-400 text-black px-6 py-4 rounded-xl font-bold">

+ Tambah Akun

</a>

</div>

{{-- Statistik --}}

<div class="grid md:grid-cols-5 gap-5 mb-10">

<div class="glass rounded-2xl p-6">

<h3 class="text-white/60">

Total

</h3>

<p class="text-4xl font-bold mt-3">

{{ $stats['total'] }}

</p>

</div>

<div class="glass rounded-2xl p-6">

<h3 class="text-white/60">

Mobile Legends

</h3>

<p class="text-4xl font-bold mt-3">

{{ $stats['ml'] }}

</p>

</div>

<div class="glass rounded-2xl p-6">

<h3 class="text-white/60">

Free Fire

</h3>

<p class="text-4xl font-bold mt-3">

{{ $stats['ff'] }}

</p>

</div>

<div class="glass rounded-2xl p-6">

<h3 class="text-white/60">

Sold

</h3>

<p class="text-4xl font-bold mt-3 text-red-400">

{{ $stats['sold'] }}

</p>

</div>

<div class="glass rounded-2xl p-6">

<h3 class="text-white/60">

Available

</h3>

<p class="text-4xl font-bold mt-3 text-green-400">

{{ $stats['available'] }}

</p>

</div>

</div>

{{-- Search Filter --}}

<div class="glass rounded-2xl p-6 mb-8">

<div class="grid md:grid-cols-3 gap-5">

<input
id="search"
type="text"
placeholder="Cari akun..."
class="bg-white/10 rounded-xl p-4">

<select
id="gameFilter"
class="bg-white/10 rounded-xl p-4">

<option value="">Semua Game</option>

<option value="Mobile Legends">

Mobile Legends

</option>

<option value="Free Fire">

Free Fire

</option>

</select>

<select
id="statusFilter"
class="bg-white/10 rounded-xl p-4">

<option value="">Semua Status</option>

<option value="available">

Available

</option>

<option value="sold">

Sold

</option>

</select>

</div>

</div>

{{-- Table --}}

<div class="glass rounded-3xl overflow-hidden">

<table class="w-full">

<thead class="bg-white/10">

<tr>

<th class="p-5">Foto</th>

<th>Judul</th>

<th>Game</th>

<th>Harga</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

@foreach($accounts as $account)

<tr class="account-row border-t border-white/10"

data-title="{{ strtolower($account['title']) }}"

data-game="{{ $account['game'] }}"

data-status="{{ $account['status'] }}">

<td class="p-4">

<img
src="{{ asset('uploads/accounts/thumbnail/'.$account['thumbnail']) }}"
class="w-24 rounded-xl">

</td>

<td>

{{ $account['title'] }}

</td>

<td>

{{ $account['game'] }}

</td>

<td>

Rp{{ number_format($account['price'],0,',','.') }}

</td>

<td>

@if($account['status']=="available")

<span class="text-green-400">

Available

</span>

@else

<span class="text-red-400">

Sold

</span>

@endif

</td>

<td>

<div class="flex gap-2">

<a
href="/account/{{ $account['id'] }}"
target="_blank"
class="bg-blue-500 px-3 py-2 rounded">

Lihat

</a>

<a
href="/admin/edit/{{ $account['id'] }}"
class="bg-yellow-500 px-3 py-2 rounded">

Edit

</a>

<form
action="/admin/delete/{{ $account['id'] }}"
method="POST">

@csrf

@method('DELETE')

<button
onclick="return confirm('Hapus akun ini?')"
class="bg-red-500 px-3 py-2 rounded">

Hapus

</button>

</form>

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<script>

const rows=document.querySelectorAll('.account-row');

function filter(){

const search=document.getElementById('search').value.toLowerCase();

const game=document.getElementById('gameFilter').value;

const status=document.getElementById('statusFilter').value;

rows.forEach(row=>{

let show=true;

if(search!=""){

if(!row.dataset.title.includes(search))

show=false;

}

if(game!=""){

if(row.dataset.game!=game)

show=false;

}

if(status!=""){

if(row.dataset.status!=status)

show=false;

}

row.style.display=show?'':'none';

});

}

search.onkeyup=filter;

gameFilter.onchange=filter;

statusFilter.onchange=filter;

</script>

@endsection