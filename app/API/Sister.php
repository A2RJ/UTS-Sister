<?php

namespace App\API;

use App\API\Routes;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use App\API\DataPokok;
use App\API\Dokumen;
use App\API\Kolaborator;
use App\API\Referensi;

class Sister extends Model
{
   use Routes, Referensi, Dokumen, DataPokok, Kolaborator;   
}
