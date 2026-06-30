@extends('layouts.app')

@section('content')

<section class="min-h-screen py-20">

    <div class="max-w-3xl mx-auto px-6">

        <div class="glass rounded-3xl p-10">

            <div class="text-center mb-10">

                <h1 class="text-5xl font-bold">

                    ⭐ Kirim Testimoni

                </h1>

                <p class="text-white/70 mt-4">

                    Terima kasih telah berbelanja di MB Store.
                    Berikan pengalamanmu agar pembeli lain semakin yakin.

                </p>

            </div>

            @if ($errors->any())

                <div class="bg-red-500/20 border border-red-500 rounded-xl p-4 mb-6">

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form
                action="/testimonial"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6">

                @csrf

                {{-- Nama --}}

                <div>

                    <label class="font-semibold">

                        Nama

                    </label>

                    <input
                        type="text"
                        name="name"
                        class="w-full bg-white/10 rounded-xl p-4 mt-2"
                        placeholder="Masukkan nama">

                </div>

                {{-- Game --}}

                <div>

                    <label class="font-semibold">

                        Game

                    </label>

                    <select
                        name="game"
                        class="w-full bg-black rounded-xl p-4 mt-2">

                        <option value="Mobile Legends">

                            Mobile Legends

                        </option>

                        <option value="Free Fire">

                            Free Fire

                        </option>

                    </select>

                </div>

                {{-- Rating --}}

                <div>

                    <label class="font-semibold">

                        Rating

                    </label>

                    <select
                        name="rating"
                        class="w-full bg-black rounded-xl p-4 mt-2">

                        <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                        <option value="4">⭐⭐⭐⭐ (4)</option>
                        <option value="3">⭐⭐⭐ (3)</option>
                        <option value="2">⭐⭐ (2)</option>
                        <option value="1">⭐ (1)</option>

                    </select>

                </div>

                {{-- Testimoni --}}

                <div>

                    <label class="font-semibold">

                        Testimoni

                    </label>

                    <textarea
                        name="message"
                        rows="6"
                        class="w-full bg-white/10 rounded-xl p-4 mt-2"
                        placeholder="Bagaimana pengalaman Anda berbelanja di MB Store?"></textarea>

                </div>

                {{-- Upload Screenshot --}}

                <div>

                    <label class="font-semibold">

                        Screenshot Chat (Opsional)

                    </label>

                    <input
                        id="photo"
                        type="file"
                        name="photo"
                        accept="image/*"
                        class="w-full bg-white/10 rounded-xl p-3 mt-2">

                    <img
                        id="preview"
                        class="hidden mt-5 rounded-xl w-64">

                </div>

                <button
                    class="w-full bg-cyan-400 hover:bg-cyan-300 text-black font-bold py-4 rounded-xl">

                    Kirim Testimoni

                </button>

            </form>

        </div>

    </div>

</section>

<script>

const photo = document.getElementById('photo');

const preview = document.getElementById('preview');

photo.onchange = e => {

    preview.src = URL.createObjectURL(e.target.files[0]);

    preview.classList.remove('hidden');

}

</script>

@endsection