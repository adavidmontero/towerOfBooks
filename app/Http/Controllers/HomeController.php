<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Copy;
use App\Models\User;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chart = (new LarapexChart)->pieChart()
            ->setTitle('Usuarios del sistema')
            ->setSubtitle('División por roles.')
            ->addData(Role::withCount('users')->pluck('users_count')->toArray())
            ->setLabels(Role::all()->pluck('display_name')->toArray());

        return view('home', [
            'users' => User::count(),
            'roles' => Role::count(),
            'permissions' => Permission::count(),
            'copies' => Copy::count(),
            'books' => Book::count(),
            'authors' => Author::count(),
            'genres' => Genre::count(),
            'categories' => Category::count(),
            'chart' => $chart,
        ]);
    }
}
