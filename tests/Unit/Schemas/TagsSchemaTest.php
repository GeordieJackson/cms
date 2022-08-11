<?php

    namespace Tests\Unit\Schemas;

    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class TagsSchemaTest extends TestCase
    {
        use RefreshDatabase, CheckSchemaColumns;

        protected $table = 'tags';
        protected $requiredColumns;

        public function __construct()
        {
            parent::__construct();

            $this->requiredColumns = collect([
                'id',
                'name',
                'slug',
                'created_at',
                'updated_at',
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
