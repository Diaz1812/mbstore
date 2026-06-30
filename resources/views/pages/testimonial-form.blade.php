@extends('layouts.app')

@section('content')

<x-navbar />

<section class="py-24 min-h-screen">

<div class="max-w-3xl mx-auto px-6">

<div class="glass rounded-3xl p-10">

<h1 class="text-4xl font-bold mb-8">

Beri Testimoni

</h1>

<form action="/testimonial/store" method="POST">

@csrf

<div class="space-y-6">

<div>

<label>Nama</label>

<input
type="text"
name="name"
class="w-full bg-white/10 rounded-xl p-4 mt-2"
required>

</div>

<div>

<label>Game</label>

<select
name="game"
class="w-full bg-black rounded-xl p-4 mt-2">

<option>Mobile Legends</option>

<option>Free Fire</option>

</select>

</div>

<div>

<label>Rating</label>

<select
name="rating"
class="w-full bg-black rounded-xl p-4 mt-2">

<option value="5">⭐⭐⭐⭐⭐</option>

<option value="4">⭐⭐⭐⭐</option>

<option value="3">⭐⭐⭐</option>

<option value="2">⭐⭐</option>

<option value="1">⭐</option>

</select>

</div>

<div>

<label>Testimoni</label>

<textarea
name="message"
rows="5"
class="w-full bg-white/10 rounded-xl p-4 mt-2"
required></textarea>

</div>

<button
class="bg-cyan-400 text-black px-8 py-4 rounded-xl font-bold">

Kirim Testimoni

</button>

</div>

</form>

</div>

</div>

</section>

@endsection