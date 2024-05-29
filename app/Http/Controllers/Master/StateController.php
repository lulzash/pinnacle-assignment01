<?php

namespace App\Http\Controllers\Master;

use App\Models\State;
use Illuminate\Http\Request;
use App\Imports\StatesImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Master\State\StoreStateRequest;
use App\Http\Requests\Master\State\ImportStateRequest;
use App\Http\Requests\Master\State\UpdateStateRequest;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $state = new State;
        
        $states = $state->list();

        return view('masters.state.list', [
            'states' => $states,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masters.state.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStateRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $state = new State;
            
            $state->create($validated);
    
            return redirect()->route('state.index')
                    ->withSuccess('New state is added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                    ->withError('Something went wrong. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        return view('masters.state.edit', [
            'state' => $state
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStateRequest $request, State $state)
    {
        try {
            $validated = $request->validated();
            
            $state->update($validated);

            return redirect()->route('state.index')
                    ->withSuccess('State is updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                    ->withError('Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        try {
            $state->delete();

            return redirect()->route('state.index')
                    ->withSuccess('State is deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                    ->withError('Something went wrong. Please try again.');
        }
    }

    /**
     * Import data from excel file.
     */
    public function import(ImportStateRequest $request)
    {
        try {
            Excel::import(new StatesImport, request()->file('file'));

            return redirect()->back()->with('success', 'States imported successfully.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()
                    ->withError('Something went wrong. Please try again.');
        }
    }
}
