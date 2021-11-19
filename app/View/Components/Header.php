<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $has_test = true;
        if (session_status() == PHP_SESSION_NONE)
          session_start();
        $token = @$_SESSION["session_token"];
        if ($token) {
          $user = User::where("session_token", $token)->first()->toArray();
          $has_test = !!$user["has_test"];
        }
        return view('components.header', ["show_test" => $has_test]);
    }
}
