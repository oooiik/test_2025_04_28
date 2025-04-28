<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExcelExport implements FromQuery, WithMapping, WithColumnFormatting
{
    public function query()
    {
        return Product::query()->with('category');
    }

    public function map($product): array
    {
        return [
            $product->name,
            $product->barcode,
            $product->price,
            $product->category->name,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
