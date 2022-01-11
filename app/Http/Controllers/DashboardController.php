<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function __construct()   // ativa quando construir/iniciar a classe 
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {              
    
        return view('dashboard');
    }
}
