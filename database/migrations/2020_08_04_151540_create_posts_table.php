<?php

    use Carbon\Carbon;
    use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->unsignedBigInteger('temporal_id')->nullable();
            $table->foreign('temporal_id')->references('id')->on('temporal_names');
            $table->unsignedTinyInteger('type')->nullable();
            $table->string('slug')->unique();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('title')->nullable();
            $table->string('subtitle', 1024)->nullable();
            $table->text('summary')->nullable();
            $table->text('body')->nullable();
            $table->string('pdf')->nullable();
            $table->unsignedTinyInteger('published')->default(0);
            $table->boolean('sticky')->default(false);
            $table->string('image')->nullable();
            $table->dateTime('publication_date')->nullable()->default(Carbon::now());
            $table->timestamps();
            $table->softDeletes();
        });
    
        DB::statement('ALTER TABLE posts ADD FULLTEXT search(title, meta_description, summary, body)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
