<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
      //
  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('App\Repos\Users\UserRepository', 
      'App\Repos\Users\DBUserRepository');
    $this->app->bind('App\Repos\Exams\ExamRepository', 
      'App\Repos\Exams\DBExamRepository');
  }
}
