<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\MovieCollection as MovieCollectionResource;
use App\Classes\SelectMoviesRelationshipTables;
use App\Classes\InsertMoviesRelationshipTables;
use App\Classes\UpdateMoviesTable;
use App\Classes\DeleteMoviesTable;
use App\Classes\SearchMoviesTable;
use App\Classes\UploadCoverForMovie;

class MoviesApiController extends Controller
{
    public function list(SelectMoviesRelationshipTables $selectMoviesRelationshipTables)
    {
        $moviesWithGenres = $selectMoviesRelationshipTables->process();
        return new MovieCollectionResource($moviesWithGenres);
    }

    public function create(Request $request, InsertMoviesRelationshipTables $insertMoviesRelationshipTables, UploadCoverForMovie $uploadCoverForMovie)
    {
        // when inserting you should field "type" on
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:movies|min:2|max:150',
            'type' => 'required',
            'cover' => 'required|unique:movies',
            'description' => 'required|unique:movies|min:8',
            'country_of_production' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors->toJson();
        }
        $insertMoviesRelationshipTables->process($request);
        $uploadCoverForMovie->process($request);
        return response()->json([
            'message' => 'records inserted successfully'
        ], 200);
    }

    public function update(Request $request, UpdateMoviesTable $updateMoviesTable, $id)
    {
        // when updating you should field "type" off
        $updateMoviesTable->process($request, $id);
        return response()->json([
            'message' => 'records updated successfully'
        ], 200);
    }

    public function destroy(DeleteMoviesTable $deleteMoviesTable, $id)
    {
        // when deleting you should field "type" off
        $deleteMoviesTable->process($id);
        return response()->json([
            'message' => 'records deleted successfully'
        ], 200);
    }

    public function search(Request $request, SearchMoviesTable $searchMoviesTable)
    {
        $search = $searchMoviesTable->process($request);
        return response()->json([
            'results' => $search
        ]);
    }
}
