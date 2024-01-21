<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class TicketExport implements FromCollection,WithMapping,WithHeadings,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $items;


    public function __construct($items)
    {
        $this->items = $items;
    }

    public function collection()
    {
        return Ticket::whereIn('id', $this->items)->get();
    }
    public function headings(): array
    {
        return [
            '#',
            'Категория',
            'Пользователь',
            'Тема',
            'Описание',
            'Дан ли ответ на вопрос',
            'Решен ли вопрос',
            'Дата создания',
            'Дата обновления',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 40,
            'C' => 40,
            'D' => 30,
            'E' => 100,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
        ];
    }

    public function map($tickets): array
    {
        return [
            $tickets->id,
            $tickets->category->title,
            $tickets->user->name . "(" . $tickets->user->email .")",
            $tickets->title,
            htmlspecialchars($tickets->description),
            $tickets->is_answered ? "Отвечен" : "Не отвечен",
            $tickets->is_resolved ? "Решен" : "Не решен",
            $tickets->created_at->format("d.m.Y H:i"),
            $tickets->updated_at->format("d.m.Y H:i"),
        ];
    }
}
