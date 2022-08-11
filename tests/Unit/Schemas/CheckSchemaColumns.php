<?php
    
    namespace Tests\Unit\Schemas;
    
    use Illuminate\Support\Facades\Schema;
    
    trait CheckSchemaColumns
    {
        public function checkColumns()
        {
            $this->requiredColumns->each(function ($column) {
                $this->assertTrue(Schema::hasColumn($this->table, $column), "\nThe '$column' field is missing'\n");
            });
        }
    
        /**
         * This one acts as a check against new columns being added to the schema without being added to the columns
         * list in the test
         */
        public function checkColumnCount()
        {
            $this->assertEquals(count(Schema::getColumnListing($this->table)), $this->requiredColumns->count());
        }
    }
