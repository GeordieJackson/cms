<?php

namespace Tests\Unit\Schemas;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Role_UserSchemaTest extends TestCase
{
    use RefreshDatabase, CheckSchemaColumns;
    
    protected $table = 'role_user';
    protected $requiredColumns;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->requiredColumns = collect([
            'user_id',
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
