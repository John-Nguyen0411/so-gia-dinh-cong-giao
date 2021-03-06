<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaoXuTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'giao_xu';

    /**
     * Run the migrations.
     * @table giao_xu
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('ten_giao_xu', 45)->nullable();
            $table->string('dia_chi', 100)->nullable();
            $table->date('ngay_thanh_lap')->nullable();
            $table->integer('giao_xu_hoac_giao_ho')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('nguoi_khoi_tao')->index();

            $table->foreignId('giao_hat_id')->nullable()
                ->constrained('giao_hat')
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
