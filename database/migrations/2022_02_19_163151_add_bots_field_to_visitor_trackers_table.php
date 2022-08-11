<?php
    
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    class AddBotsFieldToVisitorTrackersTable extends Migration
    {
        public function up()
        {
            Schema::table('visitor_trackers', function(Blueprint $table) {
                $table->boolean('is_bot')->default(false)->after('query_string');
            });
        }
        
        public function down()
        {
            Schema::table('visitor_trackers', function(Blueprint $table) {
                $table->dropColumn('bot');
            });
        }
    }