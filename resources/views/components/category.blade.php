<section class="py-24">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center">

            <span class="glass px-5 py-2 rounded-full text-sm">

                🎮 Kategori Game

            </span>

            <h2 class="text-4xl font-bold mt-6">

                Pilih Game Favoritmu

            </h2>

            <p class="text-white/70 mt-4">

                Kami menyediakan akun Mobile Legends dan Free Fire
                dengan kualitas terbaik.

            </p>

        </div>

        <div class="grid md:grid-cols-2 gap-8 mt-16">

            <!-- Mobile Legends -->

            <div
                class="glass rounded-3xl p-10 hover:scale-105 transition duration-300">

                <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center">

    <img
        src="{{ asset('images/mlku.jpg') }}"
        alt="Mobile Legends"
        class="object-contain">

</div>

                <h3 class="text-3xl font-bold mt-6">

                    Mobile Legends

                </h3>

                <p class="text-white/70 mt-3">

                    Mythic • Immortal • Sultan Account

                </p>

                <a
    href="/home?game=mobile%20legends#catalog"
    class="mt-8 inline-block bg-white text-[#2933B1] px-6 py-3 rounded-xl font-semibold hover:scale-105 transition">

    Lihat Akun

</a>

            </div>

            <!-- Free Fire -->

            <div
                class="glass rounded-3xl p-10 hover:scale-105 transition duration-300">

                <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center">

    <img
        src="{{ asset('images/free.jfif') }}"
        alt="Free Fire"
        class="object-contain">

</div>

                <h3 class="text-3xl font-bold mt-6">

                    Free Fire

                </h3>

                <p class="text-white/70 mt-3">

                    Sultan • Evo Gun • Bundle Langka

                </p>

                <a
    href="/home?game=free%20fire#catalog"
    class="mt-8 inline-block bg-white text-[#2933B1] px-6 py-3 rounded-xl font-semibold hover:scale-105 transition">

    Lihat Akun

</a>

            </div>

        </div>

    </div>
<script>
function filterGame(game){

    // scroll ke katalog
    document.getElementById('catalog').scrollIntoView({
        behavior: 'smooth'
    });

    // pilih game pada dropdown katalog
    const select = document.getElementById('gameFilter');

    if(select){

        select.value = game;

        // jalankan filter jika fungsi tersedia
        if(typeof filterAccounts === 'function'){
            filterAccounts();
        }else if(typeof filter === 'function'){
            filter();
        }

    }

}
</script>
</section>