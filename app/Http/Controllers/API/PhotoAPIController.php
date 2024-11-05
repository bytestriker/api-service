<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePhotoAPIRequest;
use App\Http\Requests\API\UpdatePhotoAPIRequest;
use App\Models\Photo;
use App\Repositories\PhotoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PhotoController
 * @package App\Http\Controllers\API
 */

class PhotoAPIController extends AppBaseController
{
    /** @var  PhotoRepository */
    private $photoRepository;

    public function __construct(PhotoRepository $photoRepo)
    {
        $this->photoRepository = $photoRepo;
    }

    /**
     * Display a listing of the Photo.
     * GET|HEAD /photos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $photos = $this->photoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($photos->toArray(), 'Photos retrieved successfully');
    }

    /**
     * Store a newly created Photo in storage.
     * POST /photos
     *
     * @param CreatePhotoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePhotoAPIRequest $request)
    {
        $input = $request->all();

        $photo = $this->photoRepository->create($input);

        return $this->sendResponse($photo->toArray(), 'Photo saved successfully');
    }

    /**
     * Display the specified Photo.
     * GET|HEAD /photos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Photo $photo */
        $photo = $this->photoRepository->find($id);

        if (empty($photo)) {
            return $this->sendError('Photo not found');
        }

        return $this->sendResponse($photo->toArray(), 'Photo retrieved successfully');
    }

    /**
     * Update the specified Photo in storage.
     * PUT/PATCH /photos/{id}
     *
     * @param int $id
     * @param UpdatePhotoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePhotoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Photo $photo */
        $photo = $this->photoRepository->find($id);

        if (empty($photo)) {
            return $this->sendError('Photo not found');
        }

        $photo = $this->photoRepository->update($input, $id);

        return $this->sendResponse($photo->toArray(), 'Photo updated successfully');
    }

    /**
     * Remove the specified Photo from storage.
     * DELETE /photos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Photo $photo */
        $photo = $this->photoRepository->find($id);

        if (empty($photo)) {
            return $this->sendError('Photo not found');
        }

        $photo->delete();

        return $this->sendSuccess('Photo deleted successfully');
    }
}
