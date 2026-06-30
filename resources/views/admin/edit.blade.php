@extends('admin.layouts.app')

@section('content')

<h1 class="text-4xl font-bold mb-8">
    Edit Akun
</h1>

<form id="editForm"
      action="{{ url('/admin/update/'.$account['id']) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    {{-- Game --}}
    <div>
        <label class="font-semibold">Game</label>

        <select
            id="game"
            name="game"
            class="w-full bg-black/100 rounded-xl p-4 mt-2">

            <option value="Mobile Legends"
                {{ $account['game']=="Mobile Legends" ? "selected" : "" }}>
                Mobile Legends
            </option>

            <option value="Free Fire"
                {{ $account['game']=="Free Fire" ? "selected" : "" }}>
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
            value="{{ $account['title'] }}"
            class="w-full bg-white/10 rounded-xl p-4 mt-2">

    </div>

    {{-- Harga --}}
    <div>

        <label class="font-semibold">Harga</label>

        <input
            type="number"
            name="price"
            value="{{ $account['price'] }}"
            class="w-full bg-white/10 rounded-xl p-4 mt-2">

    </div>

    {{-- Status --}}
    <div>

        <label class="font-semibold">Status</label>

        <select
            name="status"
            class="w-full bg-black/100 rounded-xl p-4 mt-2">

            <option value="available"
                {{ $account['status']=="available" ? "selected" : "" }}>
                Available
            </option>

            <option value="sold"
                {{ $account['status']=="sold" ? "selected" : "" }}>
                Sold
            </option>

        </select>

    </div>

    <hr class="border-white/20">

    <h2 class="text-2xl font-bold">
        Gambar Akun
    </h2>

    {{-- Thumbnail Lama --}}
    <div>

        <label class="font-semibold">
            Thumbnail Sekarang
        </label>

        <img
            src="{{ asset('uploads/accounts/thumbnail/'.$account['thumbnail']) }}"
            class="w-56 rounded-xl mt-4 mb-4">

        <label class="font-semibold">
            Ganti Thumbnail
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

    {{-- Gallery Lama --}}
   

    {{-- Tambah Gallery --}}
    <div>

        <label class="font-semibold">
            Tambah Gallery
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

    {{-- ML ONLY --}}
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
                    value="{{ $account['ml']['rank'] ?? '' }}"
                    class="w-full bg-white/10 rounded-xl p-3 mt-2">

            </div>

            <div>

                <label>Hero</label>

                <input
                    type="number"
                    name="hero"
                    value="{{ $account['ml']['hero'] ?? '' }}"
                    class="w-full bg-white/10 rounded-xl p-3 mt-2">

            </div>

            <div>

                <label>Skin</label>

                <input
                    type="number"
                    name="skin"
                    value="{{ $account['ml']['skin'] ?? '' }}"
                    class="w-full bg-white/10 rounded-xl p-3 mt-2">

            </div>

            <div>

                <label>Emblem</label>

                <input
                    type="text"
                    name="emblem"
                    value="{{ $account['ml']['emblem'] ?? '' }}"
                    class="w-full bg-white/10 rounded-xl p-3 mt-2">

            </div>

            <div>

                <label>Starlight</label>

                <input
                    type="text"
                    name="starlight"
                    value="{{ $account['ml']['starlight'] ?? '' }}"
                    class="w-full bg-white/10 rounded-xl p-3 mt-2">

            </div>

            <div>

                <label>Login</label>

                <input
                    type="text"
                    name="login"
                    value="{{ $account['ml']['login'] ?? '' }}"
                    class="w-full bg-white/10 rounded-xl p-3 mt-2">

            </div>

            <div class="md:col-span-2">

                <label>Bind</label>

                <input
                    type="text"
                    name="bind"
                    value="{{ $account['ml']['bind'] ?? '' }}"
                    class="w-full bg-white/10 rounded-xl p-3 mt-2">

            </div>

        </div>

    </div>

    {{-- Deskripsi --}}
    <div>

        <label class="font-semibold">

            Deskripsi

        </label>

        <textarea
            name="description"
            rows="7"
            class="w-full bg-white/10 rounded-xl p-4 mt-2">{{ $account['description'] }}</textarea>

    </div>

    <button
type="submit"
form="editForm"
class="bg-cyan-400 px-8 py-4 rounded-xl">
    Simpan Perubahan
</button>

</form>

<script>

thumbnail.onchange=e=>{

thumbnailPreview.src=URL.createObjectURL(e.target.files[0]);

thumbnailPreview.classList.remove('hidden');

}

gallery.onchange=e=>{

galleryPreview.innerHTML='';

Array.from(e.target.files).forEach(file=>{

const img=document.createElement('img');

img.src=URL.createObjectURL(file);

img.className='rounded-xl h-32 object-cover';

galleryPreview.appendChild(img);

});

}

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

function deleteGallery(id,image){

    if(!confirm("Hapus gambar ini?")){
        return;
    }

    fetch(`/admin/gallery/delete/${id}/${image}`,{

        method:"DELETE",

        headers:{
            "X-CSRF-TOKEN":"{{ csrf_token() }}"
        }

    }).then(()=>{

        location.reload();

    });

}
</script>



@endsection