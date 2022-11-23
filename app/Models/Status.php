<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    const PROCESSING = "Обрабатывается";
    const ACCEPTED = "Принят";
    const PREPARING = "Готовится";
    const READY = "Готов к выдаче";
    const DONE = "Выдан";
}
