<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpseclib3\Crypt\EC;
use phpseclib3\Crypt\PublicKeyLoader;
use StephenHill\Base58;

class SolanaAuthController extends Controller
{


    public function login() {
        return view('auth.login');
    }
}
