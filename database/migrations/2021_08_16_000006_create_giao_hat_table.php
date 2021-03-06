<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaoHatTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'giao_hat';

    /**
     * Run the migrations.
     * @table giao_hat
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('ten_giao_hat', 45)->nullable();
            $table->date('ngay_thanh_lap')->nullable();
            $table->integer('nguoi_khoi_tao')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreignId('giao_phan_id')->nullable()->index()
                ->constrained('giao_phan')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
