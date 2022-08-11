<?php

    namespace Tests\Feature\Services;

    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    use Facades\App\Services\Flash;

    use function ucfirst;

    class FlashTest extends TestCase
    {
        use RefreshDatabase;
        /**
         * @test
         */
        public function setting_a_flash_message_sets_the_flash_key_in_the_session()
        {
            Flash::message('test');

            $this->get('/')->assertSessionHas('flash');
        }

        /**
        * @test
        */
        public function flash_fields_are_all_present()
        {
            Flash::message('test');

            $this->get('/')
                ->assertSessionHas('flash.type')
                ->assertSessionHas('flash.title')
                ->assertSessionHas('flash.message')
                ->assertSessionHas('flash.level')
                ->assertSessionHas('flash.important')
            ;
        }

        /**
        * @test
        */
        public function flash_type_defaults_to_alert()
        {
            Flash::message('test');

            $this->get('/');
            $this->assertEquals('alert', Flash::getType());
        }

        /**
        * @test
        */
        public function flash_type_can_be_set()
        {
            Flash::message('test')->type('modal');

            $this->get('/');
            $this->assertEquals('modal', Flash::getType());
        }

        /**
         * @test
         */
        public function flash_message_defaults_to_empty()
        {
            Flash::info();

            $this->get('/');
            $this->assertEquals('', Flash::getMessage());
        }

        /**
         * @test
         */
        public function flash_message_can_be_set()
        {
            Flash::info('test')->message('a message');

            $this->get('/');
            $this->assertEquals('a message', Flash::getMessage());
        }

        /**
         * @test
         */
        public function flash_title_can_be_set()
        {
            Flash::message('test')->title('a title');

            $this->get('/');
            $this->assertEquals('a title', Flash::getTitle());
        }

        /**
         * @test
         */
        public function flash_level_defaults_to_info()
        {
            Flash::message('test');

            $this->get('/');
            $this->assertEquals('info', Flash::getLevel());
        }

        /**
         * @test
         */
        public function flash_level_can_be_set()
        {
            Flash::message('test')->level('danger');

            $this->get('/');
            $this->assertEquals('danger', Flash::getLevel());
        }

        /**
         * @test
         */
        public function flash_importance_defaults_to_false()
        {
            Flash::message('test');

            $this->get('/');
            $this->assertEquals(false, Flash::getImportance());
        }

        /**
         * @test
         */
        public function importance_level_can_be_set()
        {
            Flash::message('test')->important();

            $this->get('/');
            $this->assertEquals(true, Flash::getImportance());
        }

        /**
        * @test
        */
        public function warning_level_defaults_to_important()
        {
            Flash::warning('test');

            $this->get('/');
            $this->assertEquals(true, Flash::getImportance());
        }

        /**
         * @test
         */
        public function warning_level_defaults_to_important_but_can_be_overridden()
        {
            Flash::warning('test')->important(false);

            $this->get('/');
            $this->assertEquals(false, Flash::getImportance());
        }

        /**
         * @test
         */
        public function danger_level_defaults_to_important_in_named_method()
        {
            Flash::danger('test');

            $this->get('/');
            $this->assertEquals(true, Flash::getImportance());
        }

        /**
         * @test
         */
        public function danger_level_defaults_to_important_in_level_method()
        {
            Flash::message('test')->level('danger');

            $this->get('/');
            $this->assertEquals(true, Flash::getImportance());
        }

        /**
         * @test
         */
        public function danger_level_defaults_to_important_but_can_be_overridden_in_named_method()
        {
            Flash::danger('test')->important(false);

            $this->get('/');
            $this->assertEquals(false, Flash::getImportance());
        }

        /**
         * @test
         */
        public function danger_level_defaults_to_important_but_can_be_overridden_in_level_method()
        {
            Flash::message('test')->level('danger')->important(false);

            $this->get('/');
            $this->assertEquals(false, Flash::getImportance());
        }
    }
