<?php
    
    namespace Tests\Unit\Schemas;
    
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    
    class Permission_RoleSchemaTest extends TestCase
    {
        use RefreshDatabase, CheckSchemaColumns;
        
        protected $table = 'permission_role';
        protected $requiredColumns;
        
        public function __construct()
        {
            parent::__construct();
            
            $this->requiredColumns = collect([
                'permission_id',
                'role_id',
            ]);
        }
        
        /**
         * @test
         */
        public function tags_table_contains_required_columns()
        {
            $this->checkColumns();
            $this->checkColumnCount();
        }
    }
