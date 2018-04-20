<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFixedExpenseToFixedExpenseRows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fixed_expense_rows', function (Blueprint $table) {
            $table->unsignedInteger('fixed_expense_id');
            $table->foreign('fixed_expense_id')->references('id')->on('fixed_expenses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fixed_expense_rows', function (Blueprint $table) {
            $table->dropForeign('fixed_expense_rows_fixed_expense_id_foreign');
        });
    }
}
