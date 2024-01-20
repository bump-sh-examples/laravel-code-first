<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\{WidgetCollection, WidgetResource};
use App\Models\Widget;
use Illuminate\Http\{Request, Response};

use OpenApi\Attributes as OA;

class WidgetController extends Controller
{
    #[OA\Get(path: '/api/widgets', description: 'Display a collection of widgets.')]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK')]
    public function index()
    {
        $widgets = Widget::all();
        return new WidgetCollection($widgets);
    }

    #[OA\Get(path: '/api/widgets/{id}', description: 'Display the specified widget.')]
    #[OA\Parameter(in: "path", name: "id", required: true, schema: new OA\Schema(type: 'string'))]
    #[OA\Response(
        response: Response::HTTP_OK,
        description: 'OK',
        content: new OA\JsonContent(ref: "#/components/schemas/WidgetResource")
    )]
    #[OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(Widget $widget)
    {
        return new WidgetResource($widget);
    }

    #[OA\Post(path: '/api/widgets', description: 'Created a new widget.')]
    #[OA\Response(response: Response::HTTP_CREATED, description: 'Created')]
    public function store(Request $request)
    {
        $widget = Widget::create([
            'name' => $request->post('name'),
            'description' => $request->post('description'),
        ]);

        return response()->json(new WidgetResource($widget), Response::HTTP_CREATED);
    }

    #[OA\Put(path: '/api/widgets/{id}', description: 'Update the specified widget by replacing all properties.')]
    #[OA\Parameter(in: "path", name: "id", required: true, schema: new OA\Schema(type: 'string'))]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK')]
    #[OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Not found')]
    public function update(Request $request, Widget $widget)
    {
        $widget->update([
            'name' => $request->post('name'),
            'description' => $request->post('description'),
        ]);
        return response()->json(new WidgetResource($widget), Response::HTTP_OK);
    }

    #[OA\Delete(path: '/api/widgets/{id}', description: 'Delete the specified widget entirely.')]
    #[OA\Response(response: Response::HTTP_NO_CONTENT, description: 'Success')]
    #[OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Not found')]
    public function destroy(Widget $widget)
    {
        $widget->delete();
        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
