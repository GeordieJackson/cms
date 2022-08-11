<?php

    namespace Tests\Unit\Schemas;

    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class PostsSchemaTest extends TestCase
    {
        use RefreshDatabase, CheckSchemaColumns;

        protected $table = 'posts';
        protected $requiredColumns;

        public function __construct()
        {
            parent::__construct();

            $this->requiredColumns = collect([
                'id',
                'owner_id',
                'category_id',
                'temporal_id',
                'type',
                'slug',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'title',
                'subtitle',
                'summary',
                'body',
                'pdf',
                'published',
                'publication_date',
                'sticky',
                'image',
                'created_at',
                'updated_at',
                'deleted_at',
            ]);
        }

        /**
         * @test
         */
        public function posts_table_contains_required_columns()
        {
            $this->checkColumns();
            $this->checkColumnCount();
        }
    }
