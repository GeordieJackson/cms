<?php

    namespace Tests;

    use App\Models\Users\User;
    use Facades\Tests\Setup\UserRoleFactory;
    use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
    use function call_user_func;

    abstract class TestCase extends BaseTestCase
    {
        use CreatesApplication;

        protected function signIn($user = null)
        {
            $user = $user ?: User::factory()->create();
            $this->actingAs($user);

            return $user;
        }

        protected function signInAdminUser(): User
        {
            $user = UserRoleFactory::withRole('admin')->create();

            return $this->signIn($user);
        }

        /**
         * @NOTE: This is a temporary fix for the  "Config class does not exist" problem
         */
        protected function tearDown(): void
        {
//            if (class_exists('Mockery')) {
//                Mockery::close();
//            }

            if ($this->app) {
                foreach ($this->beforeApplicationDestroyedCallbacks as $callback) {
                    call_user_func($callback);
                }

                // the culprit:
                // $this->app->flush();

                $this->app = null;
            }
        }
    }
