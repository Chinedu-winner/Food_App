<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable  = [
        'user_id',
        'name',
        'address', 
        'phone_number',
        'description', 
        'cuisine',
        'image',
        'latitude',
        'longtiude',
        'delivery_fee',
        'avg_price',
        'rating',
        'is-open',
        'opening_time', 
        'closing_time', 
        'status'
    ];
    protected $casts = [
        'is_open' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
        'delivery_fee' => 'float',
        'avg_price' => 'float',
        'rating' => 'float',
        'opening_time' => 'datetime',
        'closing_time' => 'datetime',
    ];
    protected $appends = [
        'is_open'
    ];

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function menus(){
        return $this->hasMany(Menu::class);
    }

    public function dishes(){
        return $this->hasMany(Dish::class);
    }

    public function review(){
        return $this->morphMany(Review::class);
    }
    public function order(){
        return $this->hasMany(Order::class); 
    }
    public function coupon(){
        return $this->hasMany(Coupon::class); 
    }


    public function scopeSearch(Builder $query, ?string $term){
        if (empty($term)){
            return $query;
        }
        $term = '%' . str_replace(['%', '_',], ['//%', '//_'], $term) . '%';

    return $query->where(function (Builder $q) use ($term){
            $q->where('name', 'like', $term)
              ->orWhere('description', 'like', $term)
              ->orWhere('cuisine', 'like', $term)
              ->orWhere('address', 'like', $term);
        });
    }
    public function scopeFilter(Builder $query, array $filters){
        return $query
        ->when($filters['cuisine'] ?? null, fn($q, $v) => $q ->where('cuisine', $v))
        ->when($filters['min_rating'] ?? null, fn($q, $v)=> $q->where('rating', '>=', (float) $v))
        ->when(isset($Filters['is_open']),fn($q, $v) => $q->where('is_open', (bool) $v))
        ->when($filters['max_price'] ?? null, fn($q, $v) => where('avg_price', '<=', $v));
    }

    // public function scopeNearby(Builder $query, float $lat, float $lng, float $distance)

    public function getIsOpenNowAttribute(){
        if(! $this->opening_time || ! $this->closing_time){
            return (bool) $this-> is_open; 
        }
        $now = Carbon::now()->format('H:i');
        $open = $this->opening_time;
        $close = $this->closing_time;

        if ($open <= $close){
            return $now >= $open && $now <= $close;
        }
        return $now >= $open || $now <= $close;
    }

    public function getContactAttribute(){
        if(! $this ->opening_time || ! $this->closing_time){
            return trim (($this ->address ? $this->address . '.' : '') . ($this->phone_number ?? ''));
        }
    }
    public function recalcRating(): void{
        $avg = $this ->review()->avg('rating') ?? 0; 
        $this->rating = round($avg, 2); 
         $this -> saveQuietly();
    } 
} 