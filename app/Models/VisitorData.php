<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitorData extends Model
{
    use HasFactory;

    protected $table = 'visitors_data';
    protected $fillable = ['tahun', 'bulan', 'jumlah_pengunjung'];

    
}
