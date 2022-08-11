<?php
    
    namespace Tests\Feature\Backend;
    
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Support\Str;
    use Tests\TestCase;
    
    use function route;
    
    class TemporalNamesTest extends TestCase
    {
        use RefreshDatabase;
        
        protected function setUp(): void
        {
            parent::setUp();
            
            $this->signInAdminUser();
            $this->withExceptionHandling();
        }
        
        /**
         * @test
         *
         * @dataProvider TemporalNamesFormData
         */
        public function temporal_names_form_validation_rules($key, $value)
        {
            $this->post(route('dashboard.temporalNames.store'), [$key => $value])
                ->assertStatus(302)
                ->assertSessionHasErrors($key);
        }
        
        public function TemporalNamesFormData()
        {
            return [
                'Name is required' => ['name', null],
                'Slug is an integer' => ['slug', null],
                'Active is required' => ['active', null],
            ];
        }
        
        /** @test */
        function the_slug_is_stored_as_a_slug()
        {
            $data = [
                'name' => 'This is the name',
                'slug' => 'This is the name',
                'active' => 1,
            ];
            
            $this->post(route('dashboard.temporalNames.store'), $data);
            $this->assertDatabaseHas('temporal_names', ['slug' => Str::slug($data['slug'])]);
        }
    }