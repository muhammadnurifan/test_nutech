<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['foto_barang', 'nama_barang', 'harga_beli', 'harga_jual', 'stock'];

    public function getImage()
    {
        if(!$this->foto_barang){
            return asset('img/images-item.png');
        }

        return asset('img/'.$this->foto_barang);
    }
}
