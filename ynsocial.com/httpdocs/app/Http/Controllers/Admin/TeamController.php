<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of team members.
     */
    public function index(): View
    {
        $members = Team::orderBy('order')->paginate(10);
        return view('admin.team.index', compact('members'));
    }

    /**
     * Show the form for creating a new team member.
     */
    public function create(): View
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created team member.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'required|image|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'active' => 'boolean',
            'order' => 'integer',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('team', 'public');
        }

        Team::create($validated);

        return redirect()
            ->route('admin.team.index')
            ->with('success', 'Team member created successfully.');
    }

    /**
     * Show the form for editing the specified team member.
     */
    public function edit(Team $member): View
    {
        return view('admin.team.edit', compact('member'));
    }

    /**
     * Update the specified team member.
     */
    public function update(Request $request, Team $member): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'active' => 'boolean',
            'order' => 'integer',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($member->image) {
                Storage::disk('public')->delete($member->image);
            }
            $validated['image'] = $request->file('image')->store('team', 'public');
        }

        $member->update($validated);

        return redirect()
            ->route('admin.team.index')
            ->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified team member.
     */
    public function destroy(Team $member): RedirectResponse
    {
        // Delete image
        if ($member->image) {
            Storage::disk('public')->delete($member->image);
        }

        $member->delete();

        return redirect()
            ->route('admin.team.index')
            ->with('success', 'Team member deleted successfully.');
    }

    /**
     * Update the order of team members.
     */
    public function reorder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*' => 'exists:teams,id',
        ]);

        foreach ($validated['items'] as $index => $id) {
            Team::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['message' => 'Order updated successfully.']);
    }
} 