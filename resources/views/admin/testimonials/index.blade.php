@extends('admin.layouts.app')

@section('content')

<div class="flex justify-between items-center mb-10">

    <div>

        <h1 class="text-4xl font-bold">

            Testimoni

        </h1>

        <p class="text-white/60">

            Kelola semua testimoni pelanggan

        </p>

    </div>

</div>

@if(session('success'))

<div class="bg-green-500 text-white rounded-xl p-4 mb-6">

    {{ session('success') }}

</div>

@endif

<div class="glass rounded-3xl overflow-hidden">

<table class="w-full">

<thead class="bg-white/10">

<tr>

<th class="p-4">Foto</th>

<th>Nama</th>

<th>Game</th>

<th>Rating</th>

<th>Testimoni</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

@forelse($testimonials as $item)

<tr class="border-t border-white/10">

<td class="p-4">

@if(!empty($item['photo']))

<img
src="{{ asset('uploads/testimonials/'.$item['photo']) }}"
class="w-24 rounded-xl">

@else

-

@endif

</td>

<td>

{{ $item['name'] }}

</td>

<td>

{{ $item['game'] }}

</td>

<td>

@for($i=1;$i<=$item['rating'];$i++)

⭐

@endfor

</td>

<td style="max-width:300px">

{{ $item['message'] }}

</td>

<td>

@if($item['status']=="approved")

<span class="text-green-400">

Approved

</span>

@else

<span class="text-yellow-300">

Pending

</span>

@endif

</td>

<td>

<div class="flex gap-2">

@if($item['status']=="pending")

<form
action="/admin/testimonials/approve/{{ $item['id'] }}"
method="POST">

@csrf

@method('PUT')

<button
class="bg-green-500 px-3 py-2 rounded">

Approve

</button>

</form>

@endif

<form
action="/admin/testimonials/delete/{{ $item['id'] }}"
method="POST">

@csrf

@method('DELETE')

<button
onclick="return confirm('Hapus testimoni?')"
class="bg-red-500 px-3 py-2 rounded">

Hapus

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="7" class="text-center py-10">

Belum ada testimoni.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

@endsection