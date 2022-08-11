<?php
    
    namespace App\Http\Controllers\Backend;
    
    use App\Http\Controllers\Controller;
    use App\Http\Requests\TemporalNameRequest;
    use App\Models\TemporalNames\TemporalName;

    use Facades\App\Services\Flash;

    use function redirect;
    use function route;
    
    class TemporalNameController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return view('dashboard.temporal-names.index')
                ->with('temporalNames', TemporalName::all());
        }
        
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
        }
        
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(TemporalNameRequest $request)
        {
            TemporalName::create($request->validated());
            
            return redirect(route('dashboard.temporalNames.index'));
        }
        
        /**
         * Display the specified resource.
         *
         * @param  \App\Models\TemporalNames\TemporalName  $temporalName
         * @return \Illuminate\Http\Response
         */
        public function show(TemporalName $temporalName)
        {
            //
        }
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Models\TemporalNames\TemporalName  $temporalName
         * @return \Illuminate\Http\Response
         */
        public function edit(TemporalName $temporalName)
        {
            //
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\TemporalNames\TemporalName  $temporalName
         * @return \Illuminate\Http\Response
         */
        public function update(TemporalNameRequest $request, TemporalName $temporalName)
        {
            $temporalName->fill($request->validated())->save();
            
            if( ! $temporalName->wasChanged()) {
                Flash::info("Section {$temporalName->name} was NOT updated. No changes detected.");
            };
    
            return redirect(route('dashboard.temporalNames.index'));
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\TemporalNames\TemporalName  $temporalName
         * @return \Illuminate\Http\Response
         */
        public function destroy(TemporalName $temporalName)
        {
            $temporalName->delete();
    
            return redirect(route('dashboard.temporalNames.index'));
        }
    }
