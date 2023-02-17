<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = DB::table('products')->paginate(10);
        $products = Product::all();
        return view('product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'foto_barang'  => 'image|required|mimes:jpg,png|file|max:100',
            'nama_barang'  => 'required|string|unique:products',
            'harga_beli'   => 'required',
            'harga_jual'   => 'required',
            'stock'        => 'required',
        ]);

        if($request->file('foto_barang')) {
            $validatedData['foto_barang'] = $request->file('foto_barang')->store('img');
        }

        Product::create($validatedData);

        return redirect('/products')->with('sukses','Data inputted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, $id)
    {
        $products = DB::table('products')->select('nama_barang')->where('id', $request->id)->first();

        $rules = [
            'foto_barang'  => 'image|mimes:jpg,png|file|max:100',
            'harga_beli'   => 'required',
            'harga_jual'   => 'required',
            'stock'        => 'required',
        ];

        if($request->nama_barang === $products) {
            $rules['nama_barang'] = 'required|string|unique:products';
        }

        $validatedData = $request->validate($rules);

        if($request->file('foto_barang')) {
            $validatedData['foto_barang'] = $request->file('foto_barang')->store('img');
        }

        $product = Product::find($id);
        $product->update($validatedData);

        return redirect('/products')->with('sukses','Data Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete('product');

        return redirect('/products')->with('sukses','Data Successfully Deleted');
    }
}
