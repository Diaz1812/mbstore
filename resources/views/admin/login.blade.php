<form method="POST" action="/admin/login">

    @csrf

    <input
        name="username"
        type="text"
        placeholder="Username"
        class="w-full bg-white/10 rounded-xl p-4 mb-5">

    <input
        name="password"
        type="password"
        placeholder="Password"
        class="w-full bg-white/10 rounded-xl p-4 mb-6">

    @if(session('error'))

        <div class="text-red-400 mb-4">

            {{ session('error') }}

        </div>

    @endif

    <button
        class="w-full bg-cyan-400 text-black rounded-xl p-4 font-bold">

        Login

    </button>

</form>