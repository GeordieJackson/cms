<?php
    
    namespace Tests\Unit\Schemas;
    
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    
    class VisitorTrackersSchemaTest extends TestCase
    {
        use RefreshDatabase, CheckSchemaColumns;
        
        protected $table = 'visitor_trackers';
        protected $requiredColumns;
        
        public function __construct()
        {
            parent::__construct();
            
            $this->requiredColumns = collect([
                'id',
                'request_uri',
                'http_referer',
                'status_code',
                'session_id',
                'search_term',
                'remote_addr',
                'http_user_agent',
                'request_method',
                'query_string',
                'is_bot',
                'created_at',
                'updated_at',
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
