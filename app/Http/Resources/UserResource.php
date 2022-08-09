<?php

namespace App\Http\Resources;

use App\Models\GameUser;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="User",
 *      description="User details.",
 *      type="object",
 * )
 */
class UserResource extends JsonResource
{
    /**
     * @OA\Property(
     *      title="id",
     *      description="Unique identifier",
     *      example="1"
     * )
     */
    private $id;

    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the user",
     *      example="John"
     * )
     */
    private $name;

    /**
     * @OA\Property(
     *      title="email",
     *      description="Email of the user",
     *      example="john@example.com"
     * )
     */
    private $email;

    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['school'] = $this->school->name;
        $range = CarbonPeriod::create()
            ->between(
                Carbon::now()->subDays(30),
                Carbon::now()
            );

        $data['total_points'] = (int) GameUser::query()->where('user_id', $this->resource->id)->sum('points');
        foreach ($range as $date) {
            $data['points_timeline'][] = [
                'date' => $date->format('Y-m-d'),
                'points' => $this->resource->achievedPointsOn($date)
            ];
        }
        return $data;
    }
}
