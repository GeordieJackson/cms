<?php

    namespace Tests\Unit\Schemas;

    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class UserSchemaTest extends TestCase
    {
        use RefreshDatabase, CheckSchemaColumns;

        protected $table = 'users';
        protected $requiredColumns;

        public function __construct()
        {
            parent::__construct();

            $this->requiredColumns = collect([
                'id',
                'forename',
                'surname',
                'slug',
                'email',
                'email_verified_at',
                'password',
                'two_factor_secret',
                'two_factor_recovery_codes',
                'remember_token',
                'current_team_id',
                'profile_photo_path',
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
