@extends('admin.layouts.app')

@section('content')

<h1 class="text-4xl font-bold mb-8">
    Tambah Akun
</h1>

<form
action="/admin/store"
method="POST"
enctype="multipart/form-data"
class="glass rounded-3xl p-8 space-y-6">

@csrf

{{-- Game --}}
<div>
    <label class="font-semibold">Game</label>

    <select
        id="game"
        name="game"
        class="w-full bg-black/100 rounded-xl p-4 mt-2">

        <option value="Mobile Legends">
            Mobile Legends
        </option>

        <option value="Free Fire">
            Free Fire
        </option>

    </select>
</div>

{{-- Judul --}}
<div>
    <label class="font-semibold">Judul Akun</label>

    <input
        type="text"
        name="title"
        class="w-full bg-white/10 rounded-xl p-4 mt-2">
</div>

{{-- Harga --}}
<div>
    <label class="font-semibold">Harga</label>

    <input
        type="number"
        name="price"
        class="w-full bg-white/10 rounded-xl p-4 mt-2">
</div>

{{-- Status --}}
<div>
    <label class="font-semibold">Status</label>

    <select
        name="status"
        class="w-full bg-black/100 rounded-xl p-4 mt-2">

        <option value="available">
            Available
        </option>

        <option value="sold">
            Sold
        </option>

    </select>
</div>

<hr class="border-white/20">

<h2 class="text-2xl font-bold">
    Gambar Akun
</h2>

{{-- Thumbnail --}}
<div>

<label class="font-semibold">
Thumbnail Utama
</label>

<input
id="thumbnail"
type="file"
name="thumbnail"
accept="image/*"
class="w-full bg-white/10 rounded-xl p-3 mt-2">

<img
id="thumbnailPreview"
class="hidden mt-4 rounded-xl w-56">

</div>

{{-- Gallery --}}
<div>

<label class="font-semibold">
Gallery Screenshot
</label>

<input
id="gallery"
type="file"
name="gallery[]"
multiple
accept="image/*"
class="w-full bg-white/10 rounded-xl p-3 mt-2">

<div
id="galleryPreview"
class="grid grid-cols-5 gap-4 mt-4">

</div>

</div>

<hr class="border-white/20">

{{-- Mobile Legends --}}
<div id="mlFields">

<h2 class="text-2xl font-bold mb-5">
Informasi Mobile Legends
</h2>

<div class="grid md:grid-cols-2 gap-5">

<div>

<label>Rank</label>

<input
type="text"
name="rank"
class="w-full bg-white/10 rounded-xl p-3 mt-2">

</div>

<div>

<label>Hero</label>

<input
type="number"
name="hero"
class="w-full bg-white/10 rounded-xl p-3 mt-2">

</div>

<div>

<label>Skin</label>

<input
type="number"
name="skin"
class="w-full bg-white/10 rounded-xl p-3 mt-2">

</div>

<div>

<label>Emblem</label>

<input
type="text"
name="emblem"
class="w-full bg-white/10 rounded-xl p-3 mt-2">

</div>

<div>

<label>Starlight</label>

<input
type="text"
name="starlight"
class="w-full bg-white/10 rounded-xl p-3 mt-2">

</div>

<div>

<label>Login</label>

<input
type="text"
name="login"
class="w-full bg-white/10 rounded-xl p-3 mt-2">

</div>

<div class="md:col-span-2">

<label>Bind</label>

<input
type="text"
name="bind"
class="w-full bg-white/10 rounded-xl p-3 mt-2">

</div>

</div>

</div>

<hr class="border-white/20">

{{-- Deskripsi --}}
<div>

<label class="font-semibold">
Deskripsi
</label>

<textarea
name="description"
rows="7"
class="w-full bg-white/10 rounded-xl p-4 mt-2"></textarea>

</div>

<button
class="bg-cyan-400 hover:bg-cyan-300 text-black px-8 py-4 rounded-xl font-bold">

Simpan Akun

</button>

</form>

{{-- Preview Thumbnail --}}
<script>

thumbnail.onchange=e=>{

thumbnailPreview.src=URL.createObjectURL(e.target.files[0]);

thumbnailPreview.classList.remove('hidden');

}

</script>

{{-- Preview Gallery --}}
<script>

gallery.onchange=e=>{

galleryPreview.innerHTML='';

Array.from(e.target.files).forEach(file=>{

const img=document.createElement('img');

img.src=URL.createObjectURL(file);

img.className='rounded-xl h-32 w-full object-cover';

galleryPreview.appendChild(img);

});

}

</script>

{{-- Show Hide ML --}}
<script>

const game=document.getElementById('game');

const ml=document.getElementById('mlFields');

function toggle(){

if(game.value=="Mobile Legends"){

ml.style.display='block';

}else{

ml.style.display='none';

}

}

toggle();

game.addEventListener('change',toggle);

</script>

@endsection