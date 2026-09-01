<?php

namespace App\Models;

use Sakuci\Database\Model;

class Kategori extends Model
{
    protected static ?string $table = 'Kategori';

    protected array $fillable = ['nama_kategori','kode_kategori','keterangan'];
}
