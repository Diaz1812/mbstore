<nav class="fixed top-0 left-0 w-full z-50 bg-[#2933B1]/80 backdrop-blur-lg border-b border-white/10">

    <div class="max-w-7xl mx-auto px-5 py-4 flex items-center justify-between">

        {{-- Logo --}}
        <a href="/home" class="flex items-center gap-3">

            <img
                src="{{ asset('images/logo.png') }}"
                class="w-12">

            <span class="font-bold text-xl">

                MB STORE

            </span>

        </a>

        {{-- Desktop Menu --}}
        <div class="hidden md:flex items-center gap-8">

            <a href="/home" class="hover:text-cyan-300 transition">
                Home
            </a>

            <a href="/home#catalog" class="hover:text-cyan-300 transition">
                Katalog
            </a>

            <a href="/testimonials" class="hover:text-cyan-300 transition">
                Testimoni
            </a>

            <a
                href="/testimonial"
                class="bg-cyan-400 text-black px-5 py-2 rounded-xl font-semibold hover:scale-105 transition">

                Kirim Testimoni

            </a>

        </div>

        {{-- Hamburger --}}
        <button
            id="menuBtn"
            class="md:hidden text-3xl">

            ☰

        </button>

    </div>

    {{-- Mobile Menu --}}
    <div
        id="mobileMenu"
        class="hidden md:hidden bg-[#222D9D] border-t border-white/10">

        <a
            href="/home"
            class="block px-6 py-4 hover:bg-white/10">

            Home

        </a>

        <a
            href="/home#catalog"
            class="block px-6 py-4 hover:bg-white/10">

            Katalog

        </a>

        <a
            href="/testimonials"
            class="block px-6 py-4 hover:bg-white/10">

            Testimoni

        </a>

        <a
            href="/testimonial"
            class="block px-6 py-4 hover:bg-white/10">

            Kirim Testimoni

        </a>

    </div>

</nav>

<script>

const menuBtn = document.getElementById("menuBtn");
const mobileMenu = document.getElementById("mobileMenu");

menuBtn.addEventListener("click", () => {

    mobileMenu.classList.toggle("hidden");

    menuBtn.innerHTML =
        mobileMenu.classList.contains("hidden")
        ? "☰"
        : "✕";

});

</script>