<?php

namespace Codingo\Dropzoner\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Codingo\Dropzoner\Repositories\UploadRepository;

class DropzonerController extends Controller
{
    /**
     * Upload image methods
     *
     * @var UploadRepository
     */
    protected $uploadRepository;

    public function __construct(UploadRepository $uploadRepository)
    {
        $this->uploadRepository = $uploadRepository;
    }

    /**
     * Receive post requests from Dropzone
     *
     * @return mixed
     */
    public function postUpload(Request $request)
    {
        $input = $request->all();
        $response = $this->uploadRepository->upload($input);
        return $response;
    }

    public function postDelete(Request $request)
    {
        $response = $this->uploadRepository->delete($request->input('id'));
        return $response;
    }

}