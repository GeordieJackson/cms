<?php
    
    namespace App\Http\Controllers\Backend\Images;
    
    class ImageUploadController
    {
        public function index()
        {
            return view('dashboard.images.uploader');
        }
    }