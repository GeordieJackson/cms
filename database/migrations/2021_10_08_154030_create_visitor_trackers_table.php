<?php
    
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    class CreateVisitorTrackersTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('visitor_trackers', function (Blueprint $table) {
                $table->id();
                $table->string('request_uri')->nullable();
                $table->string('http_referer', 1024)->nullable();
                $table->string('status_code', 10)->nullable();
                $table->string('session_id')->nullable()->index();
                $table->string('search_term', 1024)->nullable();
                $table->string('remote_addr', 16)->nullable()->index();
                $table->string('http_user_agent')->nullable();
                $table->string('request_method')->nullable();
                $table->string('query_string')->nullable();
                $table->timestamps();
            });
        }
        
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('visitor_trackers');
        }
    }
