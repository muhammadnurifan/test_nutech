@extends('layouts.master')
@section('content')

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add new product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/product-store" method="POST" enctype="multipart/form-data">
      @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="FotoBarang" class="form-label">Foto Barang</label>
                <img class="img-preview img-fluid mb-3">
                <input name="foto_barang" type="file" class="form-control @error('foto_barang') is-invalid @enderror" id="FotoBarang" onchange="previewImage()">
                @error('foto_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputNama1" class="form-label">Nama Barang</label>
                <input name="nama_barang" type="text" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ old('nama_barang')}}" id="exampleInputNama1">
                @error('nama_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputNama1" class="form-label">Harga Beli</label>
                <input name="harga_beli" type="number" class="form-control @error('harga_beli') is-invalid @enderror" value="{{ old('harga_beli')}}" id="exampleInputNama1">
                @error('harga_beli')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputNama1" class="form-label">Harga Jual</label>
                <input name="harga_jual" type="number" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual')}}" id="exampleInputNama1">
                @error('harga_jual')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputNama1" class="form-label">Stock</label>
                <input name="stock" type="number" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock')}}" id="exampleInputNama1">
                @error('stock')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-header">
            Product List
            <a href="/product-create" class="btn btn-primary btn-sm" style="float: right;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New</a>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->nama_barang}}</td>
                        <td>{{$product->harga_beli}}</td>
                        <td>{{$product->harga_jual}}</td>
                        <td>{{$product->stock}}</td>
                        <td style="text-align: center;">
                            <a href="#" class="btn btn-info btn-sm">Show</a>
                            <a href="/product/{{$product->id}}/edit" class="btn btn-success btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm delete" product-id="{{$product->id}}" product-name="{{$product->nama_barang}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "order": [ 3, 'desc' ],
        });

        $('.delete').click(function(){
            var product_name = $(this).attr('product-name');
            var product_id = $(this).attr('product-id');
            swal({
            title: "Are you sure deleted data?",
            text: "With name "+product_name +" ??",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = "/product/"+product_id+"/delete";
            } 
            });
        }); 
    });

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