<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vet_details', function (Blueprint $table) {
            // Add user_email column if it does not exist
            if (!Schema::hasColumn('vet_details', 'user_email')) {
                $table->string('user_email')->after('user_id');
            }
        });

        // Add the index only if it does not exist
        $sm = Schema::getConnection()->getDoctrineSchemaManager();
        $indexes = $sm->listTableIndexes('vet_details');
        if (!array_key_exists('vet_details_user_id_user_email_index', $indexes)) {
            Schema::table('vet_details', function (Blueprint $table) {
                $table->index(['user_id', 'user_email']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the index if it exists
        $sm = Schema::getConnection()->getDoctrineSchemaManager();
        $indexes = $sm->listTableIndexes('vet_details');
        if (array_key_exists('vet_details_user_id_user_email_index', $indexes)) {
            Schema::table('vet_details', function (Blueprint $table) {
                $table->dropIndex('vet_details_user_id_user_email_index');
            });
        }

        Schema::table('vet_details', function (Blueprint $table) {
            if (Schema::hasColumn('vet_details', 'user_email')) {
                $table->dropColumn('user_email');
            }
        });
    }
};
