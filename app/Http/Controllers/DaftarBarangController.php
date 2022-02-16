<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Daftar;
use App\Transaction;
use Illuminate\Http\Request;

class DaftarBarangController extends Controller
{
    public function index()
    {
        $daftars = Daftar::all();

        return view('daftar.index', compact('daftars'));
    }

    public function create()
    {
        return view('daftar.create');
    }

    public function edit($id)
    {
        $daftars = Daftar::all($id);

        return view('daftar.edit', compact('daftars'));
    }

    public function store()
    {
        $daftars = Daftar::create($this->validateRequest());

        $this->storeImage($daftars);

        return redirect()->back();
    }

    private function validateRequest()
    {
        return tap(request()->validate([
            'nama_barang' => 'required',
            'jumlah_barang' => 'required',
            'idr' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg|max:5000',
        ]), function(){
            if(request()->hasFile('image')) {
                request()->validate([
                    'image' => 'required|mimes:jpeg,png,jpg|max:5000',
                ]);
            }
        });
    }

    private function storeImage($daftars){
        if (request()->has('image')) {
            $daftars->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);

            $image = Image::make(public_path('storage/' . $daftars->image))->fit(300, 300, null, 'top-left');
            $image->save(); 
        }
    }

    public function update(Request $request, Daftar $daftars)
    {

        $daftars->update($request->all());

        $this->storeImage($daftars);

        return redirect()->back();
        
    }

    public function destroy(Request $request, $id)
    {
        $daftars = Daftar::findOrFail($id);
        

        if (\File::exists(public_path('storage/' . $daftars->image))) {
            \File::delete(public_path('storage/' . $daftars->image));
        }
        if ($daftars->delete()) {
            $get = Transaction::where('kodebarang_id','=', $id)->firstOrFail();

            $get->delete();
        }
        return redirect()->back();
    }

}

