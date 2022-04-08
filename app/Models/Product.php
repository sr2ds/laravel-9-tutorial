<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   description="Product model",
 *   title="Product",
 *   required={},
 *   @OA\Property(type="integer",description="id of Product",title="id",property="id",example="1",readOnly="true"),
 *   @OA\Property(type="string",description="name of Product",title="name",property="name",example="Macbook Pro"),
 *   @OA\Property(type="string",description="sku of Product",title="sku",property="sku",example="MCBPRO2022"),
 *   @OA\Property(type="integer",description="price of Product",title="price",property="price",example="99"),
 *   @OA\Property(type="dateTime",title="created_at",property="created_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 *   @OA\Property(type="dateTime",title="updated_at",property="updated_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 * )
 * 
 * @OA\Schema(
 *   schema="Products",
 *   title="Products",
 *   @OA\Property(title="data",property="data",type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/Product"),
 *   )
 * )
 * 
 * @OA\Parameter(
 *      parameter="Product--id",
 *      in="path",
 *      name="Product_id",
 *      required=true,
 *      description="Id of Product",
 *      @OA\Schema(
 *          type="integer",
 *          example="1",
 *      )
 * ),
 */

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'price',
        'created_at',
        'updated_at',
    ];

    protected $casts = [];
}
