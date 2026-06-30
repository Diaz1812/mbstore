<div class="w-72 bg-[#1A2275] border-r border-white/10">

    <div class="p-8">

        <div class="flex items-center gap-4">

            <img
                src="{{ asset('images/logo.png') }}"
                class="w-14">

            <div>

                <h2 class="font-bold text-xl">

                    MB STORE

                </h2>

                <p class="text-sm text-white/50">

                    ADMIN PANEL

                </p>

            </div>

        </div>

    </div>

    <div class="px-5 space-y-3">

        <a
            href="/admin/dashboard"
            class="flex items-center px-5 py-4 rounded-xl bg-white/10 hover:bg-cyan-500 transition">

            🏠 Dashboard

        </a>

        <a
href="/admin/testimonials"
class="block py-3 px-4 rounded-xl hover:bg-white/10">

⭐ Testimoni

</a>

        <a
            href="/admin/accounts"
            class="flex items-center px-5 py-4 rounded-xl hover:bg-white/10 transition">

            🎮 Kelola Akun

        </a>

        <a
            href="/admin/create"
            class="flex items-center px-5 py-4 rounded-xl hover:bg-white/10 transition">

            ➕ Tambah Akun

        </a>

       <form action="/admin/logout" method="POST">

    @csrf

    <button
        class="w-full text-left px-5 py-4 rounded-xl hover:bg-red-500 transition">

        🚪 Logout

    </button>

</form>

    </div>

</div>