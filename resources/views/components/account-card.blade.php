@props([
    'id',
    'image',
    'game',
    'title',
    'price',
    'status'
])

<div
     class="account-card glass rounded-3xl overflow-hidden relative hover:-translate-y-3 hover:shadow-2xl transition duration-500"
    data-game="{{ strtolower($game) }}"
    data-price="{{ $price }}"
    data-status="{{ strtolower($status) }}"
    data-title="{{ strtolower($title) }}">

    <img
        src="{{ asset('uploads/accounts/thumbnail/'.$image) }}"
        class="w-full h-64 object-cover hover:scale-110 transition duration-500">

    <div class="p-6">

        <span class="inline-block bg-cyan-400/20 text-cyan-300 px-3 py-1 rounded-full text-sm">

🎮 {{ $game }}

</span>

        <h3 class="text-2xl font-bold mt-2">

            {{ $title }}

        </h3>

        <div class="flex gap-1 mt-3 text-yellow-400">

⭐ ⭐ ⭐ ⭐ ⭐

</div>

        <div class="mt-4 flex items-center justify-between">

            <h4 class="text-4xl text-cyan-300 font-bold">

                Rp{{ number_format($price,0,',','.') }}

            </h4>

            @if($status=="available")

<div class="absolute top-4 right-4 bg-green-500 px-3 py-1 rounded-full text-sm font-bold z-10">

    Available

</div>

@else

<div class="absolute top-4 right-4 bg-red-500 px-3 py-1 rounded-full text-sm font-bold z-10">

    SOLD

</div>

@endif

        </div>

        <div class="flex gap-3 mt-6">

            <a

href="/account/{{ $id }}"

class="flex-1 border border-cyan-300 rounded-xl py-3 text-center hover:bg-cyan-300 hover:text-black transition">

Detail

</a>


            @if($status=="available")

            @php
$message = urlencode(
"Halo MB Store 👋

Saya tertarik membeli akun berikut.

🎮 Game : {$game}
📌 Judul : {$title}
💰 Harga : Rp".number_format($price,0,',','.')."

🔗 Link Akun :
".url('/account/'.$id)."

Mohon info apakah akun ini masih tersedia.
Terima kasih."
);
@endphp

<a
href="https://wa.me/6282278953100?text={{ $message }}"
target="_blank"
class="flex-1 bg-gradient-to-r from-green-500 to-green-600 rounded-xl py-3 font-bold hover:scale-105 transition text-center">

Beli

</a>

            @else

            <button
                disabled
                class="flex-1 bg-gray-600 rounded-xl py-3">

                Sold

            </button>

            @endif
<div class="h-1 bg-gradient-to-r from-cyan-400 to-blue-500"></div>
        </div>

    </div>

</div>