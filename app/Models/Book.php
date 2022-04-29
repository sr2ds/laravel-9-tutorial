<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   description="Book model",
 *   title="Book",
 *   required={},
 *   @OA\Property(type="integer",description="id of Book",title="id",property="id",example="1",readOnly="true"),
 *   @OA\Property(type="dateTime",title="created_at",property="created_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 *   @OA\Property(type="dateTime",title="updated_at",property="updated_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 * )
 * 
 * @OA\Schema(
 *   schema="Books",
 *   title="Books",
 *   @OA\Property(title="data",property="data",type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/Book"),
 *   )
 * )
 * 
 * @OA\Parameter(
 *      parameter="Book--id",
 *      in="path",
 *      name="Book_id",
 *      required=true,
 *      description="Id of Book",
 *      @OA\Schema(
 *          type="integer",
 *          example="1",
 *      )
 * ),
 */
 
class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'author',
        'created_at',
        'updated_at',
    ];
    
    protected $casts = [];
}
