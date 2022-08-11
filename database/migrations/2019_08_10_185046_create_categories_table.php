<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateCategoriesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('categories', function(Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('category_id')->default(0)->index();
                $table->string('slug', 40)->unique();
                $table->string('name', 40)->unique();
                $table->unsignedSmallInteger('count')->default(0);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('categories');
        }
    }
