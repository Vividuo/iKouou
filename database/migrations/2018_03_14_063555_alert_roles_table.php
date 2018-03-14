<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('roles')) {
            Schema::table('roles', function ($table) {
                $table->dropColumn('name');
                $table->string('title', 32);
                $table->timestamps();
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
        if (Schema::hasTable('roles')) {
            Schema::table('roles', function ($table) {
                $table->dropColumn('created_at');
                $table->dropColumn('updated_at');
                $table->dropColumn('title');
                if (!Schema::hasColumn('roles', 'name')) {
                    $table->string('name', 32);
                }

            });
        }
    }
}
