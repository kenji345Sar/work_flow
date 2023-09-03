<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class EMPST extends Model
{
    use HasFactory;

    protected $table = 'empst';

    public $timestamps = false;

    public $incrementing = false; // auto-incrementを無効にする
    protected $keyType = 'string'; // 主キーの型
    protected $primaryKey = ['HID', 'DID', 'PID']; // 複合主キーの設定

    protected $fillable = ['HID', 'DID', 'PID', 'KOSU', 'HNM'];

    public function getHNMAttribute($value)
    {
        // return 'This is from the accessor!';
        Log::info('HNM accessor called.');
        return $value ?? '';  // nullの場合はブランクにする
    }
}
