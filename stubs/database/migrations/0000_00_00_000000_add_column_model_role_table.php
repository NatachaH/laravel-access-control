<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumn{{ UCPNAME }}RoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('{{ PNAME }}', function (Blueprint $table)
        {
            $table->bigInteger('role_id')->after('id')->unsigned()->nullable();
            $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('{{ PNAME }}', function (Blueprint $table)
        {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
}
