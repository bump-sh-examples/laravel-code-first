<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse as Response;
use OpenApi\Attributes as OA;

#[OA\Info(title: "My Widget API", version: "1.0.0")]

class HomeController extends Controller
{
    #[OA\Get(path: '/api/', description: 'The home resource shows you what can be done with the API.')]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK')]
    public function __invoke(): Response
    {
        return response()->json(
            $this->jsonHome(),
            Response::HTTP_OK,
            [
                "Content-`Type" => "application/json-home",
                "Cache-Control" => "max-age=43200,public"
            ]
        );
    }

    /**
     * Create a JSON Home document for the API so that clients can discover
     * the API's entry points. Based on the JSON Home spec:
     *  https://mnot.github.io/I-D/json-home/
     */
    public function jsonHome(): array
    {
        return [
            "api" => [
                "title" => "Example API",
                "links" => [
                    "author" => "mailto:phil@greenturtle.io",
                    // Don't have any docs yet
                    // "describedBy" => "https://example.com/api-docs/"
                ]
            ],
            "resources" => [
                "example.com:rel:widgets" => [
                    "href" => "/widgets",
                ],
                "example.com:rel:widget" => [
                    "hrefTemplate" => "/widgets/{widget_id}",
                    "hrefVars" => [
                        "widget_id" => "https://example.org/param/widget"
                    ],
                    "hints" => [
                        "allow" => ["GET", "PUT", "DELETE"],
                        "formats" => [
                            "application/json" => []
                        ],
                    ],
                ]
            ]
        ];
    }
}
