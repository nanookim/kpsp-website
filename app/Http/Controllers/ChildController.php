<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\User;
class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $children = Child::with('user')->latest()->get();
            return datatables()->of($children)
                ->addIndexColumn()
                ->make(true);
        }

        $children = Child::with('user')->latest()->paginate(10);
        return view('anak.index', compact('children'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('anak.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
        ]);

        Child::create($request->all());
        return redirect()->route('anak.index')->with('success', 'Data anak berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Child $child)
    {
        return view('anak.show', compact('child'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Child $child)
    {
        $users = User::all();
        return view('anak.edit', compact('child', 'users'));
    }

    public function update(Request $request, Child $child)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
        ]);

        $child->update($request->all());
        return redirect()->route('anak.index')->with('success', 'Data anak berhasil diperbarui.');
    }

    public function destroy(Child $child)
    {
        $child->delete();
        return redirect()->route('anak.index')->with('success', 'Data anak berhasil dihapus.');
    }
}
