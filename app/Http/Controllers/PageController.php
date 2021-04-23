<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostPageRequest;
use App\Interfaces\IPageRepository;
use App\Jobs\AddPageJob;
use App\Repositories\PageRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageController extends Controller
{

    /**
     * @var PageRepository $repo
     */
    private $repo;

    public function __construct()
    {
        $this->repo = app(IPageRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->repo->getPages(\request()->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostPageRequest $request
     * @return array
     * @throws Exception
     */
    public function store(PostPageRequest $request)
    {
        AddPageJob::dispatch($request->get('urls'));
        return ['msg' => 'Processing.. Will be add to the Search Engine in sometime'];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
