<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="AnswerCreateRequest",
 *      description="Request that is used when a user wants to save the answer.",
 *      type="object",
 *      required={"number_of_attempts", "exercise_id"}
 * )
 */
class AnswerCreateRequest
{
    /**
     * @OA\Property(
     *      title="exercise_id",
     *      description="Id of the exercise for which the answer was given.",
     *      example="1"
     * )
     */
    private $exercise_id;

    /**
     * @OA\Property(
     *      title="number_of_attempts",
     *      description="Number of times the user tried to answer but the answer was wrong.",
     *      example="1"
     * )
     */
    private $number_of_attempts;

    /**
     * @OA\Property(
     *      title="solving_time",
     *      description="Time in seconds the user spent to answer the question. If the user didn't answer the question, this value is null.",
     *      example="1"
     * )
     */
    private $solving_time;

    /**
     * @OA\Property(
     *      title="deletions",
     *      description="Number of times the user deleted a note.",
     *      example="1"
     * )
     */
    private $deletions;

        /**
     * @OA\Property(
     *      title="level",
     *      description="Exercise difficulty level.",
     *      example="1"
     * )
     */
    private $level;

    /**
     * @OA\Property(
     *      title="sound_replays",
     *      description="Number of times the user replayed the sound.",
     *      example="1"
     * )
     */
    private $sound_replays;

    /**
     * @OA\Property(
     *      title="score",
     *      description="Score calculated by client. Equals 0 if unsolved.",
     *      example="1"
     * )
     */
    private $score;
}
