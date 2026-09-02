<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Testimonial extends Model { protected $fillable = ['name','relationship','quote','is_placeholder','is_active']; protected $casts = ['is_placeholder'=>'boolean','is_active'=>'boolean']; }
