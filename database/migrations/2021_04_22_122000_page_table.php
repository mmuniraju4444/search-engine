<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PageTable extends Migration
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
     * PageTable constructor.
     */
    public function __construct()
    {
        $this->tableName = 'pages';
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
                $table->string('url')->unique();
                $table->string('title');
                $table->string('description')->nullable();
                $table->string('keywords')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
            DB::statement("ALTER TABLE {$this->tableName} ADD FULLTEXT search(url, title, description, keywords)");
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
