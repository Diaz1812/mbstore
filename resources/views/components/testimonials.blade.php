@props(['testimonials'])

<section class="py-28">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center">

            <span class="glass px-5 py-2 rounded-full">

                ⭐ Testimoni

            </span>

            <h2 class="text-5xl font-bold mt-6">

                Apa Kata Pembeli?

            </h2>

            <p class="text-white/70 mt-4">

                Terima kasih kepada semua pelanggan MB Store.

            </p>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-14">

            @forelse($testimonials as $item)

            <div class="glass rounded-3xl p-8">

                @if(!empty($item['photo']))

                <img
                    src="{{ asset('uploads/testimonials/'.$item['photo']) }}"
                    class="rounded-xl h-52 w-full object-cover mb-5">

                @endif

                <div class="text-yellow-400 text-xl">

                    @for($i=1;$i<=$item['rating'];$i++)

                        ⭐

                    @endfor

                </div>

                <p class="text-white/80 mt-5 leading-8">

                    "{{ $item['message'] }}"

                </p>

                <hr class="border-white/10 my-6">

                <h3 class="font-bold text-xl">

                    {{ $item['name'] }}

                </h3>

                <p class="text-cyan-300">

                    {{ $item['game'] }}

                </p>

            </div>

            @empty

            <div class="col-span-3 text-center py-20">

                Belum ada testimoni.

            </div>

            @endforelse

        </div>

    </div>

</section>