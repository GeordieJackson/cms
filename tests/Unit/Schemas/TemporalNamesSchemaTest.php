<?php
    
    namespace Tests\Unit\Schemas;
    
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    
    class TemporalNamesSchemaTest extends TestCase
    {
        use RefreshDatabase, CheckSchemaColumns;
        
        protected $table = 'temporal_names';
        protected $requiredColumns;
        
        public function __construct()
        {
            parent::__construct();
            
            $this->requiredColumns = collect([
                'id',
                'name',
                'slug',
                'active',
                'created_at',
                'updated_at',
                'deleted_at',
            ]);
        }
        
        /**
         * @test
         */
        public function temporal_names_table_contains_required_columns()
        {
            $this->checkColumns();
            $this->checkColumnCount();
        }
    }
