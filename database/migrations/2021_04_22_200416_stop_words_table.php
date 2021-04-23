<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StopWordsTable extends Migration
{
    /**
     * @var string $tableName
     */
    protected $tableName;

    /**
     * @var Schema $schema
     */
    protected $schema;

    /**
     * StopWordsTable constructor.
     */
    public function __construct()
    {
        $this->tableName = 'stop_words';
        $this->schema = Schema::connection(config('database.default'));
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!$this->schema->hasTable($this->tableName)) {
            $this->schema->create($this->tableName, function (Blueprint $table) {
                $table->string('value', 20);
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
        $this->schema->dropIfExists($this->tableName);
    }
}
