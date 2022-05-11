<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTsDownloadTokensTable extends Migration
{
    public function __construct()
    {
        $this->prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        $this->table = "{$this->prefix}_download_tokens";
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

                $table->foreignId('release_id')
                    ->constrained("{$this->prefix}_releases")
                    ->onDelete('cascade');

                $table->bigInteger('user_id')->unsigned()->nullable()->default(null);
                $table->string('session_id');
                $table->string('token');
                $table->dateTime('expires_at');

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
