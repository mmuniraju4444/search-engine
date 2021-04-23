<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PageDataTable extends Migration
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
     * PageDataTable constructor.
     */
    public function __construct()
    {
        $this->tableName = 'page_data';
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
                $table->bigIncrements('id');
                $table->uuid('uuid')->unique();
                $table->mediumText('data')->index();
                $table->foreignId('page_id')->constrained();
                $table->softDeletes();
                $table->timestamps();
            });
            DB::statement("ALTER TABLE {$this->tableName} ADD FULLTEXT search(data)");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->disableForeignKeyConstraints();
        $this->schema->dropIfExists($this->tableName);
        $this->schema->enableForeignKeyConstraints();
    }
}
