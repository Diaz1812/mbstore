@props(['accounts'])

<section id="catalog" class="py-28">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center">

            <span class="glass px-5 py-2 rounded-full">

                🔥 Akun Terbaru

            </span>

            <h2 class="text-5xl font-bold mt-6">

                Katalog Akun

            </h2>

        </div>

        <!-- Filter -->

        <div class="glass rounded-2xl p-6 mt-12">

            <div class="grid md:grid-cols-4 gap-5">

                <input
    id="searchFilter"
    type="text"
    placeholder="Cari akun..."
    class="bg-white/10 rounded-xl px-4 py-3 outline-none">

                <select id="gameFilter" class="bg-black/100 rounded-xl px-4 py-3">

                    <option value="">Semua Game</option>

    <option value="mobile legends">
        Mobile Legends
    </option>

    <option value="free fire">
        Free Fire
    </option>

                </select>

                <select id="priceFilter" class="bg-black/100 rounded-xl px-4 py-3">

                    <option value="">Semua Harga</option>

    <option value="50000-300000">
        50K - 300K
    </option>

    <option value="300000-500000">
        300K - 500K
    </option>

    <option value="500000-1000000">
        500K - 1JT
    </option>

    <option value="1000000-5000000">
        1jt - 5JT
    </option>

                </select>

                <select id="statusFilter" class="bg-black/100 rounded-xl px-4 py-3">

                    <option value="">Semua Status</option>

    <option value="available">
        Available
    </option>

    <option value="sold">
        Sold
    </option>

                </select>

            </div>

        </div>

        <!-- Card -->

        <div class="grid lg:grid-cols-3 gap-8 mt-12">

    @forelse($accounts as $account)

        <x-account-card
    :id="$account['id']"
    :image="$account['thumbnail']"
    :game="$account['game']"
    :title="$account['title']"
    :price="$account['price']"
    :status="$account['status']"
/>

    @empty

        <div class="col-span-3 text-center py-20">

            <h2 class="text-2xl font-bold">

                Belum ada akun.

            </h2>

        </div>

    @endforelse

</div>

    </div>

</section>

<script>

const search=document.getElementById('searchFilter');

const game=document.getElementById('gameFilter');

const price=document.getElementById('priceFilter');

const status=document.getElementById('statusFilter');

const cards=document.querySelectorAll('.account-card');

function filterCards(){

cards.forEach(card=>{

const cardGame=card.dataset.game;

const cardPrice=parseInt(card.dataset.price);

const cardStatus=card.dataset.status;

const cardTitle=card.dataset.title;

let show=true;

// Search

if(search.value!=""){

if(!cardTitle.includes(search.value.toLowerCase()))

show=false;

}

// Game

if(game.value!=""){

if(cardGame!=game.value)

show=false;

}

// Status

if(status.value!=""){

if(cardStatus!=status.value)

show=false;

}

// Harga

if (price.value !== "") {

    const [min, max] = price.value.split('-').map(Number);

    if (!(cardPrice >= min && cardPrice <= max)) {
        show = false;
    }

}

card.style.display=show?'block':'none';

});

}

search.addEventListener('keyup',filterCards);

game.addEventListener('change',filterCards);

price.addEventListener('change',filterCards);

status.addEventListener('change',filterCards);

const params = new URLSearchParams(window.location.search);

const selectedGame = params.get('game');

if(selectedGame){

    game.value = selectedGame.toLowerCase();

    filterCards();

}

</script>