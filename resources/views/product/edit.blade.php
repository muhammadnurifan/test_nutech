@extends('layouts.master')
@section('content')

<div class="container">
    <form action="/product/{{$product->id}}/update" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="card">
            <div class="card-header">
                Update Prodact
                <button type="submit" class="btn btn-success btn-sm" style="float: right;">Update</button>
                <a href="/products" class="btn btn-light btn-sm" style="float: right; margin-right: 10px;">Back to list</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    @if($product->foto_barang)
                                    <img src="{{ asset('storage/' . $product->foto_barang) }}" class="img-preview img-fluid mb-3">
                                    @else
                                    <img class="img-preview img-fluid mb-3">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Nama Barang</label>
                                    <input name="nama_barang" type="text" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ old('nama_barang', $product->nama_barang) }}" autocomplete="off">
                                    @error('nama_barang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Stock</label>
                                    <input name="stock" type="number" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" autocomplete="off">
                                    @error('stock')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror  
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Foto Barang</label>
                                    <input name="foto_barang" type="file" class="form-control @error('foto_barang') is-invalid @enderror" id="FotoBarang" onchange="previewImage()">
                                    @error('foto_barang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror  
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Harga Beli</label>
                                    <input name="harga_beli" type="number" class="form-control @error('harga_beli') is-invalid @enderror" value="{{ old('harga_beli', $product->harga_beli) }}" autocomplete="off">  
                                    @error('harga_beli')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Harga Jual</label>
                                    <input name="harga_jual" type="number" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual', $product->harga_jual) }}" autocomplete="off">  
                                    @error('harga_jual')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('footer')
<script>
    function previewImage() {
        const img = document.querySelector('#FotoBarang');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(img.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@stop