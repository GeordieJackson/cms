<?php

namespace Tests\Unit\Schemas;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesSchemaTest extends TestCase
{
    use RefreshDatabase, CheckSchemaColumns;

    protected $table = 'categories';
    protected $requiredColumns;

    public function __construct()
    {
        parent::__construct();

        $this->requiredColumns = collect([
            'id',
            'category_id',
            'slug',
            'name',
            'count',
        ]);
    }

    /**
     * @test
     */
    public function categories_table_contains_required_columns()
    {
        $this->checkColumns();
        $this->checkColumnCount();
    }
}
