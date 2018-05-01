<?php

namespace App\Providers;

use App\ExpenseSheet;
use App\FixedExpenseRow;
use App\NonFixedExpenseRow;
use App\Policies\ExpenseSheetPolicy;
use App\Policies\FixedExpenseRowPolicy;
use App\Policies\NonFixedExpenseRowPolicy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        //'App\Model\ExpenseSheet' => 'App\Policies\ExpenseSheetPolicy',
        ExpenseSheet::class => ExpenseSheetPolicy::class,
        FixedExpenseRow::class => FixedExpenseRowPolicy::class,
        NonFixedExpenseRow::class => NonFixedExpenseRowPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addMinute(10));
        // longlife refresh_token
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
