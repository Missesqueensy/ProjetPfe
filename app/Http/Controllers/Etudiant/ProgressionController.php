<?php

namespace App\Http\Controllers\Etudiant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 
use Illuminate\Http\Request;

use App\Models\cours;
class CourseProgressController extends Controller
{
    public function update(Cours $course, Request $request)
    {
        $progress = $request->validate(['progress' => 'required|integer|between:0,100']);
        
        auth()->user()->courses()->updateExistingPivot($course->id, [
            'progression' => $progress['progress']
        ]);
        
        return response()->json(['success' => true]);
    }
}
?>