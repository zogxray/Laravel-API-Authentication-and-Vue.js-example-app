<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\GetUserNotesRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    const PER_PAGE = 10;

    /**
     * @param \App\Http\Requests\GetUserNotesRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(GetUserNotesRequest $request) {
        $items = Note::orderBy('id', 'DESC')->where('user_id', $request->user()->id)->paginate(self::PER_PAGE);
        return response()->json(compact('items'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id) {
        $item = Note::orderBy('id', 'DESC')->where('user_id', $request->user()->id)->findOrFail($id);
        return response()->json(compact('item'));
    }

    /**
     * @param \App\Http\Requests\CreateNoteRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateNoteRequest $request) {
        $item = Note::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'user_id' => $request->user()->id,
        ]);

        return response()->json(compact('item'));
    }

    /**
     * @param \App\Http\Requests\UpdateNoteRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateNoteRequest $request, $id) {
        $item = Note::findOrFail($id);
        $item->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
        ]);

        return response()->json(compact('item'));
    }
}
