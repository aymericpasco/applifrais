<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNonFixedExpenseRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_fixed_expense_rows', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wording');
            $table->decimal('amount', 10, 2);
            $table->date('expense_date');
            $table->boolean('refused')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('non_fixed_expense_rows');
    }
}
