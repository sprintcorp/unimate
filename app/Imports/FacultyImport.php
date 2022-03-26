<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Faculty;
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

class FacultyImport implements ToCollection,SkipsOnError,SkipsOnFailure,WithHeadingRow,
    WithValidation,WithStartRow, WithBatchInserts, WithChunkReading
{
    public function __construct(private $university){}

    use SkipsErrors,SkipsFailures;
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            Faculty::create([
                'university_id'=> $this->university,
                'name'=>$row['name']
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
            'name' => 'required|string',
            'university_id' => 'integer|nullable|exists:universities,id',
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

