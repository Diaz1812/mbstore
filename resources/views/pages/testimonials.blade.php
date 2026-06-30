@extends('layouts.app')

@section('content')

<x-navbar />

<section class="py-24 min-h-screen">

    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center mb-16">

            <span class="glass px-5 py-2 rounded-full">

                ⭐ Testimoni Pelanggan

            </span>

            <h1 class="text-5xl font-bold mt-6">

                Apa Kata Pembeli?

            </h1>

            <p class="text-white/70 mt-4">

                Semua testimoni di bawah ini berasal dari pembeli yang telah
                memberikan ulasan.

            </p>

        </div>

        @if($testimonials->count())

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($testimonials as $item)

            <div class="glass rounded-3xl p-8">

                <div class="flex justify-between items-center">

                    <h3 class="font-bold text-xl">

                        {{ $item['name'] }}

                    </h3>

                    <span class="text-cyan-300">

                        {{ $item['game'] }}

                    </span>

                </div>

                <div class="mt-4 text-yellow-400 text-xl">

                    @for($i=1;$i<=$item['rating'];$i++)
                        ⭐
                    @endfor

                </div>

                <p class="mt-6 text-white/80">

                    "{{ $item['message'] }}"

                </p>

            </div>

            @endforeach

        </div>

        @else

        <div class="text-center py-20">

            <h2 class="text-3xl font-bold">

                Belum ada testimoni.

            </h2>

        </div>

        @endif

    </div>

</section>

@endsection