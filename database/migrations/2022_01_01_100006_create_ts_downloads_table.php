<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTsDownloadsTable extends Migration
{
    public function __construct()
    {
        $this->prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        $this->table = "{$this->prefix}_downloads";
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->table)) {
            Schema::create($this->table, function (Blueprint $table) {
                $table->bigIncrements('id');

                $table->foreignId('theme_id')
                    ->constrained("{$this->prefix}_themes")
                    ->onDelete('cascade');

                $table->foreignId('release_id')
                    ->constrained("{$this->prefix}_releases")
                    ->onDelete('cascade');

                $table->bigInteger('user_id')->unsigned()->nullable()->default(null);
                $table->string('session_id');
                $table->string('source');
                $table->unsignedInteger('times')->default(1);

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
        if (Schema::hasTable($this->table)) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropConstrainedForeignId('release_id');

                $table->dropIfExists();
            });
        }
    }
}
