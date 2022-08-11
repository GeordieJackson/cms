<?php

namespace Tests\Unit\Schemas;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTagSchemaTest extends TestCase
{
    use RefreshDatabase, CheckSchemaColumns;
    
    protected $table = 'post_tag';
    protected $requiredColumns;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->requiredColumns = collect([
            'id',
            'post_id',
            'tag_id',
            'created_at',
            'updated_at',
        ]);
    }
    
    /**
     * @test
     */
    public function users_table_contains_required_columns()
    {
        $this->checkColumns();
        $this->checkColumnCount();
    }
}
