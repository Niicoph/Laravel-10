<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
// we cant have two classes with the same name in the same namespace, so we have to declare an alias for the QueryBuilder class
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Book extends Model {
    use HasFactory;

    // Defines the relationship between a book and its reviews
    public function reviews() {
        return $this->hasMany(Review::class);
    }
    public function scopeTitle(Builder $query, string $title) : Builder {
        return $query->where('title' , 'LIKE' , '%' . $title . '%');
    }
    public function scopePopular(Builder $query , $from = null , $to = null):Builder | QueryBuilder {
        return $query->withCount([    // se pasa como parametro una funcion anonima a la key 'reviews'
            'reviews' => fn(Builder $q) => $this->dateRangeFilter($q , $from , $to)
        ])
        ->orderBy('reviews_count' , 'desc');
    }
    public function scopeHighestRated(Builder $query,  $from = null , $to = null):Builder | QueryBuilder {
        return $query->withAvg( [  
            'reviews' => fn(Builder $q) => $this->dateRangeFilter($q , $from , $to)
        ] , 'rating')
                     ->orderBy('reviews_avg_rating' , 'desc');
    }
    public function scopeMinReviews(Builder $query , int $minReviews): Builder | QueryBuilder {
        return $query->havinv('reviews_count', '>=' , $minReviews);
    }      
    private function dateRangeFilter(Builder $query  ,  $from = null , $to = null) {
        if ($from && !$to) {
            $query->where('created_at' , '>=' , $from);
        // si se encuentra el $to , entonces se filtrara desde esa fecha hacia atras.
        } elseif(!$from && $to) {
            $query->where('created_at' , '<=' , $to);
        // si se encuentra $from y $to , entonces se filtrara entre esas dos fechas.
        } elseif ($from && $to) {
            $query->whereBetween('created_at', [$from , $to]);
        }
    }      
}  


