<?php

namespace App\Imports;

use App\Models\Data;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class DataImport implements ToModel, WithValidation, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public $file_id;

    public function  __construct($file_id)
    {
        $this->file_id = $file_id;
    }

    public function model(array $row)
    {
        return new Data([
            'name' => $row['name'],
            'number' => $row['number'],
            'file_id' => $this->file_id,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'number' => 'required|unique:data,number',
            'file_id' => '',
        ];
    }
}