<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTuSiTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tu_si';

    /**
     * Run the migrations.
     * @table tu_si
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('ho_va_ten', 100)->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->date('ngay_mat')->nullable();
            $table->string('dia_chi_hien_tai', 250)->nullable();
            $table->string('so_dien_thoai', 11)->nullable();
            $table->date('ngay_nhan_chuc')->nullable();
            $table->string('noi_nhan_chuc', 250)->nullable();
            $table->boolean('dang_du_hoc')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('nguoi_khoi_tao')->index();
            $table->unsignedBigInteger('chuc_vu_id')->index();
            $table->unsignedBigInteger('giao_phan_id')->index();
            $table->unsignedBigInteger('giao_hat_id')->nullable();
            $table->unsignedBigInteger('giao_xu_id')->nullable();


            $table->foreign('chuc_vu_id')
                ->references('id')->on('chuc_vu')
                ->onDelete('cascade');

            $table->foreign('giao_phan_id')
                ->references('id')->on('giao_phan')
                ->onDelete('cascade');

            $table->foreign('giao_hat_id')
                ->references('id')->on('giao_hat')
                ->onDelete('cascade');

            $table->foreign('giao_xu_id')
                ->references('id')->on('giao_xu')
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