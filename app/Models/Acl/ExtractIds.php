<?php
    
    namespace App\Models\Acl;
    
    trait ExtractIds
    {
        /**
         *  This is used to allow the passing of integers, objects, arrays, and collections
         *  as parameters for updating BelongsToMany relationships.
         *
         *  It simply returns the ID(s) of the passed in parameters as they work
         *  in all circumstances.
         *
         * @param $input
         * @return collection|int
         */
        protected function extractIdsFrom($input)
        {
            if (is_iterable($input)) { // Collections or arrays
                return collect($input)->map(function ($value) {
                    return $value->id ?? $value; // object or integer
                });
            } elseif (is_integer($input)) { // Single Id
                return $input;
            } elseif (is_object($input)) { // Single object
                return $input->id;
            }
        }
    }
