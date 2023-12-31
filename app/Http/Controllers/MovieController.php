<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\MovieRepository;
use Illuminate\Http\JsonResponse as IlluminateJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends Controller
{
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieSource)
    {
        $this->movieRepository = $movieSource;
    }

    /**
     * @param Request $request
     *
     * @return IlluminateJsonResponse
     */
    public function getMovie(Request $request): IlluminateJsonResponse
    {
        $action = $request->get('action');
        if (!method_exists($this->movieRepository, $action)) {
            return response()->json(['error' => 'Invalid action'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $result = $this->movieRepository->{$action}();
            return response()->json(['data' => $result]);

        } catch (\Exception $e) {
            Log::error((string)$e);
            return response()->json(['error' => 'Something went wrong'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
