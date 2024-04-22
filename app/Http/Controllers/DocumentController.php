<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $documents = Document::all();

        return view('documents.index', compact('documents'));
    }

    public function download(Document $document): BinaryFileResponse
    {
        $path = storage_path('/app/public/' . $document->file);

        return response()->download($path, $document->title);
    }
}
