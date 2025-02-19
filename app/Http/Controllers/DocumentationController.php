<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentationRequest;
use App\Http\Requests\UpdateDocumentationRequest;
use App\Models\Activity;
use App\Models\Documentation;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index()
    {
        $documentations = Documentation::get()->sortByDesc('date')->groupBy('date');

        return view('pages.dashboard.documentations.index', compact('documentations'));
    }

    public function create(Request $request)
    {
        try {
            if (!$request->has('uuid')) {
                throw new \Exception("Kegiatan tidak ditemukan");
            }

            $activity = Activity::where('uuid', $request->uuid)->first();

            if (!$activity) {
                throw new \Exception("Kegiatan tidak ditemukan");
            }

            return view('pages.dashboard.documentations.create', compact('activity'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function store(StoreDocumentationRequest $request)
    {
        try {
            foreach ($request->file('documentations') as $file) {
                Documentation::create([
                    'date' => $request->date,
                    'documentation' => basename($file->store('public/uploads/documentations')),
                    'activity_id' => $request->activity_id,
                    'user_id' => auth()->user()->id
                ]);
            }

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function show(Documentation $documentation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documentation $documentation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentationRequest $request, Documentation $documentation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documentation $documentation)
    {
        //
    }
}
