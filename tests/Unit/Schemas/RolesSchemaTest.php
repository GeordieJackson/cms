<?php

    namespace Tests\Unit\Schemas;

    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class RolesSchemaTest extends TestCase
    {
        use RefreshDatabase, CheckSchemaColumns;

        protected $table = 'roles';
        protected $requiredColumns;

        public function __construct()
        {
            parent::__construct();

            $this->requiredColumns = collect([
                'id',
                'slug',
                'name',
                'description',
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
