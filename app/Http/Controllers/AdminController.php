<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AccountService;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        if (
            $request->username == env('ADMIN_USERNAME') &&
            $request->password == env('ADMIN_PASSWORD')
        ) {

            session([
                'admin_login' => true
            ]);

            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Username atau Password salah.');
    }

    public function logout()
    {
        session()->forget('admin_login');

        return redirect('/admin/login');
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

   public function dashboard(AccountService $service)
{
    $accounts = collect($service->all());

    $stats = [

        'total' => $accounts->count(),

        'ml' => $accounts->where('game','Mobile Legends')->count(),

        'ff' => $accounts->where('game','Free Fire')->count(),

        'sold' => $accounts->where('status','sold')->count(),

        'available' => $accounts->where('status','available')->count(),

    ];

    return view(
        'admin.dashboard',
        compact('accounts','stats')
    );
}

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request, AccountService $service)
{
    $request->validate([
        'game' => 'required',
        'title' => 'required',
        'price' => 'required|numeric',
        'status' => 'required',
        'description' => 'required',

        'thumbnail' => 'required|image',

        'gallery.*' => 'image'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Thumbnail
    |--------------------------------------------------------------------------
    */

    $thumbnailName = time().'_thumb.'.$request->thumbnail->extension();

    $request->thumbnail->move(
        public_path('uploads/accounts/thumbnail'),
        $thumbnailName
    );

    /*
    |--------------------------------------------------------------------------
    | Gallery
    |--------------------------------------------------------------------------
    */

    $gallery=[];

    if($request->hasFile('gallery')){

        foreach($request->gallery as $image){

            $imageName=uniqid().'_'.$image->getClientOriginalName();

            $image->move(

                public_path('uploads/accounts/gallery'),

                $imageName

            );

            $gallery[]=$imageName;

        }

    }

    /*
    |--------------------------------------------------------------------------
    | Mobile Legends Data
    |--------------------------------------------------------------------------
    */

    $ml=null;

    if($request->game=="Mobile Legends"){

        $ml=[

            'rank'=>$request->rank,

            'hero'=>$request->hero,

            'skin'=>$request->skin,

            'emblem'=>$request->emblem,

            'starlight'=>$request->starlight,

            'login'=>$request->login,

            'bind'=>$request->bind,

        ];

    }

    /*
    |--------------------------------------------------------------------------
    | Save JSON
    |--------------------------------------------------------------------------
    */

    $service->create([

        'game'=>$request->game,

        'title'=>$request->title,

        'price'=>$request->price,

        'status'=>$request->status,

        'description'=>$request->description,

        'thumbnail'=>$thumbnailName,

        'gallery'=>$gallery,

        'ml'=>$ml,

    ]);

    return redirect('/admin/dashboard')
            ->with('success','Akun berhasil ditambahkan.');
}

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit($id, AccountService $service)
{
    $account = $service->find((int)$id);

    if (!$account) {
        abort(404);
    }

    return view('admin.edit', compact('account'));
}

    public function update(Request $request, $id, AccountService $service)
{
    $account = $service->find((int)$id);
    if (!$account) {
        abort(404);
    }

    $request->validate([
        'game' => 'required',
        'title' => 'required',
        'price' => 'required|numeric',
        'status' => 'required',
        'description' => 'required',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        'gallery.*' => 'image'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Thumbnail
    |--------------------------------------------------------------------------
    */

    $thumbnail = $account['thumbnail'];

    if ($request->hasFile('thumbnail')) {

        $thumbnail = time().'_thumb.'.$request->thumbnail->extension();

        $request->thumbnail->move(
            public_path('uploads/accounts/thumbnail'),
            $thumbnail
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Gallery
    |--------------------------------------------------------------------------
    */

    $gallery = $account['gallery'] ?? [];

    if ($request->hasFile('gallery')) {

        foreach ($request->gallery as $image) {

            $imageName = uniqid().'_'.$image->getClientOriginalName();

            $image->move(
                public_path('uploads/accounts/gallery'),
                $imageName
            );

            $gallery[] = $imageName;

        }

    }

    /*
    |--------------------------------------------------------------------------
    | Mobile Legends
    |--------------------------------------------------------------------------
    */

    $ml = null;

    if ($request->game == "Mobile Legends") {

        $ml = [

            'rank' => $request->rank,
            'hero' => $request->hero,
            'skin' => $request->skin,
            'emblem' => $request->emblem,
            'starlight' => $request->starlight,
            'login' => $request->login,
            'bind' => $request->bind,

        ];

    }

    $service->update((int)$id, [

        'game' => $request->game,
        'title' => $request->title,
        'price' => $request->price,
        'status' => $request->status,
        'description' => $request->description,
        'thumbnail' => $thumbnail,
        'gallery' => $gallery,
        'ml' => $ml,

    ]);

    return redirect('/admin/dashboard')
        ->with('success', 'Akun berhasil diupdate.');
}

public function deleteGallery(
    $id,
    $image,
    AccountService $service
)
{
    $account = $service->find((int)$id);

    if (!$account) {
        abort(404);
    }

    $gallery = $account['gallery'] ?? [];

    $gallery = array_values(
        array_filter(
            $gallery,
            fn($item) => $item !== $image
        )
    );

    $file = public_path(
        'uploads/accounts/gallery/'.$image
    );

    if (file_exists($file)) {
        unlink($file);
    }

    $service->update((int)$id, [

        'gallery' => $gallery

    ]);

    return back()
        ->with('success', 'Gallery berhasil dihapus.');
}

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy($id, AccountService $service)
{
    $account = $service->find((int)$id);

    if (!$account) {
        abort(404);
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Thumbnail
    |--------------------------------------------------------------------------
    */

    $thumbnail = public_path(
        'uploads/accounts/thumbnail/'.$account['thumbnail']
    );

    if (file_exists($thumbnail)) {
        unlink($thumbnail);
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Gallery
    |--------------------------------------------------------------------------
    */

    if (!empty($account['gallery'])) {

        foreach ($account['gallery'] as $image) {

            $path = public_path(
                'uploads/accounts/gallery/'.$image
            );

            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

    $service->delete((int)$id);

    return redirect('/admin/dashboard')
        ->with('success', 'Akun berhasil dihapus.');
}
}