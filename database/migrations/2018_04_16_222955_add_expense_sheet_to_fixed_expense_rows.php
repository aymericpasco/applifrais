<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpenseSheetToFixedExpenseRows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fixed_expense_rows', function (Blueprint $table) {
            $table->unsignedInteger('expense_sheet_id');
            $table->foreign('expense_sheet_id')->references('id')->on('expense_sheets');
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
            $table->dropForeign('fixed_expense_rows_expense_sheet_id_foreign');
        });

    }
}
