<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class EmbeddingCollectionImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public $importedData = [];

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $this->importedData[] = $row;
        }
    }
}