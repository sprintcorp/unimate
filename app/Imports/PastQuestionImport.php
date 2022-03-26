<?php

namespace App\Imports;

use App\Models\Answers;
use App\Models\PastQuestion;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class PastQuestionImport implements ToCollection,SkipsOnError,SkipsOnFailure,WithHeadingRow,
    WithValidation,WithStartRow, WithBatchInserts, WithChunkReading
{
    public function __construct(private $course,private $year){}
    use SkipsErrors,SkipsFailures;
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            $question = PastQuestion::create([
                'course_id' => $this->course,
                'year' => $this->year,
                'question'=>$row['question']
            ]);
            Answers::create([
                'past_questions_id'=>$question->id,
                    'option_one'=>$row['option_one'] ?? NULL,
                'option_two'=>$row['option_two'] ?? NULL,
                'option_three'=>$row['option_three'] ?? NULL,
                'option_four'=>$row['option_four'] ?? NULL,
                'answer'=>$row['answer'] ?? NULL,
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function rules(): array
    {
        return [
            'question' => 'required|string',
            'option_one' => 'string',
            'option_two' => 'string',
            'option_three' => 'string',
            'option_four' => 'string',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        return $failures;
    }

    public function onError(Throwable $e)
    {
        return $e;
    }

}
