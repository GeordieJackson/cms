<?php

    namespace Tests\Unit\Traits;

    use Illuminate\Support\Collection;
    use Tests\TestCase;
    use Tests\Unit\Wrappers\ExtractIdsWrapper;

    class ExtractIdsTest extends TestCase
    {
        protected $wrapper;

        public function setUp() : void
        {
            parent::setUp();
            $this->wrapper = new ExtractIdsWrapper();
        }

        /**
         * @test
         */
        public function it_returns_a_single_integer_as_an_integer()
        {
            $input = 3;
            $result = $this->wrapper->getIds(3);
            $this->assertTrue(is_integer($result));
            $this->assertEquals($input, $result);
        }

        /**
         * @test
         */
        public function it_extracts_an_integer_from_a_single_object_and_returns_an_integer()
        {
            $object = new \stdClass();
            $object->id = 5;
            $result = $this->wrapper->getIds($object);
            $this->assertTrue(is_integer($result));
            $this->assertEquals($object->id, $result);
        }

        /**
         * @test
         */
        public function it_extracts_from_an_array_of_integers_and_returns_a_collection()
        {
            $input = [1, 3, 56, 78];
            $result = $this->wrapper->getIds($input);
            $this->assertInstanceOf(Collection::class, $result);
            $this->assertEquals($input, $result->toArray());
        }

        /**
         * @test
         */
        public function it_extracts_from_a_collection_of_integers_and_returns_a_collection()
        {
            $input = collect([1, 3, 56, 78]);
            $result = $this->wrapper->getIds($input);
            $this->assertInstanceOf(Collection::class, $result);
            $this->assertEquals($input, $result);
        }

        /**
         * @test
         */
        public function it_extracts_integers_from_an_array_of_objects_and_returns_a_collection()
        {
            $object1 = new \stdClass();
            $object2 = new \stdClass();
            $object3 = new \stdClass();
            $object1->id = 5;
            $object2->id = 9;
            $object3->id = 2;
            $objects = [$object1, $object2, $object3];
            $result = $this->wrapper->getIds($objects);
            $this->assertInstanceOf(Collection::class, $result);
            $this->assertEquals([5, 9, 2], $result->toArray());
        }

        /**
         * @test
         */
        public function it_extracts_integers_from_a_collection_of_objects_and_returns_a_collection()
        {
            $object1 = new \stdClass();
            $object2 = new \stdClass();
            $object3 = new \stdClass();
            $object1->id = 5;
            $object2->id = 9;
            $object3->id = 2;
            $objects = collect([$object1, $object2, $object3]);
            $result = $this->wrapper->getIds($objects);
            $this->assertInstanceOf(Collection::class, $result);
            $this->assertEquals([5, 9, 2], $result->toArray());
        }
    }
