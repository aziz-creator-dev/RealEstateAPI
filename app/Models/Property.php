<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Property",
 *     type="object",
 *     required={"type", "address", "price", "size", "bedrooms"},
 *     @OA\Property(
 *         property="type",
 *         type="string",
 *         description="The type of property (e.g., apartment, house)"
 *     ),
 *     @OA\Property(
 *         property="address",
 *         type="string",
 *         description="The address of the property"
 *     ),
 *     @OA\Property(
 *         property="price",
 *         type="integer",
 *         description="The price of the property"
 *     ),
 *     @OA\Property(
 *         property="size",
 *         type="integer",
 *         description="The size of the property in square meters"
 *     ),
 *     @OA\Property(
 *         property="bedrooms",
 *         type="integer",
 *         description="The number of bedrooms in the property"
 *     ),
 *     @OA\Property(
 *         property="latitude",
 *         type="number",
 *         format="float",
 *         description="The latitude coordinate of the property"
 *     ),
 *     @OA\Property(
 *         property="longitude",
 *         type="number",
 *         format="float",
 *         description="The longitude coordinate of the property"
 *     ),
 * )
 */
class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'address',
        'size',
        'bedrooms',
        'price',
        'latitude',
        'longitude',
    ];

    /**
     * Validation rules for the Property model.
     *
     * @return array<string, mixed>
     */
    public static function validationRules(): array
    {
        return [
            'type' => 'required|in:House,Apartment',
            'address' => 'required|string|max:255',
            'size' => 'required|numeric|min:0',
            'bedrooms' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ];
    }
}

