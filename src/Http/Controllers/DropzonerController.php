<?php

namespace Codingo\Dropzoner\Http\Controllers;

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
    public function postUpload()
    {
        $input = \Input::all();
        $response = $this->uploadRepository->upload($input);
        return $response;
    }

    public function postDelete()
    {
        $response = $this->uploadRepository->delete(\Input::get('id'));
        return $response;
    }

}