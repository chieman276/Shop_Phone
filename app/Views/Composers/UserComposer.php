<?php

namespace App\Views\Composers;



use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
class UserComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $userAll;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        
        $this->userAll = Auth::user();

    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('userAll', $this->userAll);
    }
}
