<?php
    
    namespace App\Http\Controllers\Backend\Stats;
    
    use App\Http\Controllers\Controller;
    
    class VisitorStatsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return view('dashboard.Stats.index');
        }
    }
