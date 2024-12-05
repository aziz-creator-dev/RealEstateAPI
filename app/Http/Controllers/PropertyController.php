<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
/**
 * @OA\Info(
 *     title="Real Estate API",
 *     version="1.0",
 *     description="API to manage real estate properties like houses and apartments.",
 *     termsOfService="http://swagger.io/terms/",
 *     @OA\Contact(
 *         email="support@realestateapi.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 */

class PropertyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/properties",
     *     summary="Get a list of all properties",
     *     tags={"Properties"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of properties",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Property"))
     *     )
     * )
     */
    public function index()
    {
        $properties = Property::all(); 
        return response()->json($properties);
    }

    /**
     * @OA\Post(
     *     path="/api/properties",
     *     summary="Create a new property",
     *     tags={"Properties"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Property")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Property created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Property")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate(Property::validationRules());

        $property = Property::create($validated);

        return response()->json($property, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/properties/{id}",
     *     summary="Get a specific property",
     *     tags={"Properties"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the property to fetch",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details of the property",
     *         @OA\JsonContent(ref="#/components/schemas/Property")
     *     )
     * )
     */
    public function show(Property $property)
    {
        return response()->json($property);
    }

    /**
     * @OA\Put(
     *     path="/api/properties/{id}",
     *     summary="Update a specific property",
     *     tags={"Properties"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the property to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Property")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Property updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Property")
     *     )
     * )
     */
    public function update(Request $request, Property $property)
    {
        $validated = $request->validate(Property::validationRules());

        $property->update($validated);

        return response()->json($property);
    }

    /**
     * @OA\Delete(
     *     path="/api/properties/{id}",
     *     summary="Delete a specific property",
     *     tags={"Properties"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the property to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Property deleted successfully"
     *     )
     * )
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/api/properties/search",
     *     summary="Search properties based on filters",
     *     tags={"Properties"},
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Type of the property",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="address",
     *         in="query",
     *         description="Address of the property",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="size",
     *         in="query",
     *         description="Size of the property",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="bedrooms",
     *         in="query",
     *         description="Number of bedrooms",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="price",
     *         in="query",
     *         description="Maximum price",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of filtered properties",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Property"))
     *     )
     * )
     */
    public function search(Request $request)
    {
        $query = Property::query();

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('address')) {
            $query->where('address', 'LIKE', "%{$request->address}%");
        }

        if ($request->has('size')) {
            $query->where('size', $request->size);
        }

        if ($request->has('bedrooms')) {
            $query->where('bedrooms', $request->bedrooms);
        }

        if ($request->has('price')) {
            $query->where('price', '<=', $request->price);
        }

        return response()->json($query->get());
    }

    /**
     * @OA\Get(
     *     path="/api/properties/nearby",
     *     summary="Find properties within a given radius of a geographic point",
     *     tags={"Properties"},
     *     @OA\Parameter(
     *         name="latitude",
     *         in="query",
     *         required=true,
     *         description="Latitude of the location",
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Parameter(
     *         name="longitude",
     *         in="query",
     *         required=true,
     *         description="Longitude of the location",
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Parameter(
     *         name="radius",
     *         in="query",
     *         required=true,
     *         description="Search radius in kilometers",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of properties within the radius",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Property"))
     *     )
     * )
     */
    public function nearby(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric|min:1',
        ]);

        $latitude = $validated['latitude'];
        $longitude = $validated['longitude'];
        $radius = $validated['radius'];

        // Assuming you have a model scope for proximity or custom logic for geolocation
        $properties = Property::withinRadius($latitude, $longitude, $radius)->get();

        return response()->json($properties);
    }
}
