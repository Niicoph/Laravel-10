<?php 


namespace App\Http\Traits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\query\Builder as QueryBuilder;



trait CanLoadRelationships {
    public function loadRelationships(
        Model|QueryBuilder|EloquentBuilder|HasMany $for,
        ?array $relations = null
    ) : Model|QueryBuilder|EloquentBuilder|HasMany {

        $relations = $relations ?? $this->relations ?? [];
        
        foreach($relations as $relation) {
            $for->when(
                $this->shouldIncluideRelation($relation),
                fn($q) => $for instanceof Model ? $for->load($relation) : $q->with($relation)
            );
        }

        return $for;

        
    }

    protected function shouldIncluideRelation(string $relation) : bool  {
        $include = request()->query('include');
        if (!$include) {
            return false;
        }
        $relations =  array_map( 'trim' ,  explode(',' , $include) );   
                            // Here we are 'sanitizing' the URL 
        return in_array($relation , $relations);
    }

}