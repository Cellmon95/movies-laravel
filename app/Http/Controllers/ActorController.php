<?php

namespace App\Http\Controllers;

use App\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actors = Actor::all();
        return view('actors.index', ['actors' => $actors]);
    }

    public function oldActors()
    {
        $actors = Actor::where('birthday', '<', '1950-01-01')->get();
        return view('actors.index', ['actors' => $actors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('actors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newActor = new Actor();
        $newActor->name = $request->actorname;
        $newActor->birthday = $request->birthday;
        $newActor->country = $request->country;
        $newActor->created_at = now();
        $newActor->updated_at = now();
        $newActor->save();
        $actors = Actor::all();
        return view('actors.index', ['actors' => $actors]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function show(Actor $actor)
    {
        return view('actors.show', ['actor' => $actor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function edit(Actor $actor)
    {
        return view('actors.edit', ['actor' => $actor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actor $actor)
    {
        $actor->name = $request->actorname;
        $actor->birthday = $request->birthday;
        $actor->country = $request->country;
        $actor->updated_at = now();
        $actor->save();
        return view('actors.show', ['actor' => $actor]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        $actor->delete();
        $actors = Actor::all();
        return view('actors.index', ['actors' => $actors]);
    }
}
